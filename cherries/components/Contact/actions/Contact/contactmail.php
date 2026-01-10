<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team | Sathish Kumar <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED, 2014 webbehinds
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

header('Content-Type: application/json');

$subject = ossn_print('contact:mail:subject');
$message = input('message');
$message = html_entity_decode($message, ENT_QUOTES, "UTF-8");
$message = strip_tags($message);
$message = ossn_restore_new_lines($message);
$name = input('name');
$cemail = input('email');
$body = ossn_print('contact:mail:body', array(
                        $name,
                        $cemail,
                        $message
                    ));

$settings = new OssnComponents;
$settings = $settings->getComSettings('contact');
if ($settings && isset($settings->email) && !empty($settings->email)) {
	$email = $settings->email;
} else {
	$email = ossn_site_settings('owner_email');
	error_log('Warning: Contact component not properly configured yet - site owner email [' . ossn_site_settings('owner_email') . '] used as fallback');
}

if (!empty($message) && !empty($cemail) && !empty($name)) {
	if(!filter_var($cemail, FILTER_VALIDATE_EMAIL, FILTER_FLAG_EMAIL_UNICODE)) {
		$em['dataerr'] = ossn_print('contact:admin:settings:email:invalid');
    		echo json_encode($em);
    		exit;
	}
	$mail = new OssnMail;
	if ($mail->NotifiyUser($email, $subject, $body)) {
		$em['success'] = 1;
		echo json_encode($em);
		exit;
	}
	else {
		$em['dataerr'] = ossn_print('contact:form:message:not:sent');
    		echo json_encode($em);
    		exit;
	}
}
else {
	$em['dataerr'] = ossn_print('contact:form:message:incomplete');
	echo json_encode($em);
	exit;
}
