<?php
    require_once("../configuration/connection.php");
    $query = "SELECT * FROM `app_settings` WHERE `key` = 'splash_configuration'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $value = json_decode($row['value']);
        $enable_title = isset($value->enable_title) && ($value->enable_title) ? $value->enable_title : "false";
        $enable_logo = isset($value->enable_logo) && ($value->enable_logo) ? $value->enable_logo : "false";
        $enable_background = isset($value->enable_background) && ($value->enable_background) ? $value->enable_background : "false";
    }else {
        $value = null;
        $enable_title = $enable_logo = $enable_background = "false";
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Splash Configuration</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-8 new-user-info">
                        <form method="post"  action="savesetting.php" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="splash_configuration" />
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="first_color">First Color </label>
                                        <input type="color" name="first_color" class="form-control" id="first_color" value ="<?= isset($value) && isset($value->first_color) ? $value->first_color : '#3788ff' ?>" >
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <label for="second_color">Second Color </label>
                                        <input type="color" name="second_color" class="form-control" id="second_color" value ="<?= isset($value) && isset($value->second_color) ? $value->second_color : '#4788ff' ?>" >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6" id='logo_div'>
                                        <label for="image" class="form-label">Splash Logo</label>
                                        <div class="d-inline justify-content-between">
                                            <div class="custom-file mb-3">
                                                <input type="file" class="custom-file-input" id="splash_logo_url" accept="image/*" name="splash_logo_url">
                                                <label class="custom-file-label" for="splash_logo_url">Choose file</label>
                                            </div>
                                            <div class="mm-avatar col-md-3">
                                                <img class="avatar-80 rounded splash_logo_url_preview" src="<?= isset($value) && isset($value->splash_logo_url)  ? $value->splash_logo_url.'?'.time() : '../upload/splash_logo.png' ?>" alt="#img" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Show Logo </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="enable_logo" id="enable_logo" <?= ( $enable_logo == 'false' ) ? '' : 'checked' ?>>
                                            <label class="custom-control-label" for="enable_logo"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4" id="title_div">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" name="title" value ="<?= isset($value) && isset($value->title)  ? $value->title : '' ?>" placeholder="Title" id="splash_title">
                                    </div>
                                    <div class="form-group col-md-4" id="title_color_div">
                                        <label for="title">Title Color</label>
                                        <input type="color" name="title_color" class="form-control" id="title_color" value ="<?= isset($value) && isset($value->title_color) ? $value->title_color : '#4788ff' ?>" id="title_color" >
                                    </div>
                                
                                    <div class="form-group col-md-3">
                                        <label>Show Title </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="enable_title" id="enable_title" <?= ( $enable_title == 'false' ) ? '' : 'checked' ?>>
                                            <label class="custom-control-label" for="enable_title"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6" id='background_div'>
                                        <label for="image" class="form-label">Splash Background</label>
                                        <div class="d-inline justify-content-between">
                                            <div class="custom-file mb-3">
                                                <input type="file" class="custom-file-input" id="splash_background_url" accept="image/*" name="splash_background_url">
                                                <label class="custom-file-label" for="splash_background_url">Choose file</label>
                                            </div>
                                            <div class="mm-avatar col-md-3">
                                                <img class="avatar-80 rounded splash_background_url_preview" src="<?= isset($value) && isset($value->splash_background_url)  ? $value->splash_background_url.'?'.time() : '../upload/splash_background.png' ?>" alt="#img" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Show Background </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="enable_background" id="enable_background" <?= ( $enable_background == 'false' ) ? '' : 'checked' ?>>
                                            <label class="custom-control-label" for="enable_background"></label>
                                        </div>
                                    </div>
                                </div>

                            <input type="submit" class="btn btn-primary" value="Save">
                        </form>
                    </div>
                    <div class="col-md-3">
                        <div class="device">
                            <div class="splash_preview">
                                <div id="splash_preview_logo">
                                    <img src="<?= isset($value) && isset($value->splash_logo_url)  ? $value->splash_logo_url : '../upload/splash_logo.png' ?>" class="avatar-100 rounded d-block mx-auto img-fluid mb-3 splash_logo_url_preview">
                                </div>
                                <div id="splash_preview_title">
                                    <h4 class="font-600 text-center mb-0" id="preview_title_text"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>