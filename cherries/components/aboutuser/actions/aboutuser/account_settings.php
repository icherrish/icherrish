<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 
$user_get = ossn_user_by_username(input('username'));
if ((!$user_get) || ($user_get && $user_get->guid !== ossn_loggedin_user()->guid)) {
		redirect('home');
}
$user_get->data = new stdClass;
$guid = $user_get->guid;
if (!empty($guid)) {
		$user_get->data->aboutuser_access = input('aboutuser_access');
		$user_get->save();
		ossn_trigger_message(ossn_print('user:updated'), 'success');
}
redirect(REF);
