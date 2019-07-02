<?php


class MarketingSession
{
    private $db;
    private $browser;
    private $ip;

    public function __construct()
    {
        include_once('DB.php');
        $this->db = new DB();
        $this->browser = $_SERVER['HTTP_USER_AGENT'];
        $this->ip = self::getUserIpAddr();
    }

    function getUserIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function getUserInfo($user_name)
    {
        if (!empty($user_name)) {
            $params = array(":user_name" => $user_name);
            $SQL = "SELECT * from user where name = :user_name";
            $DBQuery = $this->db->Select($SQL, $params);
            if (count($DBQuery) === 1) {
                $this->user_data = $DBQuery;
                return $DBQuery;
            }
        }
    }

    public function saveDatatoSession($status,$user_data = null)
    {
        if (!empty($user_data)) {
            $ip_address = $this->ip;
            $browser = $this->browser;
            $_SESSION['marketingsession'] = array();
            if (empty($_SESSION['marketingsession'])) {
                $new_item = array(
                    'user_data' => $user_data,
                    'ip_address' => $ip_address,
                    'browser' => $browser,
                    'loggedin' => $status
                );
                $_SESSION['marketingsession'][] = $new_item;
            }
        }else{
            $ip_address = $this->ip;
            $browser = $this->browser;
            $_SESSION['marketingsession'] = array();
            if (empty($_SESSION['marketingsession'])) {
                $new_item = array(
                    'ip_address' => $ip_address,
                    'browser' => $browser,
                    'loggedin' => $status
                );
                $_SESSION['marketingsession'][] = $new_item;
            }

        }
    }
}