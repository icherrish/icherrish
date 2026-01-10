<?php
session_start();
    require_once("../../configuration/connection.php");
    $id = $_POST['id'];

    $query = "SELECT * FROM `user_agent` WHERE `id` = '".$id."'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if( $_SESSION['user'] != "demo@admin.com" ){
        $sql = "DELETE FROM `user_agent` WHERE `id` = '".$id."' ";
        $message = 'User Agent has been deleted';

        if(mysqli_query($mysqli, $sql)){
            $_SESSION['success'] = $message;
        } else{
            $_SESSION['error'] = $message;
        }
    }else {
        $_SESSION['error'] = "Demo User Don\'t have permission for this action.";
    }
    header("Location: ../../view/index.php?page=useragent");
?>