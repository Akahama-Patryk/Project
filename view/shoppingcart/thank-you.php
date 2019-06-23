<?php
include_once("../../App/Autoloader.php");
Autoloader::sessionStarter();
unset($_SESSION['cart_inventory']);
unset($_SESSION['valid_code']);
?>
<html>
<head>
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
</head>
<h1>Thank you for ordering in [Project Supermarkt] Shop. </h1><br>
<h1>You will be redirected shortly.</h1>
<progress value="0" max="15" id="progressBar"></progress>
</html>
<script>
    let timeleft = 15;
    let downloadTimer = setInterval(function () {
        let progressbar = document.getElementById("progressBar")
        progressbar.value = 15 - timeleft;
        timeleft -= 1;
        if (timeleft < 0)
            clearInterval(downloadTimer);
    }, 1000);
    setTimeout(function () {
        window.location.href = 'home';
    }, 17000);
</script>