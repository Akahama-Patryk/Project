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
        $subtotaldata = null;
        $deliverprice = 4.65;
        if (isset($_SESSION['valid_code']) && $_SESSION['valid_code'] !== false) {
            $deliverprice = 0;
        }
        $totaldata = null;
        foreach ($_SESSION['cart_inventory'] as $item) {
            $productmultiplier = $item['p_price'] * $item['p_qty'];
            $subtotaldata += $productmultiplier;
            $totaldata = $deliverprice + $subtotaldata / 100 * 121;
            $_SESSION['payment_data'] = array('subtotal' => number_format($subtotaldata, 2), 'deliverprice' => number_format($deliverprice, 2), 'totalprice' => number_format($totaldata, 2));
        }
        if (isset($_SESSION['cart_inventory']) && (!empty($_SESSION['cart_inventory']))) {
            echo "<div class='col-md-12'>";
            echo "<table class='table'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th hidden scope='col'>Product id</th>";
            echo "<th scope='col'>Product Image</th>";
            echo "<th scope='col'>Product name</th>";
            echo "<th scope='col'>Product description</th>";
            echo "<th scope='col'>Aantal</th>";
            echo "<th scope='col'>Price</th>";
            echo "<th scope='col'><a href='?EmptyCart=1'>Empty cart</a></th>";
            echo "</tr>";
            echo "<tbody>";
            foreach ($_SESSION['cart_inventory'] as $item) {
                $productmultiplier = $item['p_price'] * $item['p_qty'];
                echo "<tr>";
                if (is_array($item) || is_object($item)) {
                    echo "<td hidden>" . $item['p_id'] . "</td>";
                    echo "<td><img class='img-thumbnail align-self-center' style='width:100px;height:100px;'
                             alt='Missing image data' src=img/" . $item['p_img'] . "></td>";
                    echo "<td>" . $item['p_name'] . "</td>";
                    echo "<td>" . $item['p_desc'] . "</td>";
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='id_for_new_qty'
                                   value=" . $item['p_id'] . ">";
                    echo "<td><input class='btn-sm' type='number' name='new_user_quantity' value=" . $item['p_qty'] . ">
                                <button type='submit' class='btn btn-primary align-items-md-end' name='submit'><i class='fas fa-sync'></i></button></td>";
                    echo "</form>";
                    echo "<td>€ " . number_format($productmultiplier, 2) . "</td>";
                    echo "<td><a class='btn btn-primary align-items-md-end' href='?RemoveProduct=" . $item['p_id'] . "'>Delete product from 🛒</a></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            if (strpos($_SERVER['REQUEST_URI'], 'shoppingcart') !== false || strpos($_SERVER['REQUEST_URI'], 'orderingpage')) {
                echo "<h4>Subtotal: € " . number_format($subtotaldata, 2) . "</h4>";
                echo "<h4>Delivery cost: € " . number_format($deliverprice, 2) . "</h4>";
                echo "<h4>Total Price: € " . number_format($totaldata, 2) . "</h4>";
            } else {
                echo "<br>";
            }
        } else {
            echo "Shopping Cart is empty. Please full it up!";
        }
    }

    public static function addToCart($p_id, $p_desc, $p_img, $p_name, $p_price, $p_qty)
    {
        if (!isset($_SESSION['cart_inventory'])) {
            $_SESSION['cart_inventory'] = array();
        }

        if (!empty($p_id && $p_desc && $p_img && $p_name && $p_price && $p_qty)) {
            $new_item = array(
                'p_id' => $p_id,
                'p_desc' => $p_desc,
                'p_img' => $p_img,
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

    public function checkCoupon($c_code, $currentdate = null)
    {
        if (!empty($c_code) && !empty($currentdate)) {
            $params = array(':c_code' => $c_code);
            $SQL = "SELECT * FROM coupon_code WHERE coupon_code = :c_code";
            $DBQuery = $this->db->Select($SQL, $params);
            if (count($DBQuery) === 1) {
                $params = array(':c_code' => $c_code, ":currentdate" => $currentdate);
                $SQL = "SELECT * FROM coupon_code WHERE coupon_code = :c_code AND expire_date >= :currentdate";
                $DBQuery2 = $this->db->Select($SQL, $params);
                if (count($DBQuery2) === 1) {
                    echo "Congratulations!!! You acquired free delivery/pick-up discount.";
                    return $_SESSION['valid_code'] = true;
                } else {
                    echo "This coupon code has expired! Please try different one!";
                }
            } else {
                echo "Incorrect coupon code. Please try different one!";
            }
        } else {
            echo "there is no code given";
        }
    }
}