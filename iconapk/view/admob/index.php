<?php

require_once("../configuration/connection.php");
$query = "SELECT * FROM `app_settings` WHERE `key` = 'admob'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $value = json_decode($row['value']);
        $ads_type = isset($value->ads_type) ? $value->ads_type : 'admob';
    }else {
        $value = null;
        $ads_type = 'admob';
    }
    $ads_option = [
        [ 
            'value' => 'none',
            'label' => 'None'
        ],
        [ 
            'value' => 'admob',
            'label' => 'AdMob'
        ],
        [
            'value' => 'facebook',
            'label' => 'Facebook'
        ],
    ];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Ads Configuration</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="post"  action="savesetting.php">
                            <input type="hidden" name="type" value="admob" />
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Select Ads Type </label>
                                    <div class="form-group">
                                        <?php 
                                            foreach ($ads_option as $b => $opt) {
                                                $selected = ( $ads_type == $opt['value'] ) ? "checked" : "";
                                        ?>
                                        <div class="d-inline">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="ads_type" id="ads_radio_<?= $b ?>" value="<?= $opt['value'] ?>" <?= $selected ?>  class="custom-control-input">
                                                <label class="custom-control-label ads_type" for="ads_radio_<?= $b ?>" ><?= $opt['label'] ?></label>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="admob_div">
                                <div class="form-group col-md-6">
                                    <label for="input_admobBannerID" class="form-label">AdMob Banner Unit ID-Android (optional)  </label>
                                    <input type="text" class="form-control" name="admobBannerID" value ="<?= isset($value) && isset($value->admobBannerID)  ? $value->admobBannerID : '' ?>" placeholder="Enter Your admob banner id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="input_admobIntentialID" class="form-label">AdMob Interstitial Unit ID-Android (optional)  </label>
                                    <input type="text" class="form-control" name="admobIntentialID" value ="<?= isset($value) && isset($value->admobIntentialID)  ? $value->admobIntentialID : '' ?>" placeholder="Enter Your admob interstitial id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="input_admobBannerIDIOS" class="form-label">AdMob Banner Unit ID-iOS (optional)  </label>
                                    <input type="text" class="form-control" name="admobBannerIDIOS" value ="<?= isset($value) && isset($value->admobBannerIDIOS)  ? $value->admobBannerIDIOS : '' ?>" placeholder="Enter Your admob banner id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="input_admobIntentialIDIOS" class="form-label">AdMob Interstitial Unit ID-iOS (optional)  </label>
                                    <input type="text" class="form-control" name="admobIntentialIDIOS" value ="<?= isset($value) && isset($value->admobIntentialIDIOS)  ? $value->admobIntentialIDIOS : '' ?>" placeholder="Enter Your admob interstitial id">
                                </div>
                            </div>

                            <div class="row" id="facebook_div">
                                <div class="form-group col-md-6">
                                    <label for="facebookBannerID" class="form-label">Facebook Banner Unit ID-Android (optional)  </label>
                                    <input type="text" class="form-control" name="facebookBannerID" value ="<?= isset($value) && isset($value->facebookBannerID)  ? $value->facebookBannerID : '' ?>" id="facebookBannerID" placeholder="Enter Your facebook banner id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="facebookIntentialID" class="form-label">Facebook Interstitial Unit ID-Android (optional)  </label>
                                    <input type="text" class="form-control" name="facebookIntentialID" value ="<?= isset($value) && isset($value->facebookIntentialID)  ? $value->facebookIntentialID : '' ?>" id="facebookIntentialID" placeholder="Enter Your facebook interstitial id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="facebookBannerIDIOS" class="form-label">Facebook Banner Unit ID-iOS (optional)  </label>
                                    <input type="text" class="form-control" name="facebookBannerIDIOS" value ="<?= isset($value) && isset($value->facebookBannerIDIOS)  ? $value->facebookBannerIDIOS : '' ?>" id="facebookBannerIDIOS" placeholder="Enter Your facebook banner id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="facebookIntentialIDIOS" class="form-label">Facebook Interstitial Unit ID-iOS (optional)  </label>
                                    <input type="text" class="form-control" name="facebookIntentialIDIOS" value ="<?= isset($value) && isset($value->facebookIntentialIDIOS)  ? $value->facebookIntentialIDIOS : '' ?>" id="facebookIntentialIDIOS" placeholder="Enter Your facebook interstitial id">
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