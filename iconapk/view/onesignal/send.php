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
                        <form method="post" action="./onesignal/send_notification.php" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" value ="" placeholder="Enter title" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="message">Message <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" name="message" placeholder="Enter message" rows="2" required=""></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image" class="form-label">Image</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="customFile" accept="image/*" name="image">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="url" class="form-label">URL</label>
                                    <input type="url" class="form-control" name="url" id="url" value ="" placeholder="Enter URL">
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