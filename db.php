<?php
// $env_vars = [
//     'DB_SERVER' => $_SERVER['REDIRECT_DB_SERVER'] ?? $_SERVER['DB_SERVER'] ?? null,
//     'DB_USERNAME' => $_SERVER['REDIRECT_DB_USERNAME'] ?? $_SERVER['DB_USERNAME'] ?? null,
//     'DB_PASSWORD' => $_SERVER['REDIRECT_DB_PASSWORD'] ?? $_SERVER['DB_PASSWORD'] ?? null,
//     'DB_NAME' => $_SERVER['REDIRECT_DB_NAME'] ?? $_SERVER['DB_NAME'] ?? null,
// ];

// if (in_array(null, $env_vars, true))
//     die('Missing required environment variable');

define('DB_SERVER', "localhost");
define('DB_USER', "root");
define('DB_PASS', "root");
define('DB_NAME', "idm232");

//Create database connection-
$connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if ($connection->connect_error)
die("Connection failed: " . $connection->connect_error);
