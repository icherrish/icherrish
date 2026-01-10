<?php
    session_start();
    require_once("../../configuration/connection.php");

    $query = "SELECT * FROM `app_settings` WHERE `key` = 'onesignal_configuration'";

    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $value = json_decode($row['value']);
    }else {
        $value = null;
    }

    $title = $_POST['title'];
    $message = $_POST['message'];
    $url = $_POST['url'];

	$heading = [
        "en" => $title,
    ];
    $content = [
        "en" => $message,
    ];
    
    $app_id = isset($value) && isset($value->app_id) ? $value->app_id : '';
    $rest_api_key = isset($value) && isset($value->rest_api_key) ? $value->rest_api_key : '';

    $fields = [
        'app_id' => $app_id,
        'included_segments' => array('All'), // array('Test')
        'data' => [ 'foo' => 'bar' ],
        'contents' => $content,
        'headings' => $heading,
    ];

    if (isset($url)) {
		$fields['url'] = $url;
	}
    if($_SESSION['user'] != 'demo@admin.com'){
    if (isset($_FILES['image']) && file_exists($_FILES['image']['tmp_name'])) {

        move_uploaded_file($_FILES['image']['tmp_name'], '../../upload/onesignal.png');

        // $http = !empty($_SERVER['HTTPS']) ? 'https' : 'http';
        // $host = $_SERVER['HTTP_HOST'];
        // $image_url = $http.'://'.$host.'/upload/onesignal.png';
        $host = str_replace("/view/index.php?page=onesignal_send",'',$_SERVER['HTTP_REFERER'] );
        $image_url = $host.'/upload/onesignal.png';

        $fields['big_picture'] = $image_url;
    }
    
    $sendContent = json_encode($fields, JSON_UNESCAPED_UNICODE);
    // print_r($sendContent);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER,
                        array('Content-Type: application/json; charset=utf-8',
                                'Authorization: Basic '.$rest_api_key
                        ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $sendContent);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
}
    // print_r($response);
    $_SESSION['success'] = "Notification sent successfully.";

    header("Location: ../../view/index.php?page=onesignal_send");
?>