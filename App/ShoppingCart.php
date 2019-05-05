<?php

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
        //Total price to pay
        $totaldata = null;
        foreach ($_SESSION['cart_inventory'] as $item) {
            $productmultiplier = $item['p_price'] * $item['p_qty'];
            $totaldata += $productmultiplier;
        }
        if (isset($_SESSION['cart_inventory']) && (!empty($_SESSION['cart_inventory']))) {
            echo "<div class='col-md-12'>";
            echo "<table class='table'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th scope='col'>Product id</th>";
            echo "<th scope='col'>Product name</th>";
            echo "<th scope='col'>Product price per count</th>";
            echo "<th scope='col'>Aantal</th>";
            echo "<th scope='col'><a href='?EmptyCart=1'>Empty cart</a></th>";
            echo "</tr>";
            echo "<tbody>";
            foreach ($_SESSION['cart_inventory'] as $item) {
                echo "<tr>";
                if (is_array($item) || is_object($item)) {
                    echo "<td>" . $item['p_id'] . "</td>";
                    echo "<td>" . $item['p_name'] . "</td>";
                    echo "<td>€ " . $item['p_price'] . "</td>";
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='id_for_new_qty'
                                   value=" . $item['p_id'] . ">";
                    echo "<td><input class='btn-sm' type='number' name='new_user_quantity' value=" . $item['p_qty'] . ">
                                <button type='submit' class='btn btn-primary align-items-md-end' name='submit'><i class='fas fa-sync'></i></button></td>";
                    echo "</form>";
                    echo "<td><a class='btn btn-primary align-items-md-end' href='?RemoveProduct=" . $item['p_id'] . "'>Delete product from 🛒</a></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            echo "<h4>Total price of your Shopping Cart is : € " .  number_format($totaldata, 2)  . "</h4>";
        } else {
            echo "Shopping Cart is empty. Please full it up!";
        }
    }

    public static function addToCart($p_id, $p_name, $p_price, $p_qty)
    {
        if (!isset($_SESSION['cart_inventory'])) {
            $_SESSION['cart_inventory'] = array();
        }

        if (!empty($p_id && $p_name && $p_price && $p_qty)) {
            $new_item = array(
                'p_id' => $p_id,
                'p_name' => $p_name,
                'p_price' => $p_price,
                'p_qty' => $p_qty
            );

            $item_exist = self::checkCartForItem($p_id, $_SESSION['cart_inventory']);

            if ($item_exist !== false) {
                $_SESSION['cart_inventory'][$item_exist]['p_qty'] = $p_qty + $_SESSION['cart_inventory'][$item_exist]['p_qty'];
            } else {
                $_SESSION['cart_inventory'][] = $new_item;
            }
        }
    }

    public static function updateCartProduct($update_p_id, $update_p_qty)
    {
        if (!empty($update_p_id) && (!empty($update_p_qty))) {
            $item_exist = self::checkCartForItem($update_p_id, $_SESSION['cart_inventory']);
            if ($item_exist !== false) {
                $_SESSION['cart_inventory'][$item_exist]['p_qty'] = $update_p_qty;
            } else {
                var_dump($_SESSION['cart_inventory'][$item_exist]);
            }
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
    }

    public static function emptyCart()
    {
        if (isset($_SESSION['cart_inventory'])) {
            unset($_SESSION['cart_inventory']);
        }
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