<?php
include_once("App/Autoloader.php");
Autoloader::sessionStarter();
//confirms post data from index.php
if (isset($_POST['submit'])) {
    $_SESSION['p_id'] = $_POST['product_id'];
    $_SESSION['qty'] = $_POST['user_quantity'];
}else{
    echo "I DID NOT SAVE!!!";
}
//checks if data exist in session which gets but only from one which is enough.
if(isset($_SESSION['p_id']) && isset($_SESSION['qty'])){
    $p_id = $_SESSION['p_id'];
    $qty = $_SESSION['qty'];
    echo "Data gottem";
    var_dump($_SESSION['p_id'],$_SESSION['qty'],$_SESSION['cart_inventory']);
    ShoppingCart::addToCart($p_id,$qty);
    ShoppingCart::cartInventory();

}else{
    header('Location: index.php');
}