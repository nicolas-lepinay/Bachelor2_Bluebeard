<?php

use App\Services\App;

session_start();

/*
 * [REQUEST_SCHEME] => http
 * [SERVER_NAME] => localhost
 * [SCRIPT_NAME] => /bluebeard/public/index.php
 * [DOCUMENT_ROOT] => C:/WampServer/www
 */

// Serving files to the server :
$path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
$path = str_replace("index.php", "", $path);

define('ROOT', $path);
define('ASSETS', $path . "assets/");

include "../src/init.php";

$app = new App();



