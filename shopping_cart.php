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
if (isset($_POST['new_user_quantity']) && ($_POST['id_for_new_qty'])) {
    ShoppingCart::updateCartProduct($_POST['id_for_new_qty'], $_POST['new_user_quantity']);
}
if (isset($_POST['option']) && (!empty($_POST['option']))){
    setcookie('cookie_option', $_POST['option'], time() + (86400 * 30), "/");
}
?>
<html>
<head>
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
</head>
<body>
<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
        <a class="nav-link" href="home">Homepage</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="login">Login page</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contact Page</a>
    </li>
    <li class="nav-item">
        <?php
        if (User::AdminStatus() === true) {
            echo '<a class="nav-link" href="dashboard_admin">Dashboard Admin</a>';
        } else {
            echo '<a class="nav-link" href="dashboard">Dashboard</a>';
        };
        ?>
    </li>
</ul>
<h1>Shopping Cart</h1>
<?php
if (isset($_SESSION['cart_inventory'])) {
    ShoppingCart::cartInventory();
} else {
    echo "Shopping Cart is empty. Please full it up!";
}
?>
<!--//To diffrent page send-->
<h6>Producten afhalen of bezorgen</h6>
<form method="post">
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="option"
               id="inlineCheckbox1" value="pickup">
        <label class="form-check-label" for="inlineCheckbox1">Producten Afhalen</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="option"
               id="inlineCheckbox2" value="deliver">
        <label class="form-check-label" for="inlineCheckbox2">Producten Bezorgen</label>
    </div>
    <button type="submit" name="submit" class="btn btn-success btn-lg float-right">Next
    </button>
</form>
<script type="text/javascript" src="script/font-awesome/font-awesome.js"></script>
</body>
</html>
