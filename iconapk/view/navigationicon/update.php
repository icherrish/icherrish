<?php
session_start();
    require_once("../../configuration/connection.php");
    $id = $_POST['id'];
    $cat = $_POST['cat'];
    
    $is_status = $_POST['is_status'];
    $status = $_POST['status'];
    
    $table = $cat."_header_icon";
    $query = "SELECT * FROM `$table` WHERE `id` = '".$id."'";

    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));

    if( $is_status ==  1 ){
        if($cat == 'right')
        {
            $active_record_query = "SELECT * FROM `$table` WHERE `status` = '1'";
            $active_record = mysqli_query($mysqli,$active_record_query) or die(mysqli_error($mysqli));

            if(mysqli_num_rows($active_record) > 2 && $status == 1){
                $row = mysqli_fetch_array($active_record);
                $row_id = $row['id'];
                $update_sql = "UPDATE `$table` SET `status` = '0'  WHERE `id` = '".$row_id."' ";

                mysqli_query($mysqli, $update_sql);
            }
        }else{
            $update_sql = "UPDATE `$table` SET `status` = '0' ";
            mysqli_query($mysqli, $update_sql);
        }
        $sql = "UPDATE `$table` SET `status` = '".$status."' WHERE `id` = '".$id."' ";

        $message = 'Header Icon has been enabled';
    }else{
        if($_SESSION['user'] != 'demo@admin.com'){
            $url = $_POST['url'];
            $sql = "UPDATE `$table` SET `url` = '".$url."' WHERE `id` = '".$id."' ";
            $message = 'URL has been updated';
        }else{
            $message = "Demo User Don\'t have permission for this action.";
        }
    }

    if(mysqli_query($mysqli, $sql)){
        $_SESSION['success'] = $message;
    } else{
        $_SESSION['error'] = isset($message) ? $message : 'Failed';
    }
    header("Location: ../../view/index.php?page=navigationicon_".$cat);
?>