<?php
include_once("App/Autoloader.php");
Autoloader::sessionStarter();
if (isset($_GET['RemoveProduct'])) {
    ShoppingCart::deleteCartProduct($_GET['RemoveProduct']);
    RedirectHandler::HTTP_301($_SERVER['SCRIPT_NAME']);
}
// Empty cart.
if (isset($_GET['EmptyCart'])) {
    ShoppingCart::emptyCart();
    RedirectHandler::HTTP_301($_SERVER['SCRIPT_NAME']);
}
?>
<h1>Hello there</h1>
<?php
ShoppingCart::cartInventory();
?>
<html>
<head>
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
</head>
<body>
</body>
</html>
