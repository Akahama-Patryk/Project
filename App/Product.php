<?php

class Product
{
    private $db;

    public function __construct()
    {
        include_once('DB.php');
        $this->db = new DB();
    }

    public function GetProduct($filter_category = null, $search_product = null)
    {
        if ($search_product !== null) {
            $search_product = "%" . $search_product;
            $search_product = str_replace(' ', '%', $search_product);
            $search_product .= "%";
            $params = array(":search_product" => $search_product);
            $SQL = "SELECT * FROM `product`,`category` where product.name LIKE :search_product AND product.category_id = category.category_id;";
            $DBQuery = $this->db->Select($SQL, $params);
            $result = null;
            if (count($DBQuery) > 0) {
                $result = $DBQuery;
                return $result;
            } else {
                return false;
            }
        } else {
            if ($filter_category !== null) {
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