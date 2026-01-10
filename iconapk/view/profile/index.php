<?php

require_once("../configuration/connection.php");

$query = "SELECT * FROM `users` ";
    
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
                        <h4 class="card-title">Change Password</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="post"  action="./profile/update.php">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>" >
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value ="" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="form-group col-md-6">
                                    <label for="confirm_password" class="form-label">Confirm Password </label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" value ="" placeholder="Confirm Password" required>
                                    <span id='confirm_pass_message'></span>
                                </div>
                            </div>
                            <hr>
                            <input type="submit" id="change_password" class="btn btn-primary" disabled value="Save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>