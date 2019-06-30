<?php


class Coupon
{
    private $db;

    public function __construct()
    {
        include_once('DB.php');
        $this->db = new DB();
    }

    public function GetCoupon($q_nr = null)
    {
        if (!empty($q_nr)) {
            $params = array(":q_nr" => $q_nr);
            $SQL = "SELECT * FROM coupon_code WHERE coupon_code = :q_nr ;";
            $DBQuery = $this->db->Select($SQL, $params);
            $result = null;
            if (count($DBQuery) > 0) {
                $result = $DBQuery;
                return $result;
            } else {
                return false;
            }
        } else {
            $params = null;
            $SQL = "SELECT * FROM coupon_code ORDER BY expire_date desc ;";
            $DBQuery = $this->db->Select($SQL, $params);
            $result = null;
            if (count($DBQuery) > 0) {
                $result = $DBQuery;
                return $result;
            } else {
                return false;
            }
        }
    }

    public function addCoupon($c_name, $expire_date)
    {
        if (!empty($c_name) && !empty($expire_date)) {
            $params = array(":c_name" => $c_name, ":expire_date" => $expire_date);
            $SQL = "INSERT INTO coupon_code (coupon_code,expire_date) values (:c_name,:expire_date)";
            $DBQuery = $this->db->Insert($SQL, $params);
            RedirectHandler::HTTP_301('dashboard_admin_coupons');
        } else {
            echo "empty form.";
        }
    }
}