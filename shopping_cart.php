<?php
include_once("App/Autoloader.php");
Autoloader::sessionStarter();
?>
<h1>Hello there</h1>
<?php
ShoppingCart::cartInventory();
?>
<html>
<head>
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
</head>
<body>
</body>
</html>
