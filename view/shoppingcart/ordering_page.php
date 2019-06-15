<?php
include_once("../../App/Autoloader.php");
Autoloader::sessionStarter();
if (isset($_POST['option']) && (!empty($_POST['option']))){
    setcookie('cookie_option', $_POST['option'], time() + (86400 * 30), "/");
}
?>
<!--//HERE FINDS USER INFO IF LOGGED ON ELSE NONE : FORM-->
<!--//CHOICE OF ORDER-->
<!--//SUBTOTAL , BTW 21% AND TOTAL.-->
<!--//BUTTON WHEN USED IT TRANSFERS TO SEPARATE PAGE WHICH SHUTS DOWN SHOPPING CART SESSION-->
<!--//HERE YOU FIND THE COOKIE THAT WILL BE SAVE IN DATABASE TO ORDER-->
<!--//ORDER-> WHAT DATA SHOULD BE NEEDED??-->
<!--//SHOPPING CART SHOULD BE SAVED TOO??-->
<!--//COUPON CHECK when posted it gets verified-->
<!---->
<!---->
<!--//Bestelling(History): Bestelling_ID(PK), order_ID(FK)-->
<!--//-->
<!---->
<!--//Order: order_id(PK),user_ID(FK),Bestelling_ID(FK)-->
<!--//order which saves data that user brought somethings HERE-->
<!---->
<!--//to unset CART-> different page should be used-->
<!--//unset($_SESSION['cart_inventory']);-->
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
<h1>Shopping Cart????</h1>
<?php
//if (isset($_SESSION['cart_inventory'])) {
//    ShoppingCart::cartInventory();
//} else {
//    echo "Shopping Cart is empty. Please full it up!";
//}
//?>
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
