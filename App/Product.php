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
            $SQL = "SELECT * FROM `product`,`category` where product.category_id = category.category_id ;";
            $DBQuery = $this->db->Select($SQL, $params);
            $result = null;
            if(count($DBQuery) > 0)
                $result = $DBQuery;
            return $result;
    }
    public function GetCategory(){
        $params = null;
        $SQL = "SELECT category_name FROM category`;";
        $DBQuery = $this->db->Select($SQL, $params);
        $result2 = null;
        if(count($DBQuery) > 0)
            $result2 = $DBQuery;
        return $result2;
    }
}