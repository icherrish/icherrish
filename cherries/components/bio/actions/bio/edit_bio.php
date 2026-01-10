<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   bio
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
$user_get = ossn_user_by_username(input('username'));
if ((!$user_get) || ($user_get && $user_get->guid !== ossn_loggedin_user()->guid)) {
	redirect("home");
}
$user_get->data = new stdClass;
$guid = $user_get->guid;
if (!empty($guid)) {
	$user_get->data->bio = input('bio');
	$user_get->data->bio_access = input('bio_access');
	$user_get->save();
	ossn_trigger_message(ossn_print('user:updated'), 'success');
}
redirect(REF);
