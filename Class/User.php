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
        if (!empty($name) && !empty($pass)) {
            $params = array(":login" => $name, ":pass" => $pass);
            $SQL = "select * from users where `name` like :login and pass like :pass;";
            $DBQuery = $this->db->Select($SQL, $params);

            if (count($DBQuery) === 1) {

                $_SESSION['login'] = $DBQuery['user'];
                header('Location: index.php');
                echo "User verified, Access granted.";
            } else {
                echo "Incorrect username or password";
            }
        } else {
            echo "Logging data is missing. Please enter username and password";

        }
    }

    public function Register($name, $pass)
    {
        if (!empty($name) && !empty($pass)) {
            $params = array(":login" => $name, ":pass" => $pass);
            $SQL = "INSERT INTO users (name,pass,isAdmin)values (:login, :pass, '0');";
            $DBQuery = $this->db->Insert($SQL, $params);
            var_dump($DBQuery);

        } else {
            echo "Logging data is missing. Please enter username and password";

        }
    }
}