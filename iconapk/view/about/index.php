<?php

require_once("../configuration/connection.php");
$query = "SELECT * FROM `app_settings` WHERE `key` = 'about'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $value = json_decode($row['value']);
        $isShowAbout = isset($value->isShowAbout) && ($value->isShowAbout) ? $value->isShowAbout : "false";
    }else {
        $value = null;
        $isShowAbout = "false";
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">About App Configuration</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="post"  action="savesetting.php">
                            <input type="hidden" name="type" value="about" />
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="whatsAppNumber" class="form-label">Whatsapp Number</label>
                                    <input type="text" class="form-control" name="whatsAppNumber" id="whatsAppNumber" value ="<?= isset($value) && isset($value->whatsAppNumber)  ? $value->whatsAppNumber : '' ?>" placeholder="Enter Your whatsApp number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="instagramUrl" class="form-label">Instagram URL</label>
                                    <input type="url" class="form-control" name="instagramUrl" id="instagramUrl" value ="<?= isset($value) && isset($value->instagramUrl)  ? $value->instagramUrl : '' ?>" placeholder="Enter Your instagram URL">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="twitterUrl" class="form-label">Twitter URL</label>
                                    <input type="url" class="form-control" name="twitterUrl" id="twitterUrl" value ="<?= isset($value) && isset($value->twitterUrl)  ? $value->twitterUrl : '' ?>" placeholder="Enter Your twitter URL">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="facebookUrl" class="form-label">Facebook URL</label>
                                    <input type="url" class="form-control" name="facebookUrl" id="facebookUrl" value ="<?= isset($value) && isset($value->facebookUrl)  ? $value->facebookUrl : '' ?>" placeholder="Enter Your facebook URL">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="callNumber" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="callNumber" id="callNumber" value ="<?= isset($value) && isset($value->callNumber)  ? $value->callNumber : '' ?>" placeholder="Enter Your phone number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="snapchat" class="form-label">Snapchat</label>
                                    <input type="text" class="form-control" name="snapchat" id="snapchat" value ="<?= isset($value) && isset($value->snapchat)  ? $value->snapchat : '' ?>" placeholder="Enter Your snapchat URL">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="skype" class="form-label">Skype</label>
                                    <input type="url" class="form-control" name="skype" id="skype" value ="<?= isset($value) && isset($value->skype)  ? $value->skype : '' ?>" placeholder="Enter Your skype URL">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="messenger" class="form-label">Messenger</label>
                                    <input type="url" class="form-control" name="messenger" id="messenger" value ="<?= isset($value) && isset($value->messenger)  ? $value->messenger : '' ?>" placeholder="Enter Your messenger URL">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="youtube" class="form-label">Youtube</label>
                                    <input type="url" class="form-control" name="youtube" id="youtube" value ="<?= isset($value) && isset($value->youtube)  ? $value->youtube : '' ?>" placeholder="Enter Your youtube URL">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Is Show About Option? </label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="isShowAboutYes" name="isShowAbout" value="true" <?php if($isShowAbout == "true") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="isShowAboutYes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="isShowAboutNo" name="isShowAbout" value="false" <?php if($isShowAbout == "false") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="isShowAboutNo"> No </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="copyright" class="form-label">Copy Right</label>
                                    <input type="text" class="form-control" name="copyright" id="copyright" value ="<?= isset($value) && isset($value->copyright)  ? $value->copyright : '' ?>" placeholder="Enter Your Copy Right ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="3" ><?= isset($value) && isset($value->description)  ? $value->description : '' ?></textarea>
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