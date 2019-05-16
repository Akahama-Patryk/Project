<?php

class Product
{
    private $db;

    public function __construct()
    {
        include_once('DB.php');
        $this->db = new DB();
    }

    public function GetProduct($data = null, $filter_flag = false)
    {
        $search_product = null;
        $filter_category = null;
        if (is_string($data)) {
            $search_product = $data;
        }
        if(is_string($data) && $filter_flag)
        {
            $filter_category = $data;
            $search_product = null;
        }
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
        }
        if ($filter_category !== null) {

            $params = array(":filter" => $data);
            $SQL = "SELECT * FROM `product`,`category` where product.category_id = category.category_id AND category_name = :filter";
            /*
            $params = array();
            $SQL = "";
            $i = 1;
            $var = "temp";
            foreach ($filter_category as $category)
            {
                ${"{$var}{$i}"} = $var.$i;
                $params[":".${"{$var}{$i}"}] = $category;
                $SQL .= "SELECT * FROM `product`,`category` where product.category_id = category.category_id AND category_name = :{$var}{$i}";
                if($i !== count($filter_category))
                {
                    $SQL .= " UNION ALL ";
                }
                $i++;
            }
            */
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