<?php

class User
{
    private $db;

    public function __construct()
    {
        include_once ('DB.php');
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
                            header('Location: dashboard_admin.php');
                        }else{
                            $_SESSION['isAdmin'] = $row['isAdmin'];
                            header('Location: dashboard.php');
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
    public static function LoginStatus(){
        if (isset($_SESSION['login']) && $_SESSION['login'] == true){
            return true;
        } else {
            return false;
        }
    }
}