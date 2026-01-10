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

$user = ossn_loggedin_user();

if (!isset($user->aboutuser_access) && isset($user->{'com:aboutuser:display:data'})) {
		switch ($user->{'com:aboutuser:display:data'}) {
				case 'yes':
						$user->aboutuser_access = OSSN_PUBLIC;
						break;
				case 'friends':
						$user->aboutuser_access = OSSN_FRIENDS;
						break;
				case 'no':
						$user->aboutuser_access = OSSN_PRIVATE;
						break;
		}
} 

$params['aboutuser_access'] = (isset($user->aboutuser_access) ? $user->aboutuser_access : OSSN_PUBLIC);
$params['username'] = $user->username;
echo ossn_view_form('account_settings/aboutuser', array(
		'action' => ossn_site_url() . 'action/aboutuser/account_settings',
		'component' => 'aboutuser',
		'params' => $params
), false);