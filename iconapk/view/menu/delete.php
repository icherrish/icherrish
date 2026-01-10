<?php
session_start();
    require_once("../../configuration/connection.php");
    $id = $_POST['id'];

    $query = "SELECT * FROM `menu` WHERE `id` = '".$id."'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $image = $row['image'];
    }
    if( $_SESSION['user'] != "demo@admin.com" ){
        $sql = "DELETE FROM `menu` WHERE `id` = '".$id."' ";
        $message = 'Menu has been deleted';
        
        $path = '../../upload/menu/'.$image;
        if($image != 'default.png'){
            if (file_exists($path)) {
                unlink($path);
            }
        }

        if(mysqli_query($mysqli, $sql)){
            if($row['type'] == 'sidedrawer' ){
                $child_sql = "DELETE FROM `menu` WHERE `parent_id` = '".$id."' ";
                mysqli_query($mysqli, $child_sql);
            }
            $_SESSION['success'] = $message;
        } else{
            $_SESSION['error'] = $message;
        }
    }else {
        $_SESSION['error'] = "Demo User Don\'t have permission for this action.";
    }
    header("Location: ../../view/index.php?page=menu");
?>