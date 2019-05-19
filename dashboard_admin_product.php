<?php
include_once('App/Autoloader.php');
$dataProduct = array();
Autoloader::sessionStarter();
if (empty($_SESSION['login']))
    RedirectHandler::HTTP_301('login');
if ($_SESSION['isAdmin'] == false) {
    RedirectHandler::HTTP_301('dashboard');
};
$data = new Product();
$dataProduct = $data->GetProduct();
?>
<html>
<head>
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
                        <a class="nav-link p-3 font-weight-bold" href="dashboard_client"><i
                                    class="fas fa-users fa-lg mr-2"></i>&nbspClient</a>
                    </li>
                    <li class="nav-item py-1" id="vocabularies">
                        <a class="nav-link p-3 font-weight-bold" href="dashboard_product"><i
                                    class="fas fa-font fa-lg mr-2"></i>&nbspProduct</a>
                    </li>
                    <li class="nav-item py-1 {{ Request::is('admin/tasks*') ? 'active' : null }}" id="tasks">
                        <a class="nav-link p-3 font-weight-bold" href="{{ route('tasks.index') }}"><i
                                    class="fas fa-question fa-lg mr-2"></i>&nbspCategory</a>
                    </li>
                    <li class="nav-item py-1 {{ Request::is('admin/lessons*') ? 'active' : null }}" id="lessons">
                        <a class="nav-link p-3 font-weight-bold" href="{{ route('lessons.index') }}"><i
                                    class="fas fa-briefcase fa-lg mr-2"></i>&nbspOrders</a>
                    </li>
                    <li class="nav-item py-1 {{ Request::is('admin/lessons*') ? 'active' : null }}" id="lessons">
                        <a class="nav-link p-3 font-weight-bold" href="{{ route('lessons.index') }}"><i
                                    class="fas fa-briefcase fa-lg mr-2"></i>&nbspClient History</a>
                    </li>
                    <li class="nav-item py-1 {{ Request::is('admin/categories*') ? 'active' : null }}"
                        id="lessons-categories">
                        <a class="nav-link p-3 font-weight-bold" href="{{ route('categories.index') }}"><i
                                    class="fas fa-boxes fa-lg mr-2"></i>&nbspCo-workers</a>
                    </li>
                    <li class="nav-item py-1 {{ Request::is('admin/hotspotroutes*') ? 'active' : null }}"
                        id="hotspotroutes">
                        <a class="nav-link p-3 font-weight-bold" href="{{ route('hotspotroutes.index') }}"><i
                                    class="fas fa-map-signs fa-lg mr-2"></i>&nbspQR codes/Coupons codes</a>
                    </li>
                    <li class="nav-item py-1 {{ Request::is('admin/help*') ? 'active' : null }}">
                        <a class="nav-link p-3 font-weight-bold" href="{{ route('help') }}"><i
                                    class="fa fa-question-circle fa-lg mr-2"></i>&nbspHelp</a>
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
                    <div class='col-md-12'>
                        <form method="get">
                            <table class='table'>
                                <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'>Name</th>
                                    <th scope='col'>Quantity</th>
                                    <th scope='col'>Price</th>
                                    <th scope='col'>Image</th>
                                    <th scope='col'>Description</th>
                                    <th scope='col'>Category</th>
                                    <th scope='col'>Update</th>
                                    <th scope='col'>Delete</th>
                                </tr>
                                <tbody>
                                <?php
                                if ($dataProduct !== null)
                                    foreach ($dataProduct as $record) :
                                        ?>
                                        <tr>
                                            <td><?= $record['name'] ?></td>
                                            <td><?= $record['quantity'] ?></td>
                                            <td><?= $record['price'] ?></td>
                                            <td><img class="img-thumbnail align-self-center"
                                                     style="width:100px;height:100px;"
                                                     src="<?= $record["image"] ?>" alt="Missing image data"></td>
                                            <td><?= $record['description'] ?></td>
                                            <td><?= $record['category_name'] ?></td>
                                            <!--                                            TODO: EDIT PRODUCT plus ADD FOTO TO IMG FOLDER AND DATABASE LINK-->
                                            <td><a href="dashboard_product_edit?ID=<?= $record['id_product'] ?>">
                                                    UPDATE
                                                </a></td>
                                            <!--                                            TODO: DELETE PRODUCT-->
                                            <td><a href="?ID=<?= $record['id_product'] ?>">
                                                    DELETE
                                                </a></td>
                                        </tr>
                                    <?php endforeach; ?>
                            </table>
                        </form>
                    </div>
                    <!-- TODO: ADD PRODUCT   plus ADD FOTO TO IMG FOLDER AND DATABASE LINK                  -->
                    <a href="dashboard_product_add" class="btn btn-primary align-items-md-end float-right"><i
                                class="fas fa-plus"></i> Add Product</a>
                </main>
            </div>
        </div>
    </div>
</div>
</body>
</html>