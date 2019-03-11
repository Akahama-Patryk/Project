<?php
/**
 * Created by PhpStorm.
 * User: orel9
 * Date: 10-3-2019
 * Time: 15:41
 */

class ShoppingCart
{
    private $db;

    public function __construct()
    {
        include_once ('DB.php');
        $this->db = new DB();
    }
    public static function cartInventory(){
        if(isset($_SESSION['cart_inventory']) && (!empty($_SESSION['cart_inventory']))){
            foreach ($_SESSION['cart_inventory'] as $item) {
                if (is_array($item) || is_object($item)){
                    foreach ($item as $key => $value){
                        echo $key . " " . $value;
                        echo "<br />";
                    }
                }
            }
            return true;
        }else{
            echo "Shopping Cart is empty. Please full it up!";
            return false;
        }
    }
    public function fetchCartInventory($stuff){
        if (!empty($stuff)) {
            foreach ($stuff as $stuffs) {
                $params = array(":id" => $stuffs['p_id']);
                $SQL = "SELECT * FROM `product`,`category` where id_product = :id AND product.category_id = category.category_id;";
                $DBQuery = $this->db->Select($SQL, $params);
                $result3 = null;
                var_dump($DBQuery);
                if (count($DBQuery) > 0)
                    $result3 = $DBQuery;
                return $result3;
            }
        }else{
            echo "there is nothing to fetch kiddo";
        }
    }
    public static function addToCart($p_id,$p_qty){
        if(!empty($p_id && $p_qty)) {
            if (isset($_SESSION['cart_inventory']) && (!empty($_SESSION['cart_inventory']))){
                if (array_search($p_id, array_column($_SESSION['cart_inventory'], 'p_id'))){
                }else{
                    $_SESSION['cart_inventory'][] = array(
                      "p_id" => $p_id, "p_qty" => $p_qty
                    );
                }
            }else{
                $_SESSION['cart_inventory'] = array(
                    "p_id" => $p_id, "p_qty" => $p_qty
                );
            }
        }
        header('Location: index.php');
    }
    public static function updateCart(){

    }
    public static function deleteCart(){

    }
}