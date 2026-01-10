<?php
session_start();
    require_once("../../configuration/connection.php");
    $id = $_POST['id'];

    $query = "SELECT * FROM `walkthrough` WHERE `id` = '".$id."'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $image = $row['image'];
    }
    if( $_SESSION['user'] != "demo@admin.com" ){
        $sql = "DELETE FROM `walkthrough` WHERE `id` = '".$id."' ";
        $message = 'WalkThrough has been deleted';
        
        $path = '../../upload/walkthrough/'.$image;
        if($image != 'default.png'){
            if (file_exists($path)) {
                unlink($path);
            }
        }

        if(mysqli_query($mysqli, $sql)){
            $_SESSION['success'] = $message;
        } else{
            $_SESSION['error'] = $message;
        }
    }else {
        $_SESSION['error'] = "Demo User Don\'t have permission for this action.";
    }
    header("Location: ../../view/index.php?page=walkthrough");
?>