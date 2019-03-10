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
//Now we need to make a session cart which saves all data to one basket to not lose data.
//this will go to App/cart.phpclass
if(isset($_SESSION['p_id']) && isset($_SESSION['qty'])){
    echo "Data gottem";
    var_dump($_SESSION['p_id'],$_SESSION['qty']);
}else{
    echo "Data lost";
}