<?php

require_once("../configuration/connection.php");
$query = "SELECT * FROM `app_settings` WHERE `key` = 'appconfiguration'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $value = json_decode($row['value']);

        $isJavascript = isset($value->isJavascriptEnable) && ($value->isJavascriptEnable) ? $value->isJavascriptEnable : "false";
        $is_walkthrough = isset($value->is_walkthrough) && ($value->is_walkthrough) ? $value->is_walkthrough : "false";
        $is_webrtc = isset($value->is_webrtc) && ($value->is_webrtc) ? $value->is_webrtc : "false";
        $is_pull_refresh = isset($value->is_pull_refresh) && ($value->is_pull_refresh) ? $value->is_pull_refresh : "true";
        $is_floating_button = isset($value->is_floating_button) && ($value->is_floating_button) ? $value->is_floating_button : "false";
        $isSplashScreen = isset($value->isSplashScreen) && ($value->isSplashScreen) ? $value->isSplashScreen : "false";
        $isZoomFunctionality = isset($value->isZoomFunctionality) && ($value->isZoomFunctionality) ? $value->isZoomFunctionality : "false";
        $clear_cookie = isset($value->clear_cookie) && ($value->clear_cookie) ? $value->clear_cookie : "false";
        $isExitPopupScreen = isset($value->isExitPopupScreen) && ($value->isExitPopupScreen) ? $value->isExitPopupScreen : "false";
        $disable_header = isset($value->disable_header) && ($value->disable_header) ? $value->disable_header : 'false';
        $disable_footer = isset($value->disable_footer) && ($value->disable_footer) ? $value->disable_footer : 'false';
        $disable_left_icon = isset($value->disable_left_icon) && ($value->disable_left_icon) ? $value->disable_left_icon : 'false';
    }else {
        $value = null;
        $isJavascript = $isSplashScreen = $isZoomFunctionality = $is_walkthrough = $is_webrtc = $is_floating_button = $is_pull_refresh = $clear_cookie = $isExitPopupScreen = "true";
        $disable_header = $disable_footer = $disable_left_icon = 'false';
    }
    $lanuguage = [
        'en' => 'English',
        'ar' => 'Arabic',
        'fr' => 'French',
        'de' => 'German',
        'es' => 'Spanish',
        'af' => 'Afrikaans',
        'pt' => 'Portuguese',
        'tr' => 'Turkish',
        'id' => 'Indonesian',
        'ja' => 'Japanese',
        'nl' => 'Dutch',
        'hi' => 'Hindi',
        'it' => 'Italian',
        'ko' => 'Korean',
        'ne' => 'Nepali',
        'ru' => 'Russian',
        'vi' => 'Vietnamese',
        'he' => 'Hebrew',
        'th' => 'Thai',
    ];

    $navigation_style = [
        "sidedrawer" => 'Side Drawer',
        'bottom_navigation' => 'Bottom Navigation',
        'fullscreen' => 'Full Screen',
        'tabs' => 'Tabs',
        'sidedrawer_bottom_navigation' => 'Side Drawer & Bottom Navigation',
        'sidedrawer_tabs' => 'Side Drawer & Tab',
    ];

    $header_style = [
        'left' => 'Left',
        'center' => 'Center',
        'empty_header' => 'Empty Header'
    ];

    $floating_style = '[
        { "value" : "regular", "label" : "Regular", "preview" : "../assets/images/regular.png"  },
        { "value" : "circular", "label" : "Circular", "preview" : "../assets/images/circular.png"  }
    ]';

    $floating_button_style = json_decode($floating_style);

    $tab_style = '[
        { "value" : "simple_tab", "label" : "Simple Tabbar", "preview" : "../assets/images/simple_tab.png"  },
        { "value" : "tab_with_title_icon", "label" : "Tabbar with title and icon", "preview" : "../assets/images/tab_with_title_icon.png"  },
        { "value" : "tab_with_icon", "label" : "Tabbar with Icon", "preview" : "../assets/images/tab_with_icon.png"  }
    ]';

    $tab_style = json_decode($tab_style);

    $bottom_navigation = '[
        { "value" : "bottom_navigation_1", "label" : "Bottom Navigation 1", "preview" : "../assets/images/bottom_navigation_1.jpg"  },
        { "value" : "bottom_navigation_2", "label" : "Bottom Navigation 2", "preview" : "../assets/images/bottom_navigation_2.jpg"  },
        { "value" : "bottom_navigation_3", "label" : "Bottom Navigation 3", "preview" : "../assets/images/bottom_navigation_3.jpg"  }
    ]';
    $bottom_navigation = json_decode($bottom_navigation);

    $walkthrough_style = '[
        { "value" : "walkthrough_style_1", "label" : "Walkthrough style 1", "preview" : "../assets/images/walkthrough_style_1.png"  },
        { "value" : "walkthrough_style_2", "label" : "Walkthrough style 2", "preview" : "../assets/images/walkthrough_style_2.png"  },
        { "value" : "walkthrough_style_3", "label" : "Walkthrough style 3", "preview" : "../assets/images/walkthrough_style_3.png"  }
    ]';
    $walkthrough_style = json_decode($walkthrough_style);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">App Configuration</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="post"  action="savesetting.php" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="appconfiguration" />
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="app_name">App Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="app_name" id="app_name" value ="<?= isset($value) && isset($value->app_name)  ? $value->app_name : '' ?>" placeholder="Enter App Name" required="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="input_url">Website URL <span class="text-danger">*</span></label>
                                    <input type="url" class="form-control" name="url" id="input_url" value ="<?= isset($value) && isset($value->url)  ? $value->url : '' ?>" placeholder="https://meetmighty.com/" required="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="appLanuguage">App Language <span class="text-danger">*</span></label>
                                    <select class="form-control" name="appLanuguage">
                                        <option value=""> Select </option>
                                        <?php
                                            foreach ($lanuguage as $k => $val) {
                                        ?>
                                           <option value="<?= $k ?>" <?php if(isset($value) && isset($value->appLanuguage) && ($k == $value->appLanuguage)) echo "selected" ?> > <?= $val ?></option>
                                        <?php }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="image" class="form-label">App Logo</label>
                                    <div class="d-flex justify-content-between">
                                        <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input" id="customFile" accept="image/*" name="app_logo">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <div class="mm-avatar col-md-2">
                                            <img class="avatar-40 rounded app_logo_preview" src="<?= isset($value) && isset($value->app_logo)  ? $value->app_logo.'?'.time() : '../upload/default.png' ?>" alt="#img" data-original-title="" title="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="navigation_style">Navigation Style</label>
                                    <select class="form-control" name="navigationStyle" id="navigationStyle">
                                        <!-- <option value=""> Select </option> -->
                                        <?php
                                            foreach ($navigation_style as $k => $val) {
                                        ?>
                                           <option value="<?= $k ?>" <?php if(isset($value) && isset($value->navigationStyle) && ($k == $value->navigationStyle)) echo "selected" ?> > <?= $val ?></option>
                                        <?php }

                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="header_style">Header Style</label>
                                    <select class="form-control" name="header_style">
                                        <!-- <option value=""> Select </option> -->
                                        <?php
                                            foreach ($header_style as $k => $val) {
                                        ?>
                                           <option value="<?= $k ?>" <?php if(isset($value) && isset($value->header_style) && ($k == $value->header_style)) echo "selected" ?> > <?= $val ?></option>
                                        <?php }

                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-12 tab_style">
                                    <label for="tab_style">Tabs Style</label>
                                    <div class="d-flex justify-content-between">
                                    <?php
                                        foreach ($tab_style as $k => $opt){
                                            $selected = (isset($value->tab_style) && $value->tab_style == $opt->value) ? "checked" : "";
                                        ?>
                                        
                                        <div class="col-md-4 d-inline">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="tab_style" id="tradio_<?= $k ?>" value="<?= $opt->value ?>" <?= $selected ?>  class="custom-control-input">
                                                <label class="custom-control-label" for="tradio_<?= $k ?>" ><?= $opt->label ?></label>
                                            </div>

                                            <div class="mm-avatar">
                                                <img class="mh-100 w-100 rounded" src="<?= ($opt->preview != null) ? $opt->preview : '../assets/images/default.png' ?>" alt="#" data-original-title="" title="">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>

                                <!-- Bottom navigation option -->
                                <div class="form-group col-md-12 bottom_navigation">
                                    <label for="bottom_navigation">Bottom Navigation style</label>
                                    <div class="d-flex justify-content-between">
                                    <?php
                                        foreach ($bottom_navigation as $n => $nav){
                                            $selected = (isset($value->bottom_navigation) && $value->bottom_navigation == $nav->value) ? "checked" : "";
                                        ?>
                                        
                                        <div class="col-md-4 d-inline">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="bottom_navigation" id="nav_<?= $n ?>" value="<?= $nav->value ?>" <?= $selected ?>  class="custom-control-input">
                                                <label class="custom-control-label" for="nav_<?= $n ?>" ><?= $nav->label ?></label>
                                            </div>

                                            <div class="mm-avatar"> 
                                                <img class="mh-100 w-100 rounded" src="<?= ($nav->preview != null) ? $nav->preview : '../assets/images/default.png' ?>" alt="#" data-original-title="" title="">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>
                                <!-- end bottom navigation option -->

                                <div class="col-md-4">
                                    <label>Disable Header </label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="disable_headerYes" name="disable_header" value="true" <?php if($disable_header == "true") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="disable_headerYes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="disable_headerNo" name="disable_header" value="false" <?php if($disable_header == "false") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="disable_headerNo"> No </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Disable Footer</label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="disable_footerYes" name="disable_footer" value="true" <?php if($disable_footer == "true") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="disable_footerYes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="disable_footerNo" name="disable_footer" value="false" <?php if($disable_footer == "false") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="disable_footerNo"> No </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Disable Left Icon</label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="disable_left_iconYes" name="disable_left_icon" value="true" <?php if($disable_left_icon == "true") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="disable_left_iconYes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="disable_left_iconNo" name="disable_left_icon" value="false" <?php if($disable_left_icon == "false") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="disable_left_iconNo"> No </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Javascript Enable? </label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="isJavascriptYes" name="isJavascriptEnable" value="true" <?php if($isJavascript == "true") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="isJavascriptYes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="isJavascriptNo" name="isJavascriptEnable" value="false" <?php if($isJavascript == "false") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="isJavascriptNo"> No </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Required Splash Screen? </label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="isSplashScreenYes" name="isSplashScreen" value="true" <?php if($isSplashScreen == "true") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="isSplashScreenYes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="isSplashScreenNo" name="isSplashScreen" value="false" <?php if($isSplashScreen == "false") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="isSplashScreenNo"> No </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Is Support Zoom Functionality? </label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="isZoomFunctionalityYes" name="isZoomFunctionality" value="true" <?php if($isZoomFunctionality == "true") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="isZoomFunctionalityYes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="isZoomFunctionalityNo" name="isZoomFunctionality" value="false" <?php if($isZoomFunctionality == "false") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="isZoomFunctionalityNo"> No </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Required WalkThrough? </label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="is_walkthrough_yes" name="is_walkthrough" value="true" <?php if($is_walkthrough == "true") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="is_walkthrough_yes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="is_walkthrough_no" name="is_walkthrough" value="false" <?php if($is_walkthrough == "false") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="is_walkthrough_no"> No </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Is Support WebRTC Functionality? </label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="is_webrtc_yes" name="is_webrtc" value="true" <?php if($is_webrtc == "true") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="is_webrtc_yes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="is_webrtc_no" name="is_webrtc" value="false" <?php if($is_webrtc == "false") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="is_webrtc_no"> No </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Is Enable Pull to Refresh? </label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="is_pull_refresh_yes" name="is_pull_refresh" value="true" <?php if($is_pull_refresh == "true") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="is_pull_refresh_yes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="is_pull_refresh_no" name="is_pull_refresh" value="false" <?php if($is_pull_refresh == "false") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="is_pull_refresh_no"> No </label>
                                        </div>
                                    </div>
                                </div>

                                 <!-- Walkthrough options start -->
                                 <div class="form-group col-md-12 walkthrough_style  mb-4">
                                    <label for="walkthrough_style"> Walkthrough Style</label>
                                    <div class="d-flex justify-content-between">
                                    <?php
                                        foreach ($walkthrough_style as $w => $walk){
                                            $selected = (isset($value->walkthrough_style) && $value->walkthrough_style == $walk->value) ? "checked" : "";
                                        ?>
                                        
                                        <div class="col-md-4 d-inline">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="walkthrough_style" id="walk_<?= $w ?>" value="<?= $walk->value ?>" <?= $selected ?>  class="custom-control-input">
                                                <label class="custom-control-label" for="walk_<?= $w ?>" ><?= $walk->label ?></label>
                                            </div>

                                            <div class="mm-avatar"> 
                                                <img class="" src="<?= ($walk->preview != null) ? $walk->preview : '../assets/images/default.png' ?>" alt="<?= $walk->preview ?>" data-original-title="" title="">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                                    
                                </div>
                                <!--Walkthrough option end-->

                                <div class="form-group col-md-4">
                                    <label> Clear Cookies? </label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="clear_cookie_yes" name="clear_cookie" value="true" <?php if($clear_cookie == "true") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="clear_cookie_yes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="clear_cookie_no" name="clear_cookie" value="false" <?php if($clear_cookie == "false") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="clear_cookie_no"> No </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label> Required Exit Popup Screen? </label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="isExitPopupScreenYes" name="isExitPopupScreen" value="true" <?php if($isExitPopupScreen == "true") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="isExitPopupScreenYes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="isExitPopupScreenNo" name="isExitPopupScreen" value="false" <?php if($isExitPopupScreen == "false") {echo "checked";} ?> class="custom-control-input">
                                            <label class="custom-control-label" for="isExitPopupScreenNo"> No </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label>Required Floating Action Button?</label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="is_floating_button_yes" name="is_floating_button" value="true" <?php if($is_floating_button == "true") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="is_floating_button_yes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="is_floating_button_no" name="is_floating_button" value="false" <?php if($is_floating_button == "false") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="is_floating_button_no"> No </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-4 floating_button">
                                    <label for="image" class="form-label">Floating Button Logo</label>
                                    <div class="d-flex justify-content-between">
                                        <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input" id="floatingbutton" accept="image/*" name="floating_button">
                                            <label class="custom-file-label" for="floatingbutton">Choose file</label>
                                        </div>
                                        <div class="mm-avatar col-md-2">
                                            <img class="avatar-60 rounded floating_button_preview" src="<?= isset($value) && isset($value->floating_button)  ? $value->floating_button.'?'.time() : '../upload/default.png' ?>" alt="#img" data-original-title="" title="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 floating_button">
                                    <label for="floating_button_style">Floating Button Style</label>
                                    
                                    <div class="d-flex justify-content-between">
                                    <?php
                                        foreach ($floating_button_style as $k => $opt){
                                            $selected = (isset($value->floating_button_style) && $value->floating_button_style == $opt->value) ? "checked" : "";
                                        ?>
                                        
                                        <div class="col-md-4 d-inline">
                                            <div class="custom-control custom-radio custom-control-inline col-md-2">
                                                <input type="radio" name="floating_button_style" id="radio_<?= $k ?>" value="<?= $opt->value ?>" <?= $selected ?>  class="custom-control-input">
                                                <label class="custom-control-label" for="radio_<?= $k ?>" ><?= $opt->label ?></label>
                                            </div>

                                            <div class="mm-avatar col-md-2">
                                                <img class="avatar-100 rounded" src="<?= ($opt->preview != null) ? $opt->preview : '../assets/images/default.png' ?>" alt="#" data-original-title="" title="">
                                            </div>
                                        </div>
                                    <?php } ?>
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