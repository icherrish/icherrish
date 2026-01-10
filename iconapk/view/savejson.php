<?php
session_start();
require_once("../configuration/connection.php");

    $query = "SELECT * FROM `app_settings` ";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    $master_array = [];
    $navigation_style = "";
    if(mysqli_num_rows($result) > 0){
        foreach( $result as $k => $val ){
            $value = json_decode($val['value']);
            $master_array[$val['key']] = $value;

            if($val['key'] == 'appconfiguration'){
                $navigation_style = $value->navigationStyle;
            }
        }
    }

    if( $navigation_style != null && $navigation_style == 'sidedrawer_bottom_navigation' ) {
        $condition = "'" . implode( "','", ['sidedrawer','bottom_navigation'] ) . "'";
    } else {
        $condition = "'".$navigation_style."'";
    }
    
    $menu_query = "SELECT * FROM `menu` WHERE `type` IN ($condition) ";
    // $menu_query = "SELECT * FROM `menu` WHERE `type` = '".$navigation_style."' ";
    
    $menu_result = mysqli_query($mysqli,$menu_query) or die(mysqli_error($mysqli));

    $records = [];
    if(mysqli_num_rows($menu_result) > 0){
        while($row = mysqli_fetch_assoc($menu_result))
        {
            $host = str_replace("/view/index.php",'',$_SERVER['HTTP_REFERER'] );
            $row['image'] = $host.'/upload/menu/'.$row['image'];
            $records[] = $row;
        }

        $master_array['menu_style'] = array_values(buildtree($records));
    }
    
    function buildtree($src_arr, $parent_id = 0, $tree = array())
    {
        foreach($src_arr as $idx => $row)
        {
            if($row['parent_id'] == $parent_id)
            {
                foreach($row as $k => $v){
                    $tree[$row['id']][$k] = $v;
                }
                unset($src_arr[$idx]);
                $tree[$row['id']]['children'] = array_values(buildtree($src_arr, $row['id']));
            }
        }
        ksort($tree);
        return $tree;
    }
    
    $left_query = "SELECT * FROM `left_header_icon` ";
    
    $left_result = mysqli_query($mysqli,$left_query) or die(mysqli_error($mysqli));

    $records = [];
    if(mysqli_num_rows($left_result) > 0){
        while($row = mysqli_fetch_assoc($left_result))
        {
            $records[] = $row;
        }
        $master_array['header_icon']['lefticon'] = $records;
    }

    $right_query = "SELECT * FROM `right_header_icon` ";
    
    $right_result = mysqli_query($mysqli,$right_query) or die(mysqli_error($mysqli));

    $records = [];
    if(mysqli_num_rows($right_result) > 0){
        while($row = mysqli_fetch_assoc($right_result))
        {
            $records[] = $row;
        }
        $master_array['header_icon']['righticon'] = $records;
    }

    $walkthrough_query = "SELECT * FROM `walkthrough` ";
    
    $walkthrough_result = mysqli_query($mysqli,$walkthrough_query) or die(mysqli_error($mysqli));

    $walkthrough_records = [];
    if(mysqli_num_rows($walkthrough_result) > 0){
        while($row = mysqli_fetch_assoc($walkthrough_result))
        {
            $host = str_replace("/view/index.php",'',$_SERVER['HTTP_REFERER'] );
            $row['image'] = $host.'/upload/walkthrough/'.$row['image'];
            $walkthrough_records[] = $row;
        }

        $master_array['walkthrough'] = $walkthrough_records;
    }

    $floating_button_query = "SELECT * FROM `floating_button` ";
    
    $floating_button_result = mysqli_query($mysqli,$floating_button_query) or die(mysqli_error($mysqli));

    $floating_button_records = [];
    if(mysqli_num_rows($floating_button_result) > 0){
        while($row = mysqli_fetch_assoc($floating_button_result))
        {
            $host = str_replace("/view/index.php",'',$_SERVER['HTTP_REFERER'] );
            $row['image'] = $host.'/upload/floatingbutton/'.$row['image'];
            $floating_button_records[] = $row;
        }

        $master_array['floating_button'] = $floating_button_records;
    }

    $tabs_query = "SELECT * FROM `tabs` ";
    
    $tabs_result = mysqli_query($mysqli,$tabs_query) or die(mysqli_error($mysqli));

    $tabs_records = [];
    if(mysqli_num_rows($tabs_result) > 0){
        while($row = mysqli_fetch_assoc($tabs_result))
        {
            $host = str_replace("/view/index.php",'',$_SERVER['HTTP_REFERER'] );
            $row['image'] = $host.'/upload/tabs/'.$row['image'];
            $tabs_records[] = $row;
        }

        $master_array['tabs'] = $tabs_records;
    }

    $user_agent_query = "SELECT * FROM `user_agent` ";
    
    $user_agent_result = mysqli_query($mysqli,$user_agent_query) or die(mysqli_error($mysqli));

    $user_agent_records = [];
    if(mysqli_num_rows($user_agent_result) > 0){
        while($row = mysqli_fetch_assoc($user_agent_result))
        {
            $user_agent_records[] = $row;
        }

        $master_array['user_agent'] = $user_agent_records;
    }

    $pages_query = "SELECT * FROM `pages` ";
    
    $pages_result = mysqli_query($mysqli,$pages_query) or die(mysqli_error($mysqli));

    $pages_records = [];
    if(mysqli_num_rows($pages_result) > 0){
        while($row = mysqli_fetch_assoc($pages_result))
        {
            $host = str_replace("/view/index.php",'',$_SERVER['HTTP_REFERER'] );
            $row['image'] = $host.'/upload/pages/'.$row['image'];
            $pages_records[] = $row;
        }

        $master_array['pages'] = $pages_records;
    }

    if( $_SESSION['user'] != "demo@admin.com" ){
        $newJsonString = json_encode($master_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
        file_put_contents('../upload/mightyweb.json', $newJsonString);
        $_SESSION['success'] = "JSON updated successfully";
    }else{
        $_SESSION['error'] = "Demo User Don\'t have permission for this action.";
    }
    header("Location: ../index.php");
    // print_r($query);die;
?>