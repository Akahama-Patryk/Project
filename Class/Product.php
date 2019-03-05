<?php

class Product
{
    private $db;

    public function __construct()
    {
        include('DB.php');
        $this->db = new DB();
    }

    public function GetProduct(){
            $params = null;
            $SQL = "SELECT * FROM `product`;";
            $DBQuery = $this->db->Select($SQL, $params);
            $result = null;
            if(count($DBQuery) > 0)
                $result = $DBQuery;
            return $result;
    }
}