<?php
require_once("configuration/connection.php");
require("configuration/session.php");

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
if (!empty($email) && !empty($password)) {
    

    $query = "SELECT * FROM users WHERE email = '".$email."' AND password='".md5($password)."'";
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_fetch_row($result) > 0){

        // session_start();
        $_SESSION['user'] = $email;
        header("Location:index.php");
    } else {
        header("Location: login.php?error=login");
        die;
    } 
} else {
    header("Location: login.php?error=login");
    die;
}