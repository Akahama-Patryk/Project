<?php
include_once("App/Autoloader.php");

class User
{
    private $db;

    public function __construct()
    {
        include_once('DB.php');
        $this->db = new DB();
    }

    public function Login($name, $pass)
    {
        if (!empty($name) && !empty($pass)) {
            $params = array(":login" => $name);
            $SQL = "select * from users where `name` like :login;";
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

    public function Register($name, $pass)
    {
        if (!empty($name) && !empty($pass)) {
            $pass = password_hash($pass, PASSWORD_BCRYPT);
            $params = array(":login" => $name, ":pass" => $pass);
            $SQL = "INSERT INTO users (name,pass,isAdmin)values (:login, :pass, '0');";
            $DBQuery = $this->db->Insert($SQL, $params);
        } else {
            echo "Please put login and password to register.";
        }
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

    public function fetchUserInformation($user)
    {
        if (!empty($user)) {
            $params = array(":user" => $user);
            $SQL = "SELECT * FROM users where `name` like :user;";
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
            $SQL = "Update users set first_name = :f_name, honorifics = :honorifics, surname = :surname, email = :email, address = :address, 
                 `house number` = :hr_nr, postcode = :postcode, land = :land, state = :state, `mobile number` = :m_nr where name = :user;";
            $DBQuery = $this->db->Update($SQL, $params);
            RedirectHandler::HTTP_301('dashboard');
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

    public function fetchClientData()
    {
        $params = null;
        $SQL = "SELECT * FROM users WHERE NOT isAdmin = '1';";
        $DBQuery = $this->db->Select($SQL, $params);
        $result = null;
        if (count($DBQuery) >= 1) {
            $result = $DBQuery;
            return $result;
        }else{
            return null;
        }
    }

    public function deleteClient($ID){
        $params = array("ID" => $ID);
        $SQL = "DELETE FROM users WHERE name = :ID;";
        $DBQuery = $this->db->Delete($SQL, $params);
        RedirectHandler::HTTP_301('dashboard_client');
        echo "Client has been DELETED!!!";
    }
}