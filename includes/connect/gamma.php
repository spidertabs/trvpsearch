<?php
ob_start();
session_start();

// Database credentials. Assuming you are running MySQL server with default setting (user 'root' with no password) 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'trvpsearch');

/* Attempt to connect to MySQL database */
try {

    $link = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    die("ERROR: Could not connect. " . $e->getMessage());
}
//include the user class, pass in the database connection
include('./../../classes/user.php');
$user = new Trvpsearch($link);
