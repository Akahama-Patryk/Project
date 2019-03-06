<?php

class User
{
    private $db;

    public function __construct()
    {
        include('DB.php');
        $this->db = new DB();
    }

    public function Login($name, $pass)
    {
        session_start();
        if (!empty($name) && !empty($pass)) {
            $params = array(":login" => $name);
            $SQL = "select * from users where `name` like :login;";
            $DBQuery = $this->db->Select($SQL, $params);
            if (count($DBQuery) === 1) {
                foreach ($DBQuery as $row) {
                    if (password_verify($pass, $row["pass"])) {
                        $_SESSION['login'] = $name;
                        header('Location: dashboard.php');
                    } else {
                        echo "Incorrect password.";
                    }
                }
            } else {
                echo "What?";
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
            echo "Error";
        }
    }
}