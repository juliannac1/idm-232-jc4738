<?php

define('DB_SERVER', "localhost");
define('DB_USER', "root");
define('DB_PASS', "root");
define('DB_NAME', "idm232");

//Create database connection-
$connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if ($connection->connect_error)
die("Connection failed: " . $connection->connect_error);
