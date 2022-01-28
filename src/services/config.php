<?php

// Website title :
define("WEBSITE_TITLE", "Bluebeard Bookshop");

// Database :
define("DB_NAME", "bluebeard_db");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_TYPE", "mysql");
define("DB_HOST", "localhost");

// Thème :
define("THEME", "bluebeard_v1/");

// PayPal :
define("PAYPAL_CLIENT_ID", "ATtGuoNBTYO69tG7foQNIGV8G35fTp7Va3doDBBlXjpfwFssoSAtqHoZKrV27XWmxBdvqV6UpLAI7Smc");

define("DEBUG", true);
DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);