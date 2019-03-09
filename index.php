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
    foreach ($results2 as $result2) :
        ?>
        <li class="list-group-item d-xl-inline-flex p-2 justify-content-between align-items-center">
            <?= $result2["category_name"] ?>
            <span class="badge badge-primary badge-pill">99</span>
        </li>
    <?php
    endforeach;
    ?>
</ul>
<div class="container">
    <div class="row">
        <?php
        foreach ($results as $result) :
            ?>
            <div class="col-sm-6">
                <div class="card" style="width: 18rem;">
                    <img class="img-thumbnail align-self-center" style="width:100px;height:100px;"
                         src="<?= $result["image"] ?>" alt="Missing image data">
                    <div class="card-body">
                        <h5 class="card-title"><?= $result["name"] ?></h5>
                        <p class="card-text">Category: <?= $result["category_id"] ?> <?= $result["category_name"] ?></p>
                        <p class="card-text">Description: <?= $result["description"] ?></p>
                        <p class="card-text">In stock: <?= $result["quantity"] ?></p>
                        <p class="card-text">Price in € <?= $result["price"] ?></p>
                        <a href="#" class="btn btn-primary align-items-md-end">Buy it 🛒</a>
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

