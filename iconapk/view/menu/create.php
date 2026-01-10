<?php
require_once("../configuration/connection.php");

    $value = null;
    $id = isset($_GET) && isset($_GET['id']) ? $_GET['id'] : null;
    $app_query = "SELECT * FROM `app_settings` WHERE `key` = 'appconfiguration'";
    
    $record = mysqli_query($mysqli,$app_query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($record) > 0){
        $row = mysqli_fetch_array($record);
        $value = json_decode($row['value']);
        $menu_type =  isset($value) && isset($value->navigationStyle) ? $value->navigationStyle : null;
    }else{
        $value = null;
        $menu_type = null;
    }

    $query = "SELECT * FROM `menu` WHERE `id` = '".$id."' ";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
    }else {
        $row = null;
    }

    // if($menu_type == 'sidedrawer' || $menu_type ==  'sidedrawer_bottom_navigation'){
    if(in_array($menu_type, ['sidedrawer', 'sidedrawer_bottom_navigation', 'sidedrawer_tabs'])){
        $condition = ($row != null) ? " `id` != $id " : "0 = 0";
        
        $menu_list = [];
        $menu_query = "SELECT * FROM `menu` WHERE `type` = 'sidedrawer' ";
        if( $row != null ){
            $menu_query = $menu_query. " AND `id` != '".$id."' ";
        }
        $menu_result = mysqli_query($mysqli,$menu_query) or die(mysqli_error($mysqli));

        if(mysqli_num_rows($menu_result) > 0){
            while($rows = mysqli_fetch_assoc($menu_result)){
                $menu_list[] = [
                    'text' => $rows['title'],
                    'value'=> $rows['id']
                ];
            }
        }

        $menu_style = [
            'sidedrawer' => 'Side Drawer',
            'bottom_navigation' => 'Bottom Navigation',
        ];
    }

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Menu <?= ucfirst(str_replace('_',' ', $row['type'])) ?></h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="post"  action="./menu/save.php" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id ?>" />
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" value ="<?= isset($row) && isset($row['title'])  ? $row['title'] : '' ?>" placeholder="Enter title" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="url" class="form-label">URL </label>
                                    <input type="url" class="form-control" name="url" id="url" value ="<?= isset($row) && isset($row['url'])  ? $row['url'] : '' ?>" placeholder="Enter URL">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image" class="form-label">Image</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="customFile" accept="image/*" name="image">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                
                                <?php
                                    $image = isset($row) && isset($row['image']) ? $row['image'] : 'default.png';
                                    $path = '../upload/menu/';
                                ?>
                                <div class="form-group col-md-6 mt-3">
                                    <div class="mm-avatar">
                                        <img class="avatar-60 rounded image_preview" src="<?= $path.$image ?>" alt="#" data-original-title="" title="">
                                    </div>
                                </div>
                                <?php
                                    if( $menu_type == 'sidedrawer_bottom_navigation' ){
                                ?>
                                    <div class="form-group col-md-6  <?= $id != null ? 'd-none' : '' ?>">
                                        <label for="menu_style">Menu Style</label>
                                        <select class="form-control menu_style" name="type" id="type" >
                                            <?php
                                                foreach ($menu_style as $k => $val) {
                                            ?>
                                                <option value="<?= $k ?>" <?= (isset($row) && isset($row['type']) && ($k == $row['type'])) ? "selected" : "" ?>> <?= $val ?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                <?php
                                    } elseif($menu_type == 'sidedrawer_tabs') {
                                       echo '<input type="hidden" name="type" value="sidedrawer" />';
                                    } else {
                                        echo '<input type="hidden" name="type" value="'.$menu_type.'" />';
                                    }
                                ?>
                                <?php 
                                    if( in_array($menu_type, ['sidedrawer','sidedrawer_bottom_navigation', 'sidedrawer_tabs'])){
                                ?>
                                    <div class="form-group col-md-6 parent_menu_id">
                                        <label for="parent_id">Parent Menu </label>
                                        <select class="form-control" name="parent_id">
                                            <option value=""> Select </option>
                                            <?php
                                                foreach ($menu_list as $k => $val) {
                                            ?>
                                                <option value="<?= $val['value'] ?>" <?php if(isset($row) && isset($row['parent_id']) && ($val['value'] == $row['parent_id'])) echo "selected" ?> > <?= $val['text'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
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