<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   bio
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
$user = ossn_loggedin_user();
$params['bio'] = (isset($user->bio) ? $user->bio : '');
$params['bio_access'] = (isset($user->bio_access) ? $user->bio_access : OSSN_PUBLIC);
$params['username'] = $user->username;
echo ossn_view_form('account_settings/bio', array(
	'action' => ossn_site_url() . 'action/bio/edit_bio',
	'component' => 'bio',
	'params' => $params	
), false);