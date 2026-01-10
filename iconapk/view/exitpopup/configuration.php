<?php
    require_once("../configuration/connection.php");
    $query = "SELECT * FROM `app_settings` WHERE `key` = 'exitpopup_configuration'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    // $time = echo time();
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $value = json_decode($row['value']);
        $enable_image = isset($value->enable_image) && ($value->enable_image) ? $value->enable_image : "false";
    }else {
        $value = null;
        $enable_image = "false";
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Exit Popup Configuration</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-12 new-user-info">
                        <form method="post"  action="savesetting.php" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="exitpopup_configuration" />
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Title" id="title" value ="<?= isset($value) && isset($value->title) ? $value->title : '' ?>" >
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <label for="positive_text">Positive Text</label>
                                        <input type="text" name="positive_text" placeholder="Positive Text" class="form-control" id="positive_text" value ="<?= isset($value) && isset($value->positive_text) ? $value->positive_text : '' ?>" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="negative_text">Negative Text</label>
                                        <input type="text" name="negative_text" placeholder="Negative Text" class="form-control" id="negative_text" value ="<?= isset($value) && isset($value->negative_text) ? $value->negative_text : '' ?>" >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6" id='exitpopup_image'>
                                        <label for="image" class="form-label">Image</label>
                                        <div class="d-inline justify-content-between">
                                            <div class="custom-file mb-3">
                                                <input type="file" class="custom-file-input" id="exit_image_url" accept="image/*" name="exit_image_url">
                                                <label class="custom-file-label" for="exit_image_url">Choose file</label>
                                            </div>
                                            <div class="mm-avatar col-md-3">
                                                <img class="avatar-80 rounded exit_image_url_preview" src="<?= isset($value) && isset($value->exit_image_url)  ? $value->exit_image_url.'?'.time() : '../upload/cancel.png' ?>" alt="#img" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="enable_image">Show Image </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="enable_image" id="enable_image" <?= ( $enable_image == 'false' ) ? '' : 'checked' ?>>
                                            <label class="custom-control-label" for="enable_image"></label>
                                        </div>
                                    </div>
                                </div>
                            <input type="submit" class="btn btn-primary" value="Save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>