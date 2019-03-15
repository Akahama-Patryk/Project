<?php
include_once("App/Autoloader.php");
Autoloader::sessionStarter();
if(isset($_GET['product_id']) && isset($_GET['user_quantity'])){
    ShoppingCart::addToCart($_GET['product_id'],$_GET['user_quantity']);
}else{
    header('Location: index.php');
    die;
}