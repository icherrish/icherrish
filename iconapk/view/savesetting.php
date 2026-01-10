<?php
session_start();
require_once("../configuration/connection.php");

    $key = $_POST['type'];


    switch ($key) {
        case "appconfiguration":
                $values = [
                    'app_name'              => $_POST['app_name'],
                    'url'                   => $_POST['url'],
                    'appLanuguage'          => $_POST['appLanuguage'],
                    'isJavascriptEnable'    => $_POST['isJavascriptEnable'],
                    'isSplashScreen'        => $_POST['isSplashScreen'],
                    'isZoomFunctionality'   => $_POST['isZoomFunctionality'],
                    'navigationStyle'       => $_POST['navigationStyle'],
                    'header_style'          => $_POST['header_style'],
                    'is_walkthrough'        => $_POST['is_walkthrough'],
                    'is_webrtc'             => $_POST['is_webrtc'],
                    'is_floating_button'    => $_POST['is_floating_button'],
                    'floating_button_style' => $_POST['floating_button_style'],
                    'is_pull_refresh'       => $_POST['is_pull_refresh'],
                    'tab_style'             => $_POST['tab_style'],
                    'bottom_navigation'     => $_POST['bottom_navigation'],
                    'walkthrough_style'     => $_POST['walkthrough_style'],
                    'clear_cookie'          => $_POST['clear_cookie'],
                    'isExitPopupScreen'     => $_POST['isExitPopupScreen'],
                    'disable_header'        => $_POST['disable_header'],
                    'disable_footer'        => $_POST['disable_footer'],
                    'disable_left_icon'     => $_POST['disable_left_icon'],
                ];
                
                if($_SESSION['user'] != 'demo@admin.com'){
                    $host = str_replace("/view/index.php?page=appconfiguration",'',$_SERVER['HTTP_REFERER'] );
                    $image_url = $host.'/upload/app_logo.png';
                    $floating_image_url = $host.'/upload/floating_button.png';

                    if (isset($_FILES['app_logo']) && file_exists($_FILES['app_logo']['tmp_name'])) {
                        move_uploaded_file($_FILES['app_logo']['tmp_name'], '../upload/app_logo.png');
                        $values['app_logo'] = $image_url;
                    }else{
                        $values['app_logo'] = $image_url;
                    }

                    if (isset($_FILES['floating_button']) && file_exists($_FILES['floating_button']['tmp_name'])) {
                        move_uploaded_file($_FILES['floating_button']['tmp_name'], '../upload/floating_button.png');
                        $values['floating_button'] = $floating_image_url;
                    }else{
                        $values['floating_button'] = $floating_image_url;
                    }
                }
            break;
        case "admob":
                $values = [
                    'ads_type' => $_POST['ads_type'],
                    'admobBannerID' => $_POST['admobBannerID'],
                    'admobIntentialID' => $_POST['admobIntentialID'],
                    'admobBannerIDIOS' => $_POST['admobBannerIDIOS'],
                    'admobIntentialIDIOS' => $_POST['admobIntentialIDIOS'],

                    'facebookBannerID'          => $_POST['facebookBannerID'],
                    'facebookIntentialID'       => $_POST['facebookIntentialID'],
                    'facebookBannerIDIOS'       => $_POST['facebookBannerIDIOS'],
                    'facebookIntentialIDIOS'    => $_POST['facebookIntentialIDIOS'],
                ];
            break;
        case "progressbar":
                $values = [
                    'is_progressbar'        => $_POST['is_progressbar'],
                    'loaderStyle' => $_POST['loaderStyle'],
                ];
                break;
        case "theme":
                    $values = [
                        'themeStyle' => $_POST['themeStyle'],
                        'customColor' => ($_POST['themeStyle'] == 'Custom') ? $_POST['customColor'] : null,
                        'gradientColor1' => ($_POST['themeStyle'] == 'Gradient') ? $_POST['gradientColor1'] : null,
                        'gradientColor2' => ($_POST['themeStyle'] == 'Gradient') ? $_POST['gradientColor2'] : null,
                    ];
                    break;
        case "about":
            $values = [
                "whatsAppNumber"=> $_POST["whatsAppNumber"],
                "instagramUrl"  => $_POST["instagramUrl"],
                "twitterUrl"    => $_POST["twitterUrl"],
                "facebookUrl"   => $_POST["facebookUrl"],
                "callNumber"    => $_POST["callNumber"],
                "snapchat"      => $_POST["snapchat"], 
                "skype"         => $_POST["skype"], 
                "messenger"      => $_POST["messenger"], 
                "youtube"       => $_POST["youtube"], 
                "isShowAbout"   => $_POST["isShowAbout"],
                "copyright"     => $_POST["copyright"],
                "description"     => $_POST["description"],
            ];
            break;
        case "onesignal_configuration" : 
            $values = [
                'app_id' => $_POST['app_id'],
                'rest_api_key' => $_POST['rest_api_key'],
            ];
            break;
        case "splash_configuration" : 

            $values = [
                'first_color' => $_POST['first_color'],
                'second_color' => $_POST['second_color'],
                'title' => $_POST['title'],
                'enable_title' => ( isset($_POST['enable_title']) && $_POST['enable_title']  == 'on') ? 'true' : 'false',
                'title_color' => $_POST['title_color'],
                'enable_logo' => ( isset($_POST['enable_logo']) && $_POST['enable_logo']  == 'on' ) ? 'true' : 'false',
                'enable_background' => ( isset($_POST['enable_background']) && $_POST['enable_background']  == 'on') ? 'true' : 'false',
            ];

            if($_SESSION['user'] != 'demo@admin.com'){
                $host = str_replace("/view/index.php?page=splash_configuration",'',$_SERVER['HTTP_REFERER'] );
                $splash_logo_url = $host.'/upload/splash_logo.png';
                $splash_background_url = $host.'/upload/splash_background.png';

                if (isset($_FILES['splash_logo_url']) && file_exists($_FILES['splash_logo_url']['tmp_name'])) {
                    move_uploaded_file($_FILES['splash_logo_url']['tmp_name'], '../upload/splash_logo.png');
                    $values['splash_logo_url'] = $splash_logo_url;
                }else{
                    $values['splash_logo_url'] = $splash_logo_url;
                }

                if (isset($_FILES['splash_background_url']) && file_exists($_FILES['splash_background_url']['tmp_name'])) {
                    move_uploaded_file($_FILES['splash_background_url']['tmp_name'], '../upload/splash_background.png');
                    $values['splash_background_url'] = $splash_background_url;
                }else{
                    $values['splash_background_url'] = $splash_background_url;
                }

            }
            break;

        case "exitpopup_configuration" : 

            $values = [
                'title' => $_POST['title'],
                'positive_text' => $_POST['positive_text'],
                'negative_text' => $_POST['negative_text'],
                'enable_image' => ( isset($_POST['enable_image']) && $_POST['enable_image']  == 'on' ) ? 'true' : 'false',
            ];
                    
            if($_SESSION['user'] != 'demo@admin.com'){
                $host = str_replace("/view/index.php?page=exitpopup_configuration",'',$_SERVER['HTTP_REFERER'] );
                $exit_image_url = $host.'/upload/cancel.png';
            
                if (isset($_FILES['exit_image_url']) && file_exists($_FILES['exit_image_url']['tmp_name'])) {
                    move_uploaded_file($_FILES['exit_image_url']['tmp_name'], '../upload/cancel.png');
                    $values['exit_image_url'] = $exit_image_url;
                }else{
                    $values['exit_image_url'] = $exit_image_url;
                }
            
            }
            break;
        case "share_content" : 
                $values = [
                    'share' => $_POST['share'],
                ];
            break;
            default:
                $values = (object) [];
                break;
      }
    
    $value = json_encode($values,JSON_UNESCAPED_UNICODE);

    if( $key == null ) {
        header("Location: index.php");
        die;
    }
    // print_r($value);
    $query = "SELECT * FROM `app_settings` WHERE `key` = '".$key."'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));

    if( $_SESSION['user'] != "demo@admin.com" ){
        if(mysqli_num_rows($result) > 0){
            $record = "UPDATE `app_settings` SET `value` = '".$value."' WHERE `key` = '".$key."' ";
            $message = "Setting has been updated successfully";
        } else {
            $record = "INSERT INTO `app_settings` VALUES(NULL,'".$key."', '".$value."')";
            $message = "Setting has been saved successfully";
        }
    
        if(mysqli_query($mysqli, $record)){
            $_SESSION['success'] = $message;
        } else{
            $_SESSION['error'] = "Settings has been failed .";
        }
    }else{
        $_SESSION['error'] = "Demo User Don\'t have permission for this action.";
    }
    header("Location: ../view/index.php?page=$key");
    // print_r($query);die;
?>