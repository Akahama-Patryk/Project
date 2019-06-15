<?php
include_once('../../../App/Autoloader.php');
Autoloader::sessionStarter();
$uploadImage = array();
$result = array();
if (empty($_SESSION['login']))
    RedirectHandler::HTTP_301('login');
if ($_SESSION['isAdmin'] == false) {
    RedirectHandler::HTTP_301('dashboard');
};
if (isset($_GET['ID']) && !empty($_GET['ID'])) {
    $data = new Product();
    $dataProduct = $data->GetProduct(null, null, $_GET['ID']);
}
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    foreach ($dataProduct as $row) {
        if (!empty($row['image'] && $row['image'] !== $file)) {
            if (file_exists("../../../img/" . $row['image'])) {
                //if file exist its get deleted and new is made
                unlink("../../../img/" . $row['image']);
                $uploadFile = new Upload($file);
                $uploadImage = $uploadFile->uploadFile();
                $product_name = $_POST['product_name'];
                $p_quantity = $_POST['p_quantity'];
                $p_price = $_POST['p_price'];
                $p_category = $_POST['p_category'];
                $description = $_POST['description'];
                $uploadProduct = new Product();
                $uploadProduct->updateProduct($_GET['ID'],$product_name, $p_quantity, $p_price, $p_category, $description, $uploadImage);
            }else{
                //if file doesnt exist makes new one
                $uploadFile = new Upload($file);
                $uploadImage = $uploadFile->uploadFile();
                $product_name = $_POST['product_name'];
                $p_quantity = $_POST['p_quantity'];
                $p_price = $_POST['p_price'];
                $p_category = $_POST['p_category'];
                $description = $_POST['description'];
                $uploadProduct = new Product();
                $uploadProduct->updateProduct($_GET['ID'],$product_name, $p_quantity, $p_price, $p_category, $description, $uploadImage);
            }
        } else {
            echo "no image found in db";
        }
    }
        $uploadFile = new Upload($file);
        $uploadImage = $uploadFile->uploadFile();
        $product_name = $_POST['product_name'];
        $p_quantity = $_POST['p_quantity'];
        $p_price = $_POST['p_price'];
        $p_category = $_POST['p_category'];
        $description = $_POST['description'];
        $uploadProduct = new Product();
        $uploadProduct->addProduct($product_name, $p_quantity, $p_price, $p_category, $description, $uploadImage);
}
$categoryData = new Product();
$result = $categoryData->FetchCategory();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Project Supermarkt --Dashboard Admin:Product--</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style/admin.css">
</head>
<script type="text/javascript" src="script/font-awesome/font-awesome.js"></script>
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
            echo '<a class="nav-link active" href="dashboard_admin">Dashboard Admin</a>';
        } else {
            echo '<a class="nav-link active" href="dashboard">Dashboard</a>';
        };
        ?>
    </li>
