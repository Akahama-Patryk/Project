<?php

class Product
{
    private $db;

    public function __construct()
    {
        include_once('DB.php');
        $this->db = new DB();
    }

    public function GetProduct($filter_category = null)
    {
        if ($filter_category !== null) {
            $filter_category = str_replace('&20', ' ', $filter_category);
            $params = array(":filter" => $filter_category);
            $SQL = "SELECT * FROM `product`,`category` where product.category_id = category.category_id AND category_name = :filter;";
        } else {
            $params = null;
            $SQL = "SELECT * FROM `product`,`category` where product.category_id = category.category_id;";
        }
        $DBQuery = $this->db->Select($SQL, $params);
        $result = null;
        if (count($DBQuery) > 0)
            $result = $DBQuery;
        return $result;
    }

    public function GetCategory()
    {
        $params = null;
        $SQL = "SELECT category_name,COUNT('product') as quantity_products FROM category, product WHERE category.category_id = product.category_id GROUP BY category_name;";
        $DBQuery = $this->db->Select($SQL, $params);
        $result2 = null;
        if (count($DBQuery) > 0)
            $result2 = $DBQuery;
        return $result2;
    }
}