<?php

class User
{
    private $db;

    public function __construct()
    {
        include_once('DB.php');
        $this->db = new DB();
    }

    public static function LoginStatus()
    {
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public static function AdminStatus()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function Login($name, $pass)
    {
        if (!empty($name) && !empty($pass)) {
            $params = array(":login" => $name);
            $SQL = "select * from user where `name` like :login;";
            $DBQuery = $this->db->Select($SQL, $params);
            if (count($DBQuery) === 1) {
                foreach ($DBQuery as $row) {
                    if (password_verify($pass, $row["pass"])) {
                        $_SESSION['login'] = $name;
                        if ($row["isAdmin"] == true) {
                            $_SESSION['isAdmin'] = $row['isAdmin'];
                            RedirectHandler::HTTP_301('dashboard_admin');
                        } else {
                            $_SESSION['isAdmin'] = $row['isAdmin'];
                            RedirectHandler::HTTP_301('dashboard');
                        }
                    } else {
                        echo "Incorrect password.";
                    }
                }
            } else {
                echo "Please, input correct username and password or make an account.";
            }
        } else {
            echo "Logging data is missing. Please enter username and password";
        }
    }

    public function Register($name, $pass, $isAdmin = false)
    {
        if (!empty($name) && !empty($pass)) {
            $params = array(":login" => $name);
            $SQL = "SELECT * FROM user where name = :login";
            $DBQuery = $this->db->Select($SQL, $params);
            if (count($DBQuery) === 0) {
                $pass = password_hash($pass, PASSWORD_BCRYPT);
                $params = array(":login" => $name, ":pass" => $pass, ":isAdmin" => $isAdmin);
                $SQL = "INSERT INTO user (user_id,name,pass,isAdmin)values ((SELECT UUID()),:login, :pass, :isAdmin);";
                $DBQuery = $this->db->Insert($SQL, $params);
                RedirectHandler::HTTP_301('home');
            } else {
                echo "This user exist!!! Check your username or choose another";
            }
        } else {
            echo "Please put login and password to register.";
        }
    }

    public function changePass($id, $pass, $newpass, $verifynewpass)
    {
        if (!empty($id) && !empty($pass) && !empty($newpass) && !empty($verifynewpass)) {
            $params = array("id" => $id);
            $SQL = "select * from user where `user_id` like :id;";
            $DBQuery = $this->db->Select($SQL, $params);
            if (count($DBQuery) === 1) {
                foreach ($DBQuery as $row) {
                    if ($row['isAdmin'] === '1') {
                        if (password_verify($pass, $row["pass"])) {
                            if ($newpass === $verifynewpass) {
                                $newpass = password_hash($newpass, PASSWORD_BCRYPT);
                                $params = array("id" => $id, "newpass" => $newpass);
                                $SQL = "Update user set pass = :newpass where user_id = :id";
                                $DBQuery = $this->db->Update($SQL, $params);
                                RedirectHandler::HTTP_301('dashboard_admin_coworkers');
                            } else {
                                echo "new password are not the same";
                            }
                        } else {
                            echo "Wrong current password";
                        }
                    } elseif ($row['isAdmin'] === '0') {
                        if (password_verify($pass, $row["pass"])) {
                            if ($newpass === $verifynewpass) {
                                $newpass = password_hash($newpass, PASSWORD_BCRYPT);
                                $params = array("id" => $id, "newpass" => $newpass);
                                $SQL = "Update user set pass = :newpass where user_id = :id";
                                $DBQuery = $this->db->Update($SQL, $params);
                                RedirectHandler::HTTP_301('dashboard_admin_client');
                            } else {
                                echo "new password are not the same";
                            }
                        } else {
                            echo "Wrong current password";
                        }
                    } else {
                        echo "ERROR: incorrect data of user";
//                        RedirectHandler::HTTP_301("e505");
                    }
                }
            } else {
                echo "User doesnt exist";
            }
        } else {
            echo "Please put old/new password in.";
        }
    }

    public function fetchUserInformation($user)
    {
        if (!empty($user)) {
            $params = array(":user" => $user);
            $SQL = "SELECT * FROM user where `name` like :user;";
            $DBQuery = $this->db->Select($SQL, $params);
            $userData = null;
            if (count($DBQuery) === 1) {
                $userData = $DBQuery;
                return $userData;
            }
        } else {
            echo "Data non-existent";
        }
    }

    public function updateUserInformation($user, $f_name, $honorifics, $surname, $email, $address, $hr_nr, $postcode, $land, $state, $m_nr)
    {
        if (!empty($user) && !empty($f_name) && !empty($honorifics) && !empty($surname) && !empty($email) && !empty($address) &&
            !empty($hr_nr) && !empty($postcode) && !empty($land) && !empty($state) && !empty($m_nr)) {
            $params = array(":user" => $user, ":f_name" => $f_name, ":honorifics" => $honorifics, ":surname" => $surname, ":email" => $email, ":address" => $address,
                "hr_nr" => $hr_nr, "postcode" => $postcode, "land" => $land, "state" => $state, "m_nr" => $m_nr);
            $SQL = "Update user set first_name = :f_name, honorifics = :honorifics, surname = :surname, email = :email, address = :address, 
                 `house number` = :hr_nr, postcode = :postcode, land = :land, state = :state, `mobile number` = :m_nr where name = :user;";
            $DBQuery = $this->db->Update($SQL, $params);
            RedirectHandler::HTTP_301('dashboard');
        } else {
            echo "Error";
        }
    }

    public function createNonUser($f_name, $honorifics, $surname, $email, $address, $hr_nr, $postcode, $land, $state, $m_nr)
    {
        if (!empty($f_name) && !empty($honorifics) && !empty($surname) && !empty($email) && !empty($address) &&
            !empty($hr_nr) && !empty($postcode) && !empty($land) && !empty($state) && !empty($m_nr)) {
            $params = array(":f_name" => $f_name, ":honorifics" => $honorifics, ":surname" => $surname, ":email" => $email, ":address" => $address,
                ":hr_nr" => $hr_nr, ":postcode" => $postcode, ":land" => $land, ":state" => $state, ":m_nr" => $m_nr);
            $SQL = "INSERT INTO user (isAdmin,honorifics, surname, address, `house number`, postcode, land, state, `mobile number`, first_name, email, user_id) values
('0',:honorifics, :surname, :address, :hr_nr, :postcode, :land, :state, :m_nr, :f_name, :email, (SELECT UUID()))";
            $DBQuery = $this->db->Insert($SQL, $params);
            $params = array(":f_name" => $f_name, ":honorifics" => $honorifics, ":surname" => $surname, ":email" => $email, ":address" => $address,
                ":hr_nr" => $hr_nr, ":postcode" => $postcode, ":land" => $land, ":state" => $state, ":m_nr" => $m_nr);
            $SQL = "SELECT * FROM user where first_name = :f_name AND honorifics = :honorifics AND surname = :surname AND email = :email AND address = :address 
                     AND `house number` = :hr_nr AND postcode = :postcode AND land = :land AND state = :state AND `mobile number` = :m_nr;";
            $DBQuery = $this->db->Select($SQL, $params);
            if (count($DBQuery) === 1) {
                foreach ($DBQuery as $data)
                $userData = $data['user_id'];
                return $userData;
            } else {
                echo "Data non-existent or are multiple";
            }
        } else {
            echo "Error";
        }
    }

    public function fetchClientInformation($user)
    {
        if (!empty($user)) {
            $params = array(":user" => $user);
            $SQL = "SELECT * FROM user where `user_id` like :user;";
            $DBQuery = $this->db->Select($SQL, $params);
            $userData = null;
            if (count($DBQuery) === 1) {
                $userData = $DBQuery;
                return $userData;
            }
        } else {
            echo "Data non-existent";
        }
    }

    public function updateClientInformation($user, $f_name, $honorifics, $surname, $email, $address, $hr_nr, $postcode, $land, $state, $m_nr)
    {
        if (!empty($user) && !empty($f_name) && !empty($honorifics) && !empty($surname) && !empty($email) && !empty($address) &&
            !empty($hr_nr) && !empty($postcode) && !empty($land) && !empty($state) && !empty($m_nr)) {
            $params = array(":user" => $user, ":f_name" => $f_name, ":honorifics" => $honorifics, ":surname" => $surname, ":email" => $email, ":address" => $address,
                "hr_nr" => $hr_nr, "postcode" => $postcode, "land" => $land, "state" => $state, "m_nr" => $m_nr);
            $SQL = "Update user set first_name = :f_name, honorifics = :honorifics, surname = :surname, email = :email, address = :address, 
                 `house number` = :hr_nr, postcode = :postcode, land = :land, state = :state, `mobile number` = :m_nr where user_id = :user;";
            $DBQuery = $this->db->Update($SQL, $params);
        } else {
            echo "Error";
        }
    }

    public function fetchLand()
    {
        $params = null;
        $SQL = "SELECT * FROM land ORDER BY land_name ASC;";
        $DBQuery = $this->db->Select($SQL, $params);
        $result = null;
        if (count($DBQuery) > 1) {
            $result = $DBQuery;
            return $result;
        } else {
            echo "Failed";
        }
    }

    public function fetchUserData($checkadmin)
    {
        $params = array("isAdmin" => $checkadmin);
        $SQL = "SELECT * FROM user WHERE isAdmin = :isAdmin;";
        $DBQuery = $this->db->Select($SQL, $params);
        $result = null;
        if (count($DBQuery) >= 1) {
            $result = $DBQuery;
            return $result;
        } else {
            return null;
        }
    }

    public function deleteUser($ID)
    {
        $params = array("ID" => $ID);
        $SQL = "DELETE FROM user WHERE user_id = :ID;";
        $DBQuery = $this->db->Delete($SQL, $params);
    }
}