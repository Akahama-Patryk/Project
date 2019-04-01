<?php
include_once('App/Autoloader.php');
Autoloader::sessionStarter();
if (User::LoginStatus() == true) {
    session_destroy();
    header('Location: index.php');
}
if (isset($_POST['submit'])) {
    $name = $_POST['user'];
    $pass = $_POST['pass'];

    $object = new User();
    $object->Login($name, $pass);
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
        <a class="nav-link" href="index.php">Homepage</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="login.php">Login page</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contact Page</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Dashboard</a>
    </li>
</ul>
<div class="card rounded-0">
    <div class="card-header">
        <h3 class="mb-0">Login</h3>
    </div>
    <div class="card-body bg-light">
        <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
            <div class="form-group">
                <label for="user">Username</label>
                <input type="text" class="form-control form-control-lg rounded-0" name="user" id="user" required
                       placeholder="Type your username.">
                <div class="invalid-feedback">Oops, you missed this one.</div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control form-control-lg rounded-0" id="pass" name="pass" required
                       autocomplete="new-password" placeholder="Type your password.">
                <div class="invalid-feedback">Enter your password too!</div>
            </div>
            <a href="register.php" class="btn btn-primary btn-lg float-left" id="btnLogin">Register</a>
            <button type="submit" name="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Login</button>
        </form>
    </div>
</div>
</body>
</html>
