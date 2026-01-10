<?php

    require_once("../configuration/connection.php");
    $query = "SELECT * FROM `app_settings` WHERE `key` = 'onesignal_configuration'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $value = json_decode($row['value']);
    }else {
        $value = null;
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Onesignal Configuration</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="post"  action="savesetting.php">
                            <input type="hidden" name="type" value="onesignal_configuration" />
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="app_id">Onesignal App ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="app_id" value ="<?= isset($value) && isset($value->app_id)  ? $value->app_id : '' ?>" placeholder="Onesignal App ID" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="rest_api_key">Onesignal Rest Api <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="rest_api_key" value ="<?= isset($value) && isset($value->rest_api_key)  ? $value->rest_api_key : '' ?>" placeholder="Onesignal Rest Api" required="">
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