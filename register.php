<?php
include_once "Class/User.php";

if(isset($_POST['submit'])){
    $name = $_POST['user'];
    $pass = $_POST['pass'];
    $object = new User();
    $class = $object->register($name, $pass);
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
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Dashboard</a>
    </li>
</ul>
<form method="post" action="">
    Gebruikersnaam: <input type="text" name="user"/>
    Wachtwoord: <input type="text" name="pass"/>
    <input type="submit" name="submit" value="Register"/>
</form>
</body>
</html>
