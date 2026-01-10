<?php
    session_start();
    require_once("../../configuration/connection.php");

        $id = $_POST['id'];
        $title = $_POST['title'];
        $url = isset($_POST['url']) && $_POST['url'] != null ? $_POST['url'] : NULL;
        $image = $_FILES['image'];
        $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? 1 : 0;
        
        
        $image = 'default.png';
        $is_upload = false;
        if( $_SESSION['user'] != "demo@admin.com" ){
            if (isset($image) && file_exists($_FILES['image']['tmp_name'])) {
                $path = '../../upload/pages';
                $image = time().'-'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$image);
                $is_upload = true;
            }
            if($id == null){
                $record = "INSERT INTO `pages` VALUES(NULL,'".$title."','".$image."','".$url."','".$status."')";
                $message = "Pages has been saved successfully";
                
            } else {
                $query = "SELECT * FROM `pages` WHERE `id` = '".$id."'";
                $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
                
                if( $is_upload == false ){
                    $row = mysqli_fetch_array($result);
                    $image = $row['image'];
                }
                
                $record = "UPDATE `pages` SET `title` = '$title', `url` = '$url', `image` = '$image' , `status` = '$status' WHERE `id` = '".$id."' ";
                $message = "Pages has been updated successfully";
            }
            
            if(mysqli_query($mysqli, $record)){
                $_SESSION['success'] = $message;
            } else{
                $_SESSION['error'] = "failed";
            }
        }else{
            $_SESSION['error'] = "Demo User Don\'t have permission for this action.";
        }
    header("Location: ../../view/index.php?page=pages");
?>