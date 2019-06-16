<?php


class Order
{
    private $db;

    public function __construct()
    {
        include_once('DB.php');
        $this->db = new DB();
    }

    public function createOrder($user_id, $option, $t_price)
    {
        $current_date = date("Y-m-d");
        if (!empty($user_id) && !empty($option) && !empty($t_price)) {
            $params = array(':user_id' => $user_id, ':option' => $option, 't_price' => $t_price, 'orderdate' => $current_date);
            $SQL = "INSERT INTO shop_order (order_id, user_id, orderdate, type_delivery, total_price) VALUES ((SELECT UUID()),:user_id, :orderdate, :option, :t_price)";
            $DBquery = $this->db->Insert($SQL, $params);
            $params = array(':user_id' => $user_id, ':option' => $option, 't_price' => $t_price, 'orderdate' => $current_date);
            $SQL = "SELECT * from shop_order where user_id = :user_id AND orderdate = :orderdate AND type_delivery = :option AND total_price = :t_price;";
            $DBquery2 = $this->db->select($SQL, $params);
            if (count($DBquery2) === 1) {
                foreach ($DBquery2 as $order_id) {
                    $sendback = $order_id['order_id'];
                    return $sendback;
                }
            } else {
                echo "SECOND FAIL ORDER NOT FOUND/FAIL IN CREATION";
            }
        } else {
            echo "No user/option data";
        }
    }

    public function createOrderHistory($order_id, $user_id)
    {
        if (!empty($order_id) && !empty($user_id)) {
            foreach ($_SESSION['cart_inventory'] as $cart_data) {
                $params = array(':order_id' => $order_id, ':user_id' => $user_id, ':p_id' => $cart_data['p_id'], 'p_qty' => $cart_data['p_qty']);
                $SQL = "INSERT INTO shop_client_history (history_id, order_id, user_id, id_product, order_quantity) VALUES ((SELECT UUID()),:order_id,:user_id,:p_id,:p_qty)";
                $DBquery = $this->db->Insert($SQL,$params);
            }
            RedirectHandler::HTTP_301('thank-you');
        } else {
            echo "NO ORDER/USER ID";
        }
    }
}
