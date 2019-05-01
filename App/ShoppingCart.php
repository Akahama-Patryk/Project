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
        include_once('DB.php');
        $this->db = new DB();
    }

    public static function cartInventory()
    {
        if (isset($_SESSION['cart_inventory']) && (!empty($_SESSION['cart_inventory']))) {
            echo "<div class='col-md-12'>";
            echo "<table class='table'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th scope='col'>Product id</th>";
            echo "<th scope='col'>Aantal</th>";
            echo "<th scope='col'><a href='?empty_cart=1'>Empty cart</a></th>";
            echo "</tr>";
            echo "<tbody>";
            foreach ($_SESSION['cart_inventory'] as $item) {
                echo "<tr>";
                if (is_array($item) || is_object($item)) {
                    echo "<td>" . $item['p_id'] . "</td>";
                    echo "<td>" . $item['p_qty'] . "</td>";
                    echo "<td><a class='btn btn-primary align-items-md-end' href='?remove_p_id=" . $item['p_id'] . "'>Delete product from 🛒</a></td>";
                }
                echo "</tr>";
            }
        } else {
            echo "Shopping Cart is empty. Please full it up!";
        }
    }

    public static function addToCart($p_id, $p_qty)
    {
        if (!isset($_SESSION['cart_inventory'])) {
            $_SESSION['cart_inventory'] = array();
        }

        if (!empty($p_id && $p_qty)) {
            $new_item = array(
                'p_id' => $p_id,
                'p_qty' => $p_qty
            );

            $item_exist = self::checkCartForItem($p_id, $_SESSION['cart_inventory']);

            if ($item_exist !== false){
                $_SESSION['cart_inventory'][$item_exist]['p_qty'] = $p_qty + $_SESSION['cart_inventory'][$item_exist]['p_qty'];
            }else{
                $_SESSION['cart_inventory'][] = $new_item;
            }
            header('Location: ' . $_SERVER['PHP_SELF']);
            die;
        }
    }
    public static function deleteCartProduct($remove_p_id)
    {
        if (!(empty($remove_p_id)) && isset($_SESSION['cart_inventory'])) {
            $itemExist = self::checkCartForItem($remove_p_id, $_SESSION['cart_inventory']);

            if ($itemExist !== false) {
                unset($_SESSION['cart_inventory'][$itemExist]);
            }
        }
        die;
    }

    public static function emptyCart()
    {
     if (isset($_SESSION['cart_inventory'])){
         unset($_SESSION['cart_inventory']);
     }
     header('Location: index.php');
     die;
    }

    protected static function checkCartForItem($cart_p_id, $cart_items)
    {
        if (is_array($cart_items)) {
            foreach ($cart_items as $key => $item) {
                if ($item['p_id'] === $cart_p_id)
                    return $key;
            }
        }
        return false;
    }

}