<?php
include_once('../../../App/Autoloader.php');
$ReadUpdate = array();
$result = array();
$dataUser = array();
Autoloader::sessionStarter();
if (empty($_SESSION['login']))
    RedirectHandler::HTTP_301('login');
if ($_SESSION['isAdmin'] == false) {
    RedirectHandler::HTTP_301('dashboard');
};
// fetch client data
if (isset($_GET['ID']) && !empty($_GET['ID'])) {
    $FetchUser = new User();
    $ReadUpdate = $FetchUser->fetchClientInformation($_GET['ID']);
}
//fetch land data
$data = new User();
$result = $data->fetchLand();
if (isset($_POST['submit'])) {
    $f_name = $_POST['f_name'];
    $honorifics = $_POST['option'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $hr_nr = $_POST['hr_nr'];
    $postcode = $_POST['postcode'];
    $land = $_POST['land'];
    $state = $_POST['state'];
    $m_nr = $_POST['m_nr'];

    $object = new User();
    $object->updateClientInformation($_GET['ID'], $f_name, $honorifics, $surname, $email, $address, $hr_nr, $postcode, $land, $state, $m_nr);
    RedirectHandler::HTTP_301('dashboard_admin_client');
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
                    <?php
                    if ($ReadUpdate !== null)
                        foreach ($ReadUpdate as $data) : ?>
                            <div class="card-body bg-light">
                                <form class="form" role="form" autocomplete="off" id="formLogin" novalidate=""
                                      method="POST">
                                    <div class="form-group">
                                        <label for="f_name">First name</label>
                                        <input type="text" class="form-control form-control-lg rounded-0"
                                               name="f_name"
                                               id="f_name" required
                                               value="<?= $data['first_name'] ?>">
                                        <div class="invalid-feedback">Oops, you missed this one.</div>
                                    </div>
                                    <h6>Mr/Mrs or other</h6>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="option"
                                               id="inlineCheckbox1" value="Mr">
                                        <label class="form-check-label" for="inlineCheckbox1">Mr</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="option"
                                               id="inlineCheckbox1" value="Mrs">
                                        <label class="form-check-label" for="inlineCheckbox2">Mrs</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="option"
                                               id="inlineCheckbox3" value="Other">
                                        <label class="form-check-label" for="inlineCheckbox3">Other</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="surname">Surname</label>
                                        <input type="text" class="form-control form-control-lg rounded-0"
                                               name="surname"
                                               id="surname" required
                                               value="<?= $data['surname'] ?>">
                                        <div class="invalid-feedback">Oops, you missed this one.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail Address</label>
                                        <input type="email" class="form-control form-control-lg rounded-0"
                                               name="email"
                                               id="email" required
                                               value="<?= $data['email'] ?>">
                                        <div class="invalid-feedback">Oops, you missed this one.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control form-control-lg rounded-0"
                                               name="address"
                                               id="address" required
                                               value="<?= $data['address'] ?>">
                                        <div class="invalid-feedback">Oops, you missed this one.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="hr_nr">House number</label>
                                        <input type="text" class="form-control form-control-lg rounded-0"
                                               name="hr_nr"
                                               id="hr_nr" required
                                               value="<?= $data['house number'] ?>">
                                        <div class="invalid-feedback">Oops, you missed this one.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="postcode">Postcode</label>
                                        <input type="text" class="form-control form-control-lg rounded-0"
                                               name="postcode" id="postcode" required
                                               value="<?= $data['postcode'] ?>">
                                        <div class="invalid-feedback">Oops, you missed this one.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="land">Land</label>
                                        <select name="land">
                                            <option value="<?= $data["land"] ?>" disabled
                                                    selected><?= $data["land"] ?></option>
                                            <?php
                                            foreach ($result as $land) :
                                                ?>
                                                <option value="<?= $land['land_name'] ?>"><?= $land['land_name'] ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control form-control-lg rounded-0"
                                                   name="state"
                                                   id="state" required
                                                   value="<?= $data['state'] ?>">
                                            <div class="invalid-feedback">Oops, you missed this one.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="m_nr">Mobile number</label>
                                            <input type="text" class="form-control form-control-lg rounded-0"
                                                   name="m_nr"
                                                   id="m_nr" required
                                                   value="<?= $data['mobile number'] ?>">
                                            <div class="invalid-feedback">Oops, you missed this one.</div>
                                        </div>
                                        <button type="submit" name="submit"
                                                class="btn btn-success btn-lg float-right"
                                                id="btnLogin">Save
                                        </button>
                                </form>
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
