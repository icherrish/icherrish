<?php
require_once("../configuration/connection.php");

    $value = null;
    $id = isset($_GET) && isset($_GET['id']) ? $_GET['id'] : null;
    
    $query = "SELECT * FROM `walkthrough` WHERE `id` = '".$id."' ";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
    }else {
        $row = null;
    }

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">WalkThrough</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="post"  action="./walkthrough/save.php" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id ?>" />
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" value ="<?= isset($row) && isset($row['title'])  ? $row['title'] : '' ?>" placeholder="Enter title" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="subtitle" class="form-label">Subtitle <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="subtitle" name="subtitle" placeholder="Enter Subtitle" rows="2" required=""><?= isset($row) && isset($row['subtitle'])  ? $row['subtitle'] : '' ?></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image" class="form-label">Image</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="customFile" accept="image/*" name="image">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Status </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="status" id="status" <?= (isset($row) && isset($row['status']) && $row['status'] == 1 ) || ( $id == null ) ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="status"></label>
                                    </div>
                                </div>
                                <?php
                                    $image = isset($row) && isset($row['image']) ? $row['image'] : 'default.png';
                                    $path = '../upload/walkthrough/';
                                    /*
                                    if($row['image'] != null && file_exists( $path.$image)){
                                        $image = $path.$image;
                                    }
                                    */
                                ?>
                                <div class="form-group col-md-6">
                                    <div class="mm-avatar">
                                        <img class="avatar-60 rounded image_preview" src="<?= $path.$image ?>" alt="#" data-original-title="" title="">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <input type="submit" class="btn btn-primary" value="Save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>