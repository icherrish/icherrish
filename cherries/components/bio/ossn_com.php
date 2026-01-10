<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   bio
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

define('__BIO__', ossn_route()->com . 'bio/');
require_once(__BIO__ . 'classes/Bio.php');
/**
 * Initialize component
 *
 * @return void
 */
function com_bio_init()
{
	ossn_extend_view('css/ossn.default', 'css/bio');
	ossn_profile_subpage('bio');

	ossn_register_callback('page', 'load:profile', 'com_bio_profile_bio_menu');
	ossn_add_hook('profile', 'subpage', 'com_bio_profile_bio_page');
	ossn_add_hook('required', 'components', 'com_bio_asure_requirements');

	ossn_register_callback('page', 'load:search', 'com_bio_search_menu_link');
	ossn_add_hook('search', 'type:bio', 'com_bio_search_bios_handler');

	if (ossn_isLoggedin()) {
		ossn_add_hook('profile', 'edit:section', 'com_bio_profile_edit_section_page');	
		ossn_register_menu_item('profile/edit/tabs', array(
			'name' => 'bio',
			'href' => '?section=bio',
			'text' => ossn_print('bio'),
		));
		ossn_register_action('bio/edit_bio', __BIO__ . 'actions/bio/edit_bio.php');
	}
}

function com_bio_asure_requirements($hook, $type, $return, $params)
{
	$return[] = 'OssnProfile';
	$return[] = 'TextareaSupport';
	return $return;
}

/**
 * Register the 'bio' menu tab on member profile
 *
 * @return void
 */
function com_bio_profile_bio_menu()
{
	$owner = ossn_user_by_guid(ossn_get_page_owner_guid());
	if ($owner && isset($owner->bio)) {
		if (!isset($owner->bio_access) || (isset($owner->bio_access) && $owner->bio_access == OSSN_PUBLIC || ($owner->bio_access == OSSN_FRIENDS && ossn_isLoggedin() && ossn_loggedin_user()->isFriend(ossn_loggedin_user()->guid, $owner->guid)) || (ossn_isLoggedin() && ossn_loggedin_user()->guid == $owner->guid) || ossn_isAdminLoggedin())) {
			ossn_register_menu_link('bio', 'bio', $owner->profileURL('/bio'), 'user_timeline');
		}
	}
}

/**
 * Add a pagehandler for the 'bio' sub page
 *
 * @return string
 */
function com_bio_profile_bio_page($hook, $type, $return, $params)
{
	$page = $params['subpage'];
	if ($page == 'bio' && isset($params['user']->bio)) {
		if (!isset($params['user']->bio_access) || (isset($params['user']->bio_access) && $params['user']->bio_access == OSSN_PUBLIC || ($params['user']->bio_access == OSSN_FRIENDS && ossn_isLoggedin() && ossn_loggedin_user()->isFriend(ossn_loggedin_user()->guid, $params['user']->guid)) || (ossn_isLoggedin() && ossn_loggedin_user()->guid == $params['user']->guid) || ossn_isAdminLoggedin())     ) {
			$bio_content = ossn_call_hook('textarea', 'purify', false, $params['user']->bio);
			$bio_content = ossn_call_hook('textarea', 'responsify', false, $bio_content); 
			$params['user']->bio = $bio_content;
			$content = ossn_plugin_view('profile/bio', $params);
			echo ossn_set_page_layout('module', array(
				'title' => ossn_print('com:bio:pagetitle'),
				'content' => $content
			));
		}
	}
}

/**
 * Bio search handler
 *
 * @return mixdata;
 * @access private
 */

function com_bio_search_bios_handler($hook, $type, $return, $params)
{
	$count = 0;
	$query = input('q');
	$converted_query = htmlspecialchars(htmlentities($query));
	if (ossn_isLoggedin()) {
		$visitor = ossn_loggedin_user();
		$is_admin = ossn_isAdminLoggedin();
		if (com_is_active('OssnBlock')) {
			$blocked_check = true;
		} else {
			$blocked_check = false;
		}
	} else {
		$visitor = false;
		$is_admin = false;
		$blocked_check = false;
	}
		$bio = new Bio();
		$search_options = array(
			'query' => $converted_query,
			'count' => false,
			'visitor' => $visitor,
			'is_admin' => $is_admin,
			'blocked_check' => $blocked_check
		);
		$bios = $bio->searchBios($search_options);
		$search_options['count'] = true;
		$count = $bio->searchBios($search_options);
		if ($count && $bios) {
			$found['bios'] = $bios;
			if (!strlen($query)) {
				$found['page_header'] = ossn_print('com:bio:search:result:total', array($count));
			} else {
				$found['page_header'] = ossn_print('com:bio:search:result', array($count, $query));
			}
			$search = ossn_plugin_view('bio/pages/search_results', $found);
			$search .= ossn_view_pagination($count);
			return $search;
		}
		$found['bios'] = false;
		$found['page_header'] = ossn_print('com:bio:search:noresult', array($query));
		$search = ossn_plugin_view('bio/pages/search_results', $found);
		return $search;
}

/**
 * Add links to search page menu
 *
 * @return void;
 * @access private
 */
function com_bio_search_menu_link($event, $type, $params)
{
	$url = OssnPagination::constructUrlArgs(array(
		'type'
	));
	ossn_register_menu_link('com_bio_search_bio', 'bio', "search?type=bio{$url}", 'search');
}

function com_bio_profile_edit_section_page($hook, $type, $return, $params)
{
	if ($params['section'] == 'bio') {
		return ossn_plugin_view('account_settings/bio/bio_tab');
	}
}

ossn_register_callback('ossn', 'init', 'com_bio_init');
