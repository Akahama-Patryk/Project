<?php
include_once ('App/Autoloader.php');
Autoloader::sessionStarter();
if(empty($_SESSION['login']))
    header('Location: login.php');
if($_SESSION['isAdmin'] = false) {
  header("Location: dashboard.php");
};
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
        <a class="nav-link active" href="dashboard.php">Dashboard</a>
    </li>
</ul>
<h4>Dashboard</h4>
</body>
</head>
</html>