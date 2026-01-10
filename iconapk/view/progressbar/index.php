<?php

require_once("../configuration/connection.php");
$query = "SELECT * FROM `app_settings` WHERE `key` = 'progressbar'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $value = json_decode($row['value']);
        $is_progressbar = isset($value->is_progressbar) && ($value->is_progressbar) ? $value->is_progressbar : "false";
    }else {
        $value = null;
        $is_progressbar = "true";
    }

    $options = '[
        { "value" : "RotatingPlane", "label" : "RotatingPlane", "preview" : "../assets/images/art/RotatingPlane.gif"  },
        { "value" : "DoubleBounce", "label" : "DoubleBounce", "preview" : "../assets/images/art/DoubleBounce.gif"  },
        { "value" : "WanderingCubes", "label" : "WanderingCubes", "preview" : "../assets/images/art/WanderingCubes.gif"  },
        { "value" : "Pulse", "label" : "Pulse", "preview" : "../assets/images/art/Pulse.gif"  },
        { "value" : "ChasingDots", "label" : "ChasingDots", "preview" : "../assets/images/art/ChasingDots.gif"  },
        { "value" : "FadingFour", "label" : "FadingFour", "preview" : "../assets/images/art/FadingFour.gif"  },
        { "value" : "Circle", "label" : "Circle", "preview" : "../assets/images/art/Circle.gif"  },
        { "value" : "FadingCircle", "label" : "FadingCircle", "preview" : "../assets/images/art/FadingCircle.gif"  },
        { "value" : "FoldingCube", "label" : "FoldingCube", "preview" : "../assets/images/art/FoldingCube.gif"  },
        { "value" : "RotatingCircle", "label" : "RotatingCircle", "preview" : "../assets/images/art/RotatingCircle.gif"  },
        { "value" : "Wave", "label" : "Wave", "preview" : "../assets/images/art/Wave.gif" },
        { "value" : "Ring", "label" : "Ring", "preview" : "../assets/images/art/Ring.gif" }
    ]';
    
    $options = json_decode($options);

    
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">ProgressBar Style</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="post"  action="savesetting.php">
                            <input type="hidden" name="type" value="progressbar" />
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Required ProgressBar? </label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="is_progressbar_yes" name="is_progressbar" value="true" <?php if($is_progressbar == "true") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="is_progressbar_yes"> Yes </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="is_progressbar_no" name="is_progressbar" value="false" <?php if($is_progressbar == "false") {echo "checked";} ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="is_progressbar_no"> No </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                    foreach ($options as $k => $opt){
                                        $selected = (isset($value->loaderStyle) && $value->loaderStyle == $opt->value) ? "checked" : "";
                                ?>
                                    <div class="form-group col-md-4 progressbar_style">
                                        <div class="custom-control custom-radio custom-control-inline col-md-2">
                                            <input type="radio" name="loaderStyle" id="radio_<?= $k ?>" value="<?= $opt->value ?>" <?= $selected ?>  class="custom-control-input">
                                            <label class="custom-control-label" for="radio_<?= $k ?>" ><?= $opt->label ?></label>
                                        </div>
                                        <div class="mm-avatar col-md-2">
                                            <img class="avatar-40 rounded" src="<?= ($opt->preview != null) ? $opt->preview : '../assets/images/default.png' ?>" alt="#" data-original-title="" title="">
                                        </div>
                                    </div>
                                <?php } ?>
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