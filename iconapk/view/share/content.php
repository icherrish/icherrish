<?php

    require_once("../configuration/connection.php");
    $query = "SELECT * FROM `app_settings` WHERE `key` = 'share_content' ";
    
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
                        <h4 class="card-title">Share Content</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="post" action="savesetting.php">
                            <input type="hidden" name="type" value="share_content" />
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="share">Share Content <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="share" name="share" placeholder="Enter share content" rows="3" required><?= isset($value) && isset($value->share) ? $value->share : '' ?></textarea>
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