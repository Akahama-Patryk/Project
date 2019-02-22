<?php
//Fix database or make new one {Shit framework}
include "../classdatabaseICTAC.php";

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function Login($name, $pass){
        if(!empty($name) && !empty($pass)){
            $dbquery = $this->db->prepare("select * from users where name=? and pass=?");
            $dbquery->bindParam(1, $name);
            $dbquery->bindParam(2, $pass);
            $dbquery->execute();

            if($dbquery->rowCount() == 1){
                echo "User verified, Access granted.";
            }else{
                echo "Incorrect username or password";
            }
            }else{
                echo "Logging data is missing. Please enter username and password";

        }
    }

}