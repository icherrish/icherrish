<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Profile Views Counter
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
define('__PROFILE_VIEWS_COUNTER__', ossn_route()->com . 'ProfileViewsCounter/');

function com_profile_views_counter_init($callback, $type, $params)
{
	ossn_extend_view('css/ossn.default', 'ProfileViewsCounter/css');
	if (ossn_isLoggedin()) {
		ossn_add_hook('profile', 'load:content', 'com_profile_views_counter_update_and_display_views');
	}
}

function com_profile_views_counter_update_and_display_views($hook, $type, $profile_content, $params) 
{
	$count_viewing = true;
	$profile = $params['user'];

	if ($profile->guid == ossn_loggedin_user()->guid || substr_count(ossn_get_context(), '/') > 1) {
		// don't count viewing our own profile or profile subpages
		$count_viewing = false;
	}

	if (isset($profile->profile_view_count)) {
		// view count data record already exists 
		$count = $profile->profile_view_count;
		if ($count_viewing) {
			// update record with incremented count
			$profile->data->profile_view_count = ++$count;
			$profile->save();
		}
	} else {
		// the viewed member has no view count data record yet
		// in case the Profile Views component is installed
		// we have stored at least some views already ;)
		$count = ossn_get_relationships(array(
			'from'  => $profile->guid,
			'type'  => 'profile:viewed',
			'count' => true,
		));
		// so fetch these views and add 1 new
		$count++;
		$profile->data->profile_view_count = $count;
		// save initial count in new data record
		$profile->save();
	}
	if (ossn_site_settings('theme') == 'white') {
		// working way for white 7.7
		$unique_anchor = '<div id=\'profile-hr-menu\' class="profile-hr-menu visible-lg">';
		$replacement = '<div class="profile-menu-hr-container"><div class="profile_view_count">' . ossn_print('com:profile:views:counter:viewed', array($count)) . '</div>' . $unique_anchor;
		$ping = str_replace($unique_anchor, $replacement, $profile_content);
		$unique_anchor = '<div id="profile-menu" class="profile-menu">';
		$replacement = '</div>' . $unique_anchor;
		$pong = str_replace($unique_anchor, $replacement, $ping);
		return $pong;
	} else {
		// goblue 8.0 and others as of January 30, 2025
		$unique_anchor = '<div class="profile-menu-hr-container">';
		// The following insertion of the counter on the profile page REQUIRES the existence of the unique_anchor above
		$replacement   = $unique_anchor . '<div class="profile_view_count">' . ossn_print('com:profile:views:counter:viewed', array($count)) . '</div>';
		return str_replace($unique_anchor, $replacement, $profile_content);
	}
	// In case you modified your profile page or want to display the counter at a different position
	// you have to either adapt $unique_anchor accordingly
	// or add the following code to your profile page manually
	/* -----------------------------------------------------------------------------------
	<div class="profile_view_count">
	<?php
	if (isset($user->profile_view_count)) {
		echo ossn_print('com:profile:views:counter:viewed', array($user->profile_view_count));
	}
	?>
	</div>
	-------------------------------------------------------------------------------------- */

}

ossn_register_callback('ossn', 'init', 'com_profile_views_counter_init');