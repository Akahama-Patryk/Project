<?php
session_start();
$results = array();
include "Class/Product.php";
$products = new Product();
$results = $products->GetProduct();
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
</head>
<body>
    <ul class="nav nav-pills nav-fill">
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
    </ul>
    <div class="container">
        <div class="row">
            <?php
                foreach ($results as $result) :
            ?>
            <div class="col-sm-6">
                <div class="card" style="width: 18rem;">
                    <img class="img-thumbnail align-self-center" style="width:100px;height:100px;" src="<?= $result["image"] ?>" alt="Missing image data">
                    <div class="card-body">
                        <h5 class="card-title"><?= $result["name"] ?></h5>
                        <p class="card-text"><?= $result["description"] ?></p>
                        <p class="card-text"><?= $result["quantity"] ?></p>
                        <p class="card-text">€ <?= $result["price"] ?></p>
                        <a href="#" class="btn btn-primary align-items-md-end">Buy it</a>
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

