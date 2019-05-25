<?php
require_once('../../App/Autoloader.php');
$dataUser = array();
$result = array();
Autoloader::sessionStarter();
if (empty($_SESSION['login']))
    RedirectHandler::HTTP_301('login');
if ($_SESSION['isAdmin'] == true) {
    RedirectHandler::HTTP_301('dashboard_admin');
};
$data = new User();
$result = $data->fetchLand();
$user = $_SESSION['login'];
$dataUser = new User();
$dataUserInfo = $dataUser->fetchUserInformation($user);
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
    $object->updateUserInformation($user, $f_name, $honorifics, $surname, $email, $address, $hr_nr, $postcode, $land, $state, $m_nr);
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
        <a class="nav-link active" href="dashboard">Dashboard</a>
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
                            <img src="img/logo.ico" class="logo" data-toggle="tooltip" data-placement="right"
                                 title="Dashboard"/>
                            Project Supermarkt
                        </a>
                    </li>
                    <li class="nav-item py-1" id="home">
                        <a class="nav-link p-3 font-weight-bold" href="home"><i class="fas fa-home fa-lg mr-2"></i>&nbspHome
                            Page</a>
                    </li>
                    <li class="nav-item py-1" id="dashboard">
                        <a class="nav-link p-3 font-weight-bold" href="dashboard"><i
                                    class="fas fa-chart-line fa-lg mr-2"></i>&nbspDashboard</a>
                    </li>
                    <li class="nav-item py-1" id="userinfo">
                        <a class="nav-link p-3 font-weight-bold" href="#userinformation"><i
                                    class="fas fa-users fa-lg mr-2"></i>&nbspUser Information</a>
                    </li>
                    <li class="nav-item py-1 {{ Request::is('admin/vocabularies*') ? 'active' : null }}"
                        id="vocabularies">
                        <a class="nav-link p-3 font-weight-bold" href="{{ route('vocabularies.index') }}"><i
                                    class="fas fa-font fa-lg mr-2"></i>&nbspOrders</a>
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
                    <h2>Welcome, <?= $_SESSION['login'] ?></h2>
                    <div id="userinfodiv" class="card rounded-0 d-none">
                        <div class="card-header">
                            <h3 class="mb-0">User Information</h3>
                            <h6 class="mb-0">Here you can see your user information where you can edit them everytime
                                you want.</h6>
                            <h6 class="mb-0">Please put all data before saving or there will be no changes.</h6>
                        </div>
                        <?php foreach ($dataUserInfo as $data) :
                            ?>
                            <div class="card-body bg-light">
                                <form class="form" role="form" autocomplete="off" id="formLogin" novalidate=""
                                      method="POST">
                                    <div class="form-group">
                                        <label for="f_name">First name</label>
                                        <input type="text" class="form-control form-control-lg rounded-0" name="f_name"
                                               id="f_name" required
                                               placeholder="<?= $data['first_name'] ?>">
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
                                        <input type="text" class="form-control form-control-lg rounded-0" name="surname"
                                               id="surname" required
                                               placeholder="<?= $data['surname'] ?>">
                                        <div class="invalid-feedback">Oops, you missed this one.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail Address</label>
                                        <input type="email" class="form-control form-control-lg rounded-0" name="email"
                                               id="email" required
                                               placeholder="<?= $data['email'] ?>">
                                        <div class="invalid-feedback">Oops, you missed this one.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control form-control-lg rounded-0" name="address"
                                               id="address" required
                                               placeholder="<?= $data['address'] ?>">
                                        <div class="invalid-feedback">Oops, you missed this one.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="hr_nr">House number</label>
                                        <input type="text" class="form-control form-control-lg rounded-0" name="hr_nr"
                                               id="hr_nr" required
                                               placeholder="<?= $data['house number'] ?>">
                                        <div class="invalid-feedback">Oops, you missed this one.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="postcode">Postcode</label>
                                        <input type="text" class="form-control form-control-lg rounded-0"
                                               name="postcode" id="postcode" required
                                               placeholder="<?= $data['postcode'] ?>">
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
                                                   placeholder="<?= $data['state'] ?>">
                                            <div class="invalid-feedback">Oops, you missed this one.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="m_nr">Mobile number</label>
                                            <input type="text" class="form-control form-control-lg rounded-0"
                                                   name="m_nr"
                                                   id="m_nr" required
                                                   placeholder="<?= $data['mobile number'] ?>">
                                            <div class="invalid-feedback">Oops, you missed this one.</div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success btn-lg float-right"
                                                id="btnLogin">Save
                                        </button>
                                </form>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="script/jquery-3.3.1.js"></script>
<script>
    $(document).ready(function () {
        // if clicked shows userinformation
        $("#userinfo").on('click', function () {
            let userinformation = $("#userinfodiv");
            userinformation.removeClass('d-none');
            // alert("check");
        });
        $("#dashboard").on('click', function () {
            let userinformation = $("#userinfodiv");
            userinformation.addClass('d-none');
        });
        // if clicked shows order table/list
        $("#userorder").on('click', function () {
            alert("Handler for .click() called.");
        })
    })
</script>
