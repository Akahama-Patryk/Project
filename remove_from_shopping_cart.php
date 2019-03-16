<?php
include_once ('App/Autoloader.php');
Autoloader::sessionStarter();

//Remove item from cart.
if (isset($_GET['remove_p_id'])){
    ShoppingCart::deleteCartProduct($_GET['remove_p_id']);
}else{
    header('Location: index.php');
    die;
}