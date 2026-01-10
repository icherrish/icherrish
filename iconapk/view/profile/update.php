<?php
session_start();
require_once("../../configuration/connection.php");

    $id = $_POST['id'];

    if($_POST['type'] == 'profile')
    {
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $email = $_POST['email'];

        $update_query = " `first_name` = '".$first_name."', `last_name` = '".$last_name."', `email` = '".$email."'  ";
    } else {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
    
        if( $password != $confirm_password ){
            $_SESSION['error'] = "Password and confirm password not same";
            header("Location: ../../view/index.php?page=profile");
        }
        $md5_password = md5($password);

        $update_query = "`password` = '".$md5_password."'";
    }
    if( $_SESSION['user'] != "demo@admin.com" ){
        
        $_SESSION['user'] = $email;
        $record = "UPDATE `users` SET $update_query WHERE `id` = '".$id."' ";

        $message = 'Password has been updated successfully.';
        if($_POST['type'] == 'profile'){
            $message = 'Profile has been updated successfully.';
        }
        $_SESSION['success'] = $message;

        mysqli_query($mysqli, $record);
    } else{
        $_SESSION['error'] = "Demo User Don\'t have permission for this action.";
    }
    header("Location: ../../view/index.php");
?>