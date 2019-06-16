<?php
$current_date_filter = date("Y-m-d");
include_once("../../App/Autoloader.php");
Autoloader::sessionStarter();
if (isset($_GET['RemoveProduct'])) {
    ShoppingCart::deleteCartProduct($_GET['RemoveProduct']);
    RedirectHandler::HTTP_301('shoppingcart');
}
// Empty cart.
if (isset($_GET['EmptyCart'])) {
    ShoppingCart::emptyCart();
    RedirectHandler::HTTP_301('shoppingcart');
}
if (isset($_POST['new_user_quantity']) && ($_POST['id_for_new_qty'])) {
    ShoppingCart::updateCartProduct($_POST['id_for_new_qty'], $_POST['new_user_quantity']);
}
if (isset($_POST['couponcode']) && ($_POST['couponcode'])) {
    $couponcode = new ShoppingCart();
    $checkcouponcode = $couponcode->checkCoupon($_POST['couponcode'], $current_date_filter);
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
<br>
<label>Discount code/Couponcode</label>
<form action='' method='POST'>
    <input class='btn-group-sm' type='text' name='couponcode' value=''>
    <button type='submit' class='btn btn-primary align-items-sm-start' name='submit2'>Send</button>
</form>
<?php
if (!empty($_SESSION['cart_inventory'])) {
    echo "<a class='btn btn-primary float-right' href='orderingpage'>Continue with order</a>";
} else {
    echo "<a class='btn btn-primary float-right' href='home'>Continue with shopping</a>";
}
?>
<script type="text/javascript" src="script/font-awesome/font-awesome.js"></script>
</body>
</html>
