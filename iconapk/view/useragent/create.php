<?php
require_once("../configuration/connection.php");

    $value = null;
    $id = isset($_GET) && isset($_GET['id']) ? $_GET['id'] : null;
    
    $query = "SELECT * FROM `user_agent` WHERE `id` = '".$id."' ";
    
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
                        <h4 class="card-title">User Agent</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="post"  action="./useragent/save.php">
                            <input type="hidden" name="id" value="<?= $id ?>" />
                            <input type="hidden" name="status" value ="1">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" value ="<?= isset($row) && isset($row['title'])  ? $row['title'] : '' ?>" placeholder="Enter title" required>
                                </div>
                                <div class="form-group col-md-6">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="android" class="form-label">For Android</label>
                                    <textarea class="form-control" id="android" name="android" placeholder="Enter Android" rows="3" ><?= isset($row) && isset($row['android'])  ? $row['android'] : '' ?></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ios" class="form-label">For iOS</label>
                                    <textarea class="form-control" id="ios" name="ios" placeholder="Enter iOS" rows="3" ><?= isset($row) && isset($row['ios'])  ? $row['ios'] : '' ?></textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Status </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="status" id="status" <?= (isset($row) && isset($row['status']) && $row['status'] == 1 ) || ( $id == null ) ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="status"></label>
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