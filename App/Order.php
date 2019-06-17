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

    public function FetchOrder($order_id)
    {
        if (!empty($order_id)) {
            $params = array(":o_id" => $order_id);
            $SQL = "SELECT * FROM shop_order,user where order_id = :o_id AND shop_order.user_id = user.user_id";
            $DBQuery = $this->db->Select($SQL, $params);
            $result = null;
            if (count($DBQuery) > 0)
                $result = $DBQuery;
            return $result;
        } else {
            $params = null;
            $SQL = "SELECT * FROM shop_order,user where shop_order.user_id = user.user_id";
            $DBQuery = $this->db->Select($SQL, $params);
            $result = null;
            if (count($DBQuery) > 0)
                $result = $DBQuery;
            return $result;
        }
    }

    public function UpdateOrder($order_id, $client_id, $orderdate, $option, $t_price)
    {
        if (!empty($order_id) && !empty($client_id) && !empty($orderdate) && !empty($option) && !empty($t_price)) {
            $params = array("o_id" => $order_id, "c_id" => $client_id, "o_date" => $orderdate, "option" => $option, "t_price" => $t_price);
            $SQL = "UPDATE shop_order set user_id = :c_id, orderdate = :o_date, type_delivery = :option, total_price = :t_price WHERE order_id = :o_id";
            $DBQuery = $this->db->Update($SQL, $params);
            RedirectHandler::HTTP_301('dashboard_admin_orders');
        } else {
            echo "no form sended";
        }
    }

    public function DeleteOrder($o_id)
    {
        if (!empty($o_id)) {
            $params = array(":o_id" => $o_id);
            $SQL = "DELETE FROM shop_order WHERE order_id = :o_id;";
            $DBQuery = $this->db->Delete($SQL, $params);
        }
    }

    public function createOrderHistory($order_id, $user_id)
    {
        if (!empty($order_id) && !empty($user_id)) {
            foreach ($_SESSION['cart_inventory'] as $cart_data) {
                $params = array(':order_id' => $order_id, ':user_id' => $user_id, ':p_id' => $cart_data['p_id'], 'p_qty' => $cart_data['p_qty']);
                $SQL = "INSERT INTO shop_client_history (history_id, order_id, user_id, id_product, order_quantity) VALUES ((SELECT UUID()),:order_id,:user_id,:p_id,:p_qty)";
                $DBquery = $this->db->Insert($SQL, $params);
            }
            RedirectHandler::HTTP_301('thank-you');
        } else {
            echo "NO ORDER/USER ID";
        }
    }

    public function FetchOrderHistory()
    {
        $params = null;
        $SQL = "SELECT * FROM shop_order,shop_client_history,user,product,category where shop_client_history.user_id = user.user_id AND shop_order.user_id = user.user_id AND shop_client_history.order_id = shop_order.order_id AND shop_client_history.id_product = product.id_product and product.category_id = category.category_id";
        $DBQuery = $this->db->Select($SQL, $params);
        $result = null;
        if (count($DBQuery) > 0)
            $result = $DBQuery;
        return $result;
    }

    public function DeleteOrderHistory($oh_id)
    {
        if (!empty($oh_id)) {
            $params = array(":oh_id" => $oh_id);
            $SQL = "DELETE FROM shop_client_history WHERE history_id = :oh_id;";
            $DBQuery = $this->db->Delete($SQL, $params);
        }
    }
}
