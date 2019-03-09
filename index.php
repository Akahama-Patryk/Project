<?php
include_once("App/Autoloader.php");
Autoloader::sessionStarter();
$results = array();
$results2 = array();
$products = new Product();
$results = $products->GetProduct();
$results2 = $products->GetCategory();
?>
<html>
<head>
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
        <a class="nav-link" href="dashboard.php">Dashboard</a>
    </li>
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
        <li class="list-group-item d-xl-inline-flex p-2 justify-content-between align-items-center">
            <?= $row["category_name"] ?>
            <span class="badge badge-primary badge-pill"><?= $row["quantity_products"] ?></span>
        </li>
    <?php
    endforeach;
    ?>
</ul>
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
                        <input type="hidden" class="product_id" name="product_id" value="<?= $record["id_product"]?>"
                        <h5 class="card-title"><?= $record["name"] ?></h5>
                        <p class="card-text">Category: <?= $record["category_id"] ?> <?= $record["category_name"] ?></p>
                        <p class="card-text">Description: <?= $record["description"] ?></p>
                        <p class="card-text">In stock: <?= $record["quantity"] ?></p>
                        <p class="card-text">Price in € <?= $record["price"] ?></p>
                        <input class="form-control product_quantity" type="number" min="1" max="<?= $record["quantity"]?>" name="user_quantity" value="1" required>
                        <a href="shopping_cart.php" class="btn btn-primary align-items-md-end addToCart">Buy it 🛒</a>
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
<script>
    $(document).ready(function () {
        $(".addToCart").on("click", function () {
            let id = $(this).find('.product_id').val();
            let quantity = $(this).find('.product_quantity').val();
            window.location.href = "shopping_cart.php?id=" + id + "&quantity" + quantity;
            return false;
        });
    });
</script>