</ul>
<div id="app" class="admin">
    <!-- vertical navbar -->
    <div class="container-fluid">
        <div class="row">
            <nav class="nav flex-column navbar-dark bg-blue-left col-2 pr-0 d-flex">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="dashboard_admin" class="nav-link navbar-brand p-3">
                            <img src="img/admin.png" class="logo" data-toggle="tooltip" data-placement="right"
                                 title="Dashboard Admin"/>
                            Project Supermarkt
                        </a>
                    </li>
                    <li class="nav-item py-1" id="home">
                        <a class="nav-link p-3 font-weight-bold" href="home"><i class="fas fa-home fa-lg mr-2"></i>&nbspHome
                            Page</a>
                    </li>
                    <li class="nav-item py-1" id="dashboard">
                        <a class="nav-link p-3 font-weight-bold" href="dashboard_admin"><i
                                    class="fas fa-chart-line fa-lg mr-2"></i>&nbspDashboard</a>
                    </li>
                    <li class="nav-item py-1" id="users">
                        <a class="nav-link p-3 font-weight-bold" href="dashboard_admin_client"><i
                                    class="fas fa-users fa-lg mr-2"></i>&nbspClient</a>
                    </li>
                    <li class="nav-item py-1
                      id=" product
                    ">
                    <a class="nav-link p-3 font-weight-bold" href="dashboard_admin_product"><i
                                class="fas fa-font fa-lg mr-2"></i>&nbspProduct</a>
                    </li>
                    <li class="nav-item py-1 id=" category
                    ">
                    <a class="nav-link p-3 font-weight-bold" href="dashboard_admin_category"><i
                                class="fas fa-question fa-lg mr-2"></i>&nbspCategory</a>
                    </li>
                    <li class="nav-item py-1 id=" orders
                    ">
                    <a class="nav-link p-3 font-weight-bold" href="dashboard_admin_orders"><i
                                class="fas fa-briefcase fa-lg mr-2"></i>&nbspOrders</a>
                    </li>
                    <li class="nav-item py-1 id=" client_history
                    ">
                    <a class="nav-link p-3 font-weight-bold" href="dashboard_admin_client_history"><i
                                class="fas fa-briefcase fa-lg mr-2"></i>&nbspClient History</a>
                    </li>
                    <li class="nav-item py-1 id=" co_workers
                    ">
                    <a class="nav-link p-3 font-weight-bold" href="dashboard_admin_coworkers"><i
                                class="fas fa-boxes fa-lg mr-2"></i>&nbspCo-workers</a>
                    </li>
                    <li class="nav-item py-1 id=" coupons
                    ">
                    <a class="nav-link p-3 font-weight-bold" href="dashboard_admin_coupons"><i
                                class="fas fa-map-signs fa-lg mr-2"></i>&nbspQR codes/Coupons codes</a>
                    </li>
                    <li class="nav-item py-1 id=" help
                    ">
                    <a class="nav-link p-3 font-weight-bold" href="dashboard_admin_help"><i
                                class="fa fa-question-circle fa-lg mr-2"></i>&nbspHelp</a>
                    </li>
                    <li class="nav-item py-1 id=" sessionreader
                    "> <a class="nav-link p-3 font-weight-bold" href="dashboard_admin_sessionreader"><i
                                class="fa fa-question-circle fa-lg mr-2"></i>&nbspSession Reader</a>
                    </li>
                </ul>
            </nav>
            <div class="col-10 px-0">
                <div class="navbar navbar-dark bg-blue-top justify-content-end">
                    <div class="navbar-nav">
                        <a href="login" class="nav-link font-weight-bold">
                            <i class="fas fa-sign-out-alt fa-lg mr-1"></i> Logout
                        </a>
                    </div>
                </div>
                <main class="px-3 mt-3">
                    <?php
                    if ($dataProduct !== null)
                        foreach ($dataProduct as $row) : ?>
                            <div class="card rounded-0">
                                <div class="card-header">
                                    <h3 class="mb-0">Edit Product</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form" role="form" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="product_name">Name of Product</label>
                                            <input type="text" class="form-control form-control-lg rounded-0"
                                                   name="product_name"
                                                   id="product_name"
                                                   value="<?= $row['name'] ?>" required>
                                            <div class="invalid-feedback">Oops, you missed this one.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity">Product Quantity</label>
                                            <input class='btn-sm' type='number' name='p_quantity'
                                                   value="<?= $row['quantity'] ?>" min="1"
                                                   required>
                                        </div>
                                        <div class="form-group">
                                            <label for="product_price">Product Price</label>
                                            <input class='btn-sm' type='number' name='p_price'
                                                   value="<?= $row['price'] ?>" in="0.00"
                                                   max="10000.00" step="0.01" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select name="p_category" required>
                                                <option value="<?= $row['category_id'] ?>" disabled
                                                        selected><?= $row['category_id'] . '&nbsp;' . $row['category_name'] ?></option>

                                                <?php
                                                foreach ($result as $data) :
                                                    ?>
                                                    <option value="<?= $data['category_id'] ?>"><?= $data['category_id'] . '&nbsp;' . $data['category_name'] ?></option>
                                                <?php
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="file">Preview:</label>
                                            <img class="img-thumbnail align-self-center"
                                                 style="width:100px;height:100px;"
                                                 src="img/<?= $row['image'] ?>" alt="Missing image data">
                                            <br>
                                            <label for="file">Select image to upload:</label>
                                            <input type="file" name="file" id="file" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Write here the description of product</label>
                                            <textarea class="form-control form-control-md rounded-0" name="description"
                                                      rows="10"><?= $row['description'] ?></textarea>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success btn-lg float-right">
                                            Add
                                            product
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    ?>
                </main>
            </div>
        </div>
    </div>
</div>
</body>
</html>