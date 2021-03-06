<?php
include_once('../../../App/Autoloader.php');
$result = array();
Autoloader::sessionStarter();
if (empty($_SESSION['login']))
    RedirectHandler::HTTP_301('login');
if ($_SESSION['isAdmin'] == false) {
    RedirectHandler::HTTP_301('dashboard');
};
//delete client
if (isset($_GET['ID']) && !empty($_GET['ID'])) {
    $DeleteClient = new User();
    $DeleteClient->deleteUser($_GET['ID']);
    RedirectHandler::HTTP_301('dashboard_admin_client');
}
$checkadmin = '0';
$dataClient = new User();
$result = $dataClient->fetchUserData($checkadmin);
?>
<html lang="nl">
<head>
    <title>Project Supermarkt --Dashboard Admin:Client--</title>
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
                    <div class='col-md-12'>
                        <form method="get">
                            <table class='table'>
                                <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'>Username</th>
                                    <th scope='col'>Honorifics</th>
                                    <th scope='col'>First Name</th>
                                    <th scope='col'>Surname</th>
                                    <th scope='col'>Address</th>
                                    <th scope='col'>House Number</th>
                                    <th scope='col'>Postcode</th>
                                    <th scope='col'>Land</th>
                                    <th scope='col'>State</th>
                                    <th scope='col'>Mobile Number</th>
                                    <th scope='col'>E-mail</th>
                                    <th scope='col'>Update</th>
                                    <th scope='col'>Update password</th>
                                    <th scope='col'>Delete</th>
                                </tr>
                                <tbody>
                                <?php
                                if ($result !== null)
                                    foreach ($result as $row) : ?>
                                        <tr>
                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['honorifics'] ?></td>
                                            <td><?= $row['first_name'] ?></td>
                                            <td><?= $row['surname'] ?></td>
                                            <td><?= $row['address'] ?></td>
                                            <td><?= $row['house number'] ?></td>
                                            <td><?= $row['postcode'] ?></td>
                                            <td><?= $row['land'] ?></td>
                                            <td><?= $row['state'] ?></td>
                                            <td><?= $row['mobile number'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><a href="dashboard_admin_client_edit?ID=<?= $row['user_id'] ?>">
                                                    UPDATE
                                                </a></td>
                                            <td><a href="dashboard_admin_client_editpass?ID=<?= $row['user_id'] ?>">
                                                    UPDATE PASS
                                                </a></td>
                                            <td><a href="?ID=<?= $row['user_id'] ?>">
                                                    DELETE
                                                </a></td>
                                        </tr>
                                    <?php endforeach; ?>
                            </table>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>
</body>
</html>