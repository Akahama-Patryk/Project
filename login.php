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
        <a class="nav-link active" href="#">Login page</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contact Page</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Dashboard</a>
    </li>
</ul>
    <form method="post" action="">
        Gebruikersnaam: <input type="text" name="user"/>
        Wachtwoord: <input type="text" name="pass"/>
        <input type="submit" name="submit" value="Login"/>
    </form>
<a href="register.php">Register</a>
</body>
</html>
