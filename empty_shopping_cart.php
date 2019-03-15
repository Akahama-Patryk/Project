<?php
include_once ('App/Autoloader.php');
Autoloader::sessionStarter();

//Empty cart right away.
ShoppingCart::emptyCart();