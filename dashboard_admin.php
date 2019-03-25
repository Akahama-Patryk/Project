<?php
include_once('App/Autoloader.php');
$dataUser = array();
Autoloader::sessionStarter();
if (empty($_SESSION['login']))
    header('Location: login.php');
if ($_SESSION['isAdmin'] == false) {
    header("Location: dashboard.php");
};
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
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
</head>
<body>
<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
        <a class="nav-link" href="index.php">Homepage</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="login.php">Login page</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contact Page</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="dashboard_admin.php">Dashboard</a>
    </li>
</ul>
<ul class="list-group-item">
        <a class="list-group-item d-xl-inline-flex p-2 justify-content-between align-items-center"
           href="#client">Client
        </a>
        <a class="list-group-item d-xl-inline-flex p-2 justify-content-between align-items-center"
               href="#product">Product
        </a>
    <a class="list-group-item d-xl-inline-flex p-2 justify-content-between align-items-center"
       href="#category">Category
    </a>
    <a class="list-group-item d-xl-inline-flex p-2 justify-content-between align-items-center"
       href="#orders">Orders
    </a>
    <a class="list-group-item d-xl-inline-flex p-2 justify-content-between align-items-center"
       href="#coworkers">Co-workers
    </a>
</ul>
<h4>Dashboard Admin</h4>
<h2>Welcome, <?= $_SESSION['login'] ?></h2>
<div class="card rounded-0">
    <div class="card-header">
        <h3 class="mb-0">User Information</h3>
        <h6 class="mb-0">Here you can see your user information where you can edit them everytime you want.</h6>
        <h6 class="mb-0">Please put all data before saving or there will be no changes.</h6>
    </div>
    <?php foreach ($dataUserInfo as $data) :
        ?>
        <div class="card-body bg-light">
            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
                <div class="form-group">
                    <label for="f_name">First name</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="f_name" id="f_name" required
                           placeholder="<?= $data['first_name']?>">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>
                <h6>Mr/Mrs or other</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="option" id="inlineCheckbox1" value="Mr">
                    <label class="form-check-label" for="inlineCheckbox1">Mr</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="option" id="inlineCheckbox1" value="Mrs">
                    <label class="form-check-label" for="inlineCheckbox2">Mrs</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="option" id="inlineCheckbox3" value="Other">
                    <label class="form-check-label" for="inlineCheckbox3">Other</label>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="surname" id="surname" required
                           placeholder="<?= $data['surname']?>">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail Address</label>
                    <input type="email" class="form-control form-control-lg rounded-0" name="email" id="email" required
                           placeholder="<?= $data['email']?>">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="address" id="address" required
                           placeholder="<?= $data['address']?>">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>
                <div class="form-group">
                    <label for="hr_nr">House number</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="hr_nr" id="hr_nr" required
                           placeholder="<?= $data['house number']?>">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>
                <div class="form-group">
                    <label for="postcode">Postcode</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="postcode" id="postcode" required
                           placeholder="<?= $data['postcode']?>">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>
                <div class="form-group">
                    <label for="land">Land</label>
                    <h6>Dropdown where you chose Land</h6>
                    <input type="text" class="form-control form-control-lg rounded-0" name="land" id="land" required
                           placeholder="<?= $data['land']?>">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="state" id="state" required
                           placeholder="<?= $data['state']?>">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>
                <div class="form-group">
                    <label for="m_nr">Mobile number</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="m_nr" id="m_nr" required
                           placeholder="<?= $data['mobile number']?>">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>
                <button type="submit" name="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Save</button>
            </form>
        </div>
    <?php
    endforeach;
    ?>
</div>
</body>
</html>