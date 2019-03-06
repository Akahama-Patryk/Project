<?php
include ('Class/User.php');

if(isset($_POST['submit'])){
    $name = $_POST['user'];
    $pass = $_POST['pass'];

    $object = new User();
    $object->Login($name, $pass);
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
        <a class="nav-link active" href="login.php">Login page</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contact Page</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Dashboard</a>
    </li>
</ul>
<div class="card-body">
<form method="post" action="">
    <div class="form-group row">
        <label for="user" class="col-md-4 col-form-label text-md-right">Username</label>
        <div class="col-md-6">
            <input id="user" type="text"
                   class="form-control}}"
                   name="user">
        </div>
    </div>

    <div class="form-group row">
        <label for="pass" class="col-md-4 col-form-label text-md-right">Password</label>
        <div class="col-md-6">
            <input id="pass" type="password"
                   class="form-control}}"
                   name="pass">
            <input type="submit" name="submit" value="Login"/>
        </div>
    </div>
</form>
<a href="register.php">Register</a>
</body>
</html>
