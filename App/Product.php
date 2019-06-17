<?php

class Product
{
    private $db;

    public function __construct()
    {
        include_once('DB.php');
        $this->db = new DB();
    }

    public function GetProduct($data = null, $filter_flag = false, $id_product = null)
    {
        $search_product = null;
        $filter_category = null;
        if (is_string($data)) {
            $search_product = $data;
        }
        if (is_string($data) && $filter_flag) {
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
        } else {
            $params = null;
            $SQL = "SELECT * FROM `product`,`category` where product.category_id = category.category_id;";
        }
        if ($id_product !== null) {
            $params = array("id_product" => $id_product);
            $SQL = "SELECT * FROM `product`,`category` where product.category_id = category.category_id and product.id_product = :id_product;";
            $DBQuery = $this->db->Select($SQL, $params);
            $result = null;
            if (count($DBQuery) > 0)
                $result = $DBQuery;
            return $result;
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

    public function FetchCategory()
    {
        $params = null;
        $SQL = "SELECT * FROM category ORDER BY category_id ASC;";
        $DBQuery = $this->db->Select($SQL, $params);
        $result = null;
        if (count($DBQuery) > 0)
            $result = $DBQuery;
        return $result;
    }

    public function addCategory($category_id, $category_name)
    {
        if (!empty($category_id) && !empty($category_name)) {
            $params = array(":category_id" => $category_id, ":category_name" => $category_name);
            $SQL = "INSERT INTO category (category_id, category_name) VALUES (:category_id, :category_name)";
            $DBQuery = $this->db->Insert($SQL, $params);
            RedirectHandler::HTTP_301('dashboard_admin_category');
        } else {
            echo "Fill form please";
        }
    }

    public function addProduct($p_name, $p_quantity, $p_price, $p_category, $description, $uploadImage)
    {
        if (!empty($p_name) && !empty($p_quantity) && !empty($p_price) && !empty($p_category) && !empty($description) && !empty($uploadImage)) {
            $params = array(":p_name" => $p_name, ":p_quantity" => $p_quantity, ":p_price" => $p_price, ":p_category" => $p_category, ":description" => $description, ":image" => $uploadImage);
            $SQL = "INSERT INTO product (product_name, quantity, price, image, description, category_id, id_product) VALUES (:p_name, :p_quantity, :p_price, :image, :description, :p_category, (SELECT UUID()))";
            $DBQuery = $this->db->Insert($SQL, $params);
            RedirectHandler::HTTP_301('dashboard_admin_product');
        } else {
            echo "Please fill up the form!!!";
        }
    }
    public function updateProduct($p_id,$p_name, $p_quantity, $p_price, $p_category, $description, $uploadImage)
    {
        if (!empty($p_id) && !empty($p_name) && !empty($p_quantity) && !empty($p_price) && !empty($p_category) && !empty($description) && !empty($uploadImage)) {
            $params = array("p_id" => $p_id, ":p_name" => $p_name, ":p_quantity" => $p_quantity, ":p_price" => $p_price, ":p_category" => $p_category, ":description" => $description, ":image" => $uploadImage);
            $SQL = "Update product set product_name = :p_name, quantity = :p_quantity, price = :p_price, category_id = :p_category, description = :description, image = :image where id_product = :p_id;";
            $DBQuery = $this->db->Update($SQL, $params);
            RedirectHandler::HTTP_301('dashboard_admin_product');
        } else {
            echo "Please fill up the form!!!";
        }
    }

    public function deleteProduct($ID)
    {
        $params = array("ID" => $ID);
        $SQL = "DELETE FROM product WHERE id_product = :ID;";
        $DBQuery = $this->db->Delete($SQL, $params);
    }
}