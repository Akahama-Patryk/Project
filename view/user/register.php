<?php
include_once "../../App/Autoloader.php";
Autoloader::sessionStarter();
if (!empty($_SESSION['login']))
    RedirectHandler::HTTP_301('login');

if (isset($_POST['submit'])) {
    $name = $_POST['user'];
    $pass = $_POST['pass'];
    $isAdmin = false;
    $object = new User();
    $class = $object->register($name, $pass, $isAdmin);
}
?>
<html>
<head>
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
</head>
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
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Dashboard</a>
    </li>
</ul>
<div class="card rounded-0">
    <div class="card-header">
        <h3 class="mb-0">Register</h3>
    </div>
    <div class="card-body">
        <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
            <div class="form-group">
                <label for="user">Username</label>
                <input type="text" class="form-control form-control-lg rounded-0" name="user" id="user"
                       placeholder="Type your username." required>
                <div class="invalid-feedback">Oops, you missed this one.</div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control form-control-lg rounded-0" id="pass" name="pass"
                       autocomplete="new-password" placeholder="Type your password." required>
                <div class="invalid-feedback">Enter your password too!</div>
            </div>
            <button type="submit" name="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Register
            </button>
        </form>
    </div>
</div>
</body>
</html>
