<?php
include_once("App/Autoloader.php");
Autoloader::sessionStarter();
$results = array();
$results2 = array();
$items = new ShoppingCart();
$products = new Product();
if (isset($_GET['ProductFilter']) && (!empty($_GET['ProductFilter']))) {
    $results = $products->GetProduct($_GET['ProductFilter']);
} else {
    $results = $products->GetProduct();
}
$results2 = $products->GetCategory();

?>
<html>
<head>
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
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
    <form class="form-inline md-form form-sm active-cyan-2 m-0" method="get">
        <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search" aria-label="Search">
        <i class="fas fa-search" aria-hidden="true"></i>
    </form>
    <a href="shopping_cart.php" class="btn btn-danger align-items-md-end float-right">Go to shopping cart 🛒</a>
    <?php
    if (User::LoginStatus() == true) {
        echo '<a href="login.php" class="btn btn-primary align-items-md-end float-right">Log Off</a>';
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
<?php
ShoppingCart::cartInventory();
?>
<div class="container">
    <div class="row">
        <?php
        foreach ($results as $record) :
            ?>
            <div class="col-sm-6">
                <div class="card" style="width: 18rem;">
                    <img class="img-thumbnail align-self-center" style="width:100px;height:100px;"
                         src="<?= $record["image"] ?>" alt="Missing image data">
                    <div class="card-body">
                        <h5 class="card-title"><?= $record["name"] ?></h5>
                        <p class="card-text">Category: <?= $record["category_id"] ?> <?= $record["category_name"] ?></p>
                        <p class="card-text">Description: <?= $record["description"] ?></p>
                        <p class="card-text">In stock: <?= $record["quantity"] ?></p>
                        <p class="card-text">Price in € <?= $record["price"] ?></p>
                        <form action="add_shopping_cart.php" method="GET">
                            <input type="hidden" class="product_id" name="product_id"
                                   value="<?= $record["id_product"] ?>">
                            <input class="form-control product_quantity" type="number" min="1"
                                   max="<?= $record["quantity"] ?>" name="user_quantity" value="1" required>
                            <button type="submit" class="btn btn-primary align-items-md-end" name="submit">Buy it
                                🛒</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="script/jquery-3.3.1.js"></script>
<?php
if (isset($_GET['remove_p_id'])){
    ShoppingCart::deleteCartProduct($_GET['remove_p_id']);
}
// Empty cart.
if (isset($_GET['empty_cart'])) {
    ShoppingCart::emptyCart();
}
?>

