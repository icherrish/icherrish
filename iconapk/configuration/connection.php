<?php
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);
    /* Database credentials. Assuming you are running MySQL server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'iche_iconapk');
    define('DB_PASSWORD', '#OBSxK7RmY1PJQZ5');
    define('DB_NAME', 'iche_iconapk');
    
    /* Attempt to connect to MySQL database */
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($mysqli->connect_error){
        header("Location: login.php?error=connect_error");
        // die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
?>