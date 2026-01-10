<?php

require_once("../configuration/connection.php");
$query = "SELECT * FROM `app_settings` WHERE `key` = 'theme'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $value = json_decode($row['value']);
    }else {
        $value = null;
    }

    $options = '[
        { "value" : "Default", "label" : "Default" , "preview" : "#195CDD"},
        { "value" : "Theme1", "label" : "Theme 1" , "preview" : "#880e4f"},
        { "value" : "Theme2", "label" : "Theme 2" , "preview" : "#e667b1"},
        { "value" : "Theme3", "label" : "Theme 3" , "preview" : "#4a148c"},
        { "value" : "Theme4", "label" : "Theme 4" , "preview" : "#b71c1c"},
        { "value" : "Theme5", "label" : "Theme 5" , "preview" : "#1a237e"},
        { "value" : "Theme6", "label" : "Theme 6" , "preview" : "#0d47a1"},
        { "value" : "Theme7", "label" : "Theme 7" , "preview" : "#01579b"},
        { "value" : "Theme8", "label" : "Theme 8" , "preview" : "#094c4f"},
        { "value" : "Theme9", "label" : "Theme 9" , "preview" : "#bfc726"},
        { "value" : "Theme10", "label" : "Theme 10" , "preview" : "#1b5e20"},
        { "value" : "Theme11", "label" : "Theme 11" , "preview" : "#ba8d06"},
        { "value" : "Theme12", "label" : "Theme 12" , "preview" : "#6835f2"},
        { "value" : "Theme13", "label" : "Theme 13" , "preview" : "#212121"},
        { "value" : "Theme14", "label" : "Theme 14" , "preview" : "#263238"},
        { "value" : "Theme15", "label" : "Theme 15" , "preview" : "#dd2c00"},
        { "value" : "Theme16", "label" : "Theme 16" , "preview" : "#1b5ddb"}
    ]';

    $options = json_decode($options);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Theme Style</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="post"  action="savesetting.php">
                            <input type="hidden" name="type" value="theme" />
                            <div class="row">
                                <?php
                                    foreach ($options as $k => $opt){
                                        $selected = (isset($value->themeStyle) && $value->themeStyle == $opt->value) ? "checked" : "";
                                ?>
                                    <div class="form-group col-md-4">
                                        <div class="d-flex justify-content-between">
                                            <div class="custom-control custom-radio custom-control-inline d-inline">
                                                <input type="radio" name="themeStyle" id="radio_<?= $k ?>" value="<?= $opt->value ?>" <?= $selected ?>  class="custom-control-input">
                                                <label class="custom-control-label" for="radio_<?= $k ?>" ><?= $opt->label ?></label>
                                            </div>
                                            <div class="top-block-one d-flex align-items-center justify-content-between">
                                                <div class="icon avatar-40  mr-4 rounded" style="background-color: <?= $opt->preview ?>;"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="d-flex justify-content-between">
                                        <div class="custom-control custom-radio custom-control-inline d-inline">
                                            <input type="radio" name="themeStyle" id="radio_Custom" value="Custom" <?= (isset($value->themeStyle) && $value->themeStyle == 'Custom') ? "checked" : "" ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="radio_Custom" >Custom Color Theme</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row CustomColor">
                                <div class="form-group col-md-4">
                                    <label for="customColor">Custom Color </label>
                                    <input type="color" name="customColor" class="form-control" id="customColor" value ="<?= isset($value) && isset($value->customColor) ? $value->customColor : '#4788ff' ?>" >
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="d-flex justify-content-between">
                                        <div class="custom-control custom-radio custom-control-inline d-inline">
                                            <input type="radio" name="themeStyle" id="radio_Gradient" value="Gradient" <?= (isset($value->themeStyle) && $value->themeStyle == 'Gradient') ? "checked" : "" ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="radio_Gradient" >Gradient Color Theme</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row GradientColor">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gradientColor1">Gradient Color 1</label>
                                        <input type="color" name="gradientColor1" class="form-control" id="gradientColor1" value ="<?= isset($value) && isset($value->gradientColor1) ? $value->gradientColor1 : '#4788ff' ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="gradientColor2">Gradient Color 2</label>
                                        <input type="color" name="gradientColor2" class="form-control" id="gradientColor2" value ="<?= isset($value) && isset($value->gradientColor2) ? $value->gradientColor2 : '#4788ff' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Preview</label>
                                    <p class="pt-5 pb-4 text-center rounded preview_gradient"></p>
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