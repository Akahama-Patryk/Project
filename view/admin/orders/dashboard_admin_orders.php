<?php
include_once('../../../App/Autoloader.php');
$dataOrder = array();
Autoloader::sessionStarter();
if (empty($_SESSION['login']))
    RedirectHandler::HTTP_301('login');
if ($_SESSION['isAdmin'] == false) {
    RedirectHandler::HTTP_301('dashboard');
};
$data = new Order();
$dataOrder = $data->FetchOrder(null);
if (isset($_GET['ID']) && !empty($_GET['ID'])) {
    $DeleteOrder = new Order();
    $DeleteOrder->deleteOrder($_GET['ID']);
    RedirectHandler::HTTP_301('dashboard_admin_orders');
}
unset($_SESSION['factuurdata']);
if (!isset($_SESSION['factuurdata'])) {
    $_SESSION['factuurdata'] = array();
    if (isset($_POST['submit'])) {
        $new_item = array(
            'o_id' => $_POST['o_id'],
            'u_id' => $_POST['u_id'],
            'invoice_id' => $_POST['invoice_id']
        );
        $_SESSION['factuurdata'][] = $new_item;
        RedirectHandler::HTTP_301('dashboard_admin_invoice_view');
    }
}
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
                        <table class='table'>
                            <thead class='thead-dark'>
                            <tr>
                                <th scope='col'>Order ID</th>
                                <th scope='col'>Name</th>
                                <th scope='col'>Honorifics</th>
                                <th scope='col'>Surname</th>
                                <th scope='col'>Order Date</th>
                                <th scope='col'>Type Delivery</th>
                                <th scope='col'>Total Price</th>
                                <th scope='col'>PDF Invoice</th>
                                <th scope='col'>Update</th>
                                <th scope='col'>Delete</th>
                            </tr>
                            <tbody>
                            <?php
                            if ($dataOrder !== null)
                                foreach ($dataOrder as $record) :
                                    ?>
                                    <tr>
                                        <td><?= $record['order_id'] ?></td>
                                        <td><?= $record['name'] ?></td>
                                        <td><?= $record['honorifics'] ?></td>
                                        <td><?= $record['surname'] ?></td>
                                        <td><?= $record['orderdate'] ?></td>
                                        <td><?php if ($record['type_delivery'] === '1') $type = "Producten Afhalen";
                                            if ($record['type_delivery'] === '2') $type = "Producten Bezorgen" ?><?= $type ?></td>
                                        <td>€ <?= $record['total_price'] ?></td>
                                        <form method="post">
                                            <td hidden><input hidden type="text"
                                                              name="o_id"
                                                              id="o_id"
                                                              value="<?= $record['order_id'] ?>"></td>
                                            <td hidden><input hidden type="text"
                                                              name="u_id"
                                                              id="u_id"
                                                              value="<?= $record['user_id'] ?>"></td>
                                            <td hidden><input hidden type="text"
                                                              name="invoice_id"
                                                              id="invoice_id"
                                                              value="<?php $rng = rand(00000000, 99999999999); ?><?= $rng?>"></td>
                                            <td> <button type="submit" name="submit"
                                                         class="btn btn-success btn-lg float-right"
                                                         id="btnLogin">Invoice PDF
                                                </button></td>
                                        </form>
                                        <form method="get">
                                            <td><a href="dashboard_admin_orders_edit?ID=<?= $record['order_id'] ?>">
                                                    UPDATE
                                                </a></td>
                                            <td><a href="?ID=<?= $record['order_id'] ?>">
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
