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

define('__ABOUTUSER__', ossn_route()->com . 'aboutuser/');
/**
 * Initialize component
 *
 * @return void
 */
function com_aboutuser_init() {
	ossn_add_hook('required', 'components', 'com_aboutuser_asure_requirements');
	$component = new OssnComponents();
	// don't interfere with Custom Profile Fields component
	// because CustomFields is using its own About page
	if (!$component->isActive('CustomFields')) {
		if (ossn_isLoggedin()) {
			ossn_add_hook('profile', 'about:section', 'com_aboutuser_profile_about_user_page');
			ossn_add_hook('profile', 'subpage', 'com_aboutuser_profile_about_user_page_layout');
			ossn_add_hook('profile', 'modules', 'com_aboutuser_profile_modules_about', 99);

			ossn_register_callback('page', 'load:profile', 'com_aboutuser_profile_about_user');

			ossn_profile_subpage('about');
			ossn_extend_view('css/ossn.default', 'css/aboutuser');
						
			ossn_register_menu_item('profile/about/tabs', array(
				'name' => 'basic',
				'href' => '?section=basic',
				'text' => ossn_print('com:aboutuser:aboutuser'),
				'priority' => 1, 
			));

			ossn_add_hook('profile', 'edit:section', 'com_aboutuser_profile_edit_section_page');
			ossn_register_menu_item('profile/edit/tabs', array(
				'name' => 'aboutuser',
				'href' => '?section=aboutuser',
				'text' => ossn_print('com:aboutuser:aboutuser'),
			));
			ossn_register_action('aboutuser/account_settings', __ABOUTUSER__ . 'actions/aboutuser/account_settings.php');
		}
	}
}

function com_aboutuser_profile_modules_about($hook, $type, $modules, $params) {
	if (!isset($params['user']->aboutuser_access) && isset($params['user']->{'com:aboutuser:display:data'})) {
		switch ($params['user']->{'com:aboutuser:display:data'}) {
			case 'yes':
				$params['user']->aboutuser_access = OSSN_PUBLIC;
				break;
			case 'friends':
				$params['user']->aboutuser_access = OSSN_FRIENDS;
				break;
			case 'no':
				$params['user']->aboutuser_access = OSSN_PRIVATE;
				break;
		}
	} 
	if (!isset($params['user']->aboutuser_access)) {
		$params['user']->aboutuser_access = OSSN_PUBLIC;
	}
	if ($params['user']->aboutuser_access == OSSN_PUBLIC ||
	($params['user']->aboutuser_access == OSSN_FRIENDS && ossn_isLoggedin() && ossn_loggedin_user()->isFriend(ossn_loggedin_user()->guid, $params['user']->guid)) ||
	(ossn_isLoggedin() && ossn_loggedin_user()->guid == $params['user']->guid) ||
	ossn_isAdminLoggedin()) {
		$content = ossn_plugin_view('profile/about', $params);
		$title   = ossn_print('com:aboutuser:aboutuser');
		$modules[] = ossn_view_widget(array(
			'title' => $title,
			'contents' => $content
		));

	}
	return $modules;
}

function com_aboutuser_profile_about_user_page($hook, $type, $return, $params) {
	if ($params['section'] == 'basic') {
		return ossn_plugin_view('profile/above', $params);
	}
}

function com_aboutuser_asure_requirements($hook, $type, $return, $params) {
	$return[] = 'OssnProfile';
	return $return;
}

/**
 * Register an about user menu tab in user timeline menu
 *
 * @return void
 */
function com_aboutuser_profile_about_user() {
	$owner = ossn_user_by_guid(ossn_get_page_owner_guid());

	if (!isset($owner->aboutuser_access) && isset($owner->{'com:aboutuser:display:data'})) {
		switch ($owner->{'com:aboutuser:display:data'}) {
			case 'yes':
				$owner->aboutuser_access = OSSN_PUBLIC;
				break;
			case 'friends':
				$owner->aboutuser_access = OSSN_FRIENDS;
				break;
			case 'no':
				$owner->aboutuser_access = OSSN_PRIVATE;
				break;
		}
	} 

	if (!isset($owner->aboutuser_access)) {
		$owner->aboutuser_access = OSSN_PUBLIC;
	}

	if ($owner->aboutuser_access == OSSN_PUBLIC ||
	($owner->aboutuser_access == OSSN_FRIENDS && ossn_isLoggedin() && ossn_loggedin_user()->isFriend(ossn_loggedin_user()->guid, $owner->guid)) ||
	(ossn_isLoggedin() && ossn_loggedin_user()->guid == $owner->guid) ||
	ossn_isAdminLoggedin()) {
		ossn_register_menu_link('aboutuser', 'com:aboutuser:aboutuser', $owner->profileURL('/about'), 'user_timeline');
	}
}

/**
 * Register user about page
 *
 * @return string
 */
function com_aboutuser_profile_about_user_page_layout($hook, $type, $return, $params){
	$page = $params['subpage'];
	if ($page == 'about') {
		if (!isset($params['user']->aboutuser_access) && isset($params['user']->{'com:aboutuser:display:data'})) {
			switch ($params['user']->{'com:aboutuser:display:data'}) {
				case 'yes':
					$params['user']->aboutuser_access = OSSN_PUBLIC;
					break;
				case 'friends':
					$params['user']->aboutuser_access = OSSN_FRIENDS;
					break;
				case 'no':
					$params['user']->aboutuser_access = OSSN_PRIVATE;
					break;
			}
		} 
		if (!isset($params['user']->aboutuser_access)) {
			$params['user']->aboutuser_access = OSSN_PUBLIC;
		}
		if ($params['user']->aboutuser_access == OSSN_PUBLIC ||
		($params['user']->aboutuser_access == OSSN_FRIENDS && ossn_isLoggedin() && ossn_loggedin_user()->isFriend(ossn_loggedin_user()->guid, $params['user']->guid)) ||
		(ossn_isLoggedin() && ossn_loggedin_user()->guid == $params['user']->guid) ||
		ossn_isAdminLoggedin()) {
			$section = input('section', '', 'basic');
			$user['user'] = $params['user'];
			$aboutpage = ossn_plugin_view('profile/about', $params);
			$args['user'] = $user['user'];
			$args['section'] = $section;

			echo ossn_plugin_view('about/user/layout', array(
				'contents' => ossn_call_hook('profile', 'about:section', $args, $aboutpage),
			));
		}
	}
}

/**
 * Add About tab to profile edit sections
 *
 * @return string
 */
function com_aboutuser_profile_edit_section_page($hook, $type, $return, $params){
	if ($params['section'] == 'aboutuser') {
		return ossn_plugin_view('account_settings/aboutuser/about_tab');
	}
}

/**
 * Calculate user age from his birthdate
 *
 * @param string $birthday User birthdate
 *
 * @return integer
 */
function com_aboutuser_user_age($birthday = '') {
	if(empty($birthday)){
		return false;
	}
	$birthday = str_replace('/', '-', $birthday);
	$dob      = strtotime($birthday);
	if($dob === false){
		return false;
	}
	$age = 0;
	while(time() > ($dob = strtotime('+1 year', $dob))){
		++$age;
	}
	return $age;
}

ossn_register_callback('ossn', 'init', 'com_aboutuser_init');