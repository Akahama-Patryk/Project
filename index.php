<?php
include_once("App/Autoloader.php");
Autoloader::sessionStarter();
$results = array();
$results2 = array();
$items = new ShoppingCart();
$products = new Product();
// Add product.
if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['user_quantity'])) {
    ShoppingCart::addToCart($_POST['product_id'], $_POST['product_name'], $_POST['product_price'], $_POST['user_quantity']);
}
// Remove product.
if (isset($_GET['RemoveProduct'])) {
    ShoppingCart::deleteCartProduct($_GET['RemoveProduct']);
    RedirectHandler::HTTP_301($_SERVER['SCRIPT_NAME']);
}
// Empty cart.
if (isset($_GET['EmptyCart'])) {
    ShoppingCart::emptyCart();
    RedirectHandler::HTTP_301($_SERVER['SCRIPT_NAME']);
}
// Update quantity
if (isset($_POST['new_user_quantity']) && ($_POST['id_for_new_qty'])) {
    ShoppingCart::updateCartProduct($_POST['id_for_new_qty'], $_POST['new_user_quantity']);
}
// Search bar
if (isset($_GET['SearchProduct']) && (!empty($_GET['SearchProduct']))) {
    $results = $products->GetProduct(null, $_GET['SearchProduct']);
} else {
// Filter
    if (isset($_GET['ProductFilter']) && (!empty($_GET['ProductFilter']))) {
        $results = $products->GetProduct($_GET['ProductFilter'], null);
    } else {
        $results = $products->GetProduct();
    }
}
$results2 = $products->GetCategory();
?>
<html>
<head>
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style/cookie_warning_style.css">
</head>
<body>
<ul class="nav nav-pills nav-fill rounded-0">
    <li class="nav-item">
        <a class="nav-link active" href="index.php">Homepage</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="login.php">Login page</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contact Page</a>
    </li>
    <li class="nav-item">
        <?php
        if (User::AdminStatus() === true) {
            echo '<a class="nav-link" href="dashboard_admin.php">Dashboard Admin</a>';
        } else {
            echo '<a class="nav-link" href="dashboard.php">Dashboard</a>';
        };
        ?>
    </li>
    <form class="form-inline md-form form-sm active-cyan-2 m-0" action="?SearchProduct=" method="get">
        <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Zoek product"
               name="SearchProduct" aria-label="Search"<input id="submit" type="submit" <i class="fas fa-search"
                                                                                           aria-hidden="true"></i>
    </form>
    <a href="shopping_cart.php" class="btn btn-danger align-items-md-end float-right">Go to shopping cart 🛒</a>
    <?php
    if (User::LoginStatus() == true) {
        echo '<a href="login.php" class="btn btn-primary align-items-md-end float-right">Log Out</a>';
    } else {
        echo '<a href="login.php" class="btn btn-primary align-items-md-end float-right">Log In</a>';
    }
    ?>
</ul>
<ul class="list-group-item">
    <?php
    foreach ($results2 as $row) :
        ?>
        <a class="list-group-item d-xl-inline-flex p-2 justify-content-between align-items-center"
           href='?ProductFilter=<?= $row["category_name"] ?>'><?= $row["category_name"] ?>
            <span class="badge badge-primary badge-pill"><?= $row["quantity_products"] ?></span>
        </a>
    <?php
    endforeach;
    ?>
</ul>
<div class="container">
    <div class="row">
        <?php
        if ($results !== null)
            foreach ($results as $record) :
                ?>
                <div class="col-sm-6">
                    <div class="card" style="width: 18rem;">
                        <img class="img-thumbnail align-self-center" style="width:100px;height:100px;"
                             src="<?= $record["image"] ?>" alt="Missing image data">
                        <div class="card-body">
                            <h5 class="card-title"><?= $record["name"] ?></h5>
                            <p class="card-text">
                                Category: <?= $record["category_id"] ?> <?= $record["category_name"] ?></p>
                            <p class="card-text">Description: <?= $record["description"] ?></p>
                            <p class="card-text">In stock: <?= $record["quantity"] ?></p>
                            <p class="card-text">Price in € <?= $record["price"] ?></p>
                            <form method="POST">
                                <input type="hidden" class="product_id" name="product_id"
                                       value="<?= $record["id_product"] ?>">
                                <input type="hidden" class="product_name" name="product_name"
                                       value="<?= $record["name"] ?>">
                                <input type="hidden" class="product_price" name="product_price"
                                       value="<?= $record["price"] ?>">
                                <input class="form-control product_quantity" type="number" min="1"
                                       max="<?= $record["quantity"] ?>" name="user_quantity" value="1" required>
                                <button type="submit" class="btn btn-primary align-items-md-end" name="submit">Buy it
                                    🛒
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        ?>
    </div>
</div>
<?php
if (isset($_SESSION['cart_inventory'])) {
    ShoppingCart::cartInventory();
} else {
    echo "Shopping Cart is empty. Please full it up!";
}
?>
<div id="cookieConsent">
    <div id="closeCookieConsent">x</div>
    This website is using cookies. <a href="http://www.whatarecookies.com/" target="_blank">More info</a>. <a class="cookieConsentOK">I accept</a>
</div>
<script type="text/javascript" src="script/jquery-3.3.1.js"></script>
<script type="text/javascript" src="script/font-awesome/font-awesome.js"></script>
</body>
</html>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $("#cookieConsent").fadeIn(200);
        }, 4000);
        $("#closeCookieConsent, .cookieConsentOK").click(function () {
            $("#cookieConsent").fadeOut(200);
        });
    }); </script>
