<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Pinned Posts
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

define('__PINNED_POSTS__', ossn_route()->com . 'PinnedPosts/');

ossn_register_callback('ossn', 'init', function() {
	if (ossn_isAdminLoggedin()) {
		// backend
		ossn_register_com_panel('PinnedPosts', 'settings');
		ossn_register_action('PinnedPosts/backend/settings', __PINNED_POSTS__ . 'actions/backend/settings.php');
		// frontend
		// 7.2dev2 new feature
		// register an unpin action to handle an 'unpin' click inside of a pinned post's menu
		// this way we don't need to visit admin->configure->PinnedPosts anymore
		// but can unpin a post directly in place
		ossn_register_action('PinnedPosts/frontend/unpin', __PINNED_POSTS__ . 'actions/frontend/unpin.php');
		// 7.2dev3 new feature
		// register a pin action to handle an 'pin' click inside of a wall post's menu
		// this way we don't need to visit admin->configure->PinnedPosts anymore
		// but can pin a post directly in place
		ossn_register_action('PinnedPosts/frontend/pin', __PINNED_POSTS__ . 'actions/frontend/pin.php');
		// add 'pin' entries to wall post's menus
		ossn_add_hook('wall', 'post:menu', 'com_pinned_posts_create_wall_post_menu_pin_entry');
	}
	// frontend
	ossn_extend_view('css/ossn.default', 'PinnedPosts/css');
	if (ossn_isLoggedin()) {
		ossn_add_hook('newsfeed', 'center:top', 'com_pinned_posts_pinner');
		ossn_add_hook('wall', 'getAllPosts', 'com_pinned_posts_exclude_duplicates');
		ossn_add_hook('wall', 'getPublicPosts', 'com_pinned_posts_exclude_duplicates');
		ossn_add_hook('wall', 'getFriendsPosts', 'com_pinned_posts_exclude_duplicates');
	}
	// 7.2dev4 temporary workaround
	// remove friends-online widget from the middle column if the display width is larger than 991 pixel
	// because the widget is shown on the right sidebar in this case
	ossn_extend_view('js/ossn.site', 'PinnedPosts/friendsonline-fix');
	// 7.3dev3
	// prevent disabling of OssnWall as long as Pinned Post are enabled
	ossn_add_hook('required', 'components', 'com_pinned_posts_asure_requirements');

});

// 7.2dev1
function com_pinned_posts_pinner($hook, $tye, $return, $params) {
	// see themes/goblue/plugins/default/theme/page/layout/newsfeed.php
	// where this hook gets called
	// but since the newsfeed layout is used on the 'Invite Friends' page, too
	// and we want no pinned posts there
	// make sure we're actually on 'home'
	if (ossn_get_context() == 'home') {
		$component = new OssnComponents;
		$settings  = $component->getSettings("PinnedPosts");
		if ($settings && isset($settings->PinnedPosts) && !empty($settings->PinnedPosts)) {
			// yes, we got one or more posts to pin ...
			// so take care of other candidates that may need to be inserted here, too
			// to achieve a meaningful ordering
			if (com_is_active('Greetings')) {
				// greetings go first !
				// trash the original script
				ossn_unextend_view('ossn/site/head','greetings/js');
				// and use this hook instead
				$return[] = ossn_plugin_view('greetings/greetings');
			}

			if (com_is_active('Announcement')) {
				// same procedure for announcements
				ossn_unextend_view('ossn/js/head', 'announcement');
				ossn_unextend_view('ossn/site/head', 'announcement/js');
				$announcement_settings  = $component->getSettings("Announcement");
				if (isset($announcement_settings->announcement) && !empty($announcement_settings->announcement)) {
					// but this time we need to replace the original plugin
					// because of the unwanted javascript inserting part inside
					$return[] = ossn_plugin_view('PinnedPosts/announcement_handler', array(
						'announcement' => $announcement_settings
					));
				}
			}

			// finally return the posts to be pinned
			// 7.3dev1 new feature: un-/collapse pinned posts option
			if (isset($settings->CollapsePosts) && !empty($settings->CollapsePosts)) {
				// use collector enhanced by Dominik Lieger
				$posts_collector_plugin = 'PinnedPosts/posts_collectorDL';
			} else {
				// use default collector (no collapsing)
				$posts_collector_plugin = 'PinnedPosts/posts_collectorMZ';
			}
			$return[] = ossn_plugin_view($posts_collector_plugin, array(
				'pinnedposts' => $settings
			));
		}
	}
	return $return;
}

function com_pinned_posts_remove_postextra_menu_links($hook, $type, $return, $params) {
	global $Ossn;
	if (isset($Ossn->menu['postextra'])) {
		foreach ($Ossn->menu['postextra'] as $key => $value) {
			ossn_unregister_menu($key, 'postextra');
		}
	}
}

function com_pinned_posts_remove_entityextra_menu_links($callback, $type, $params) {
	global $Ossn;
	if (isset($Ossn->menu['entityextra'])) {
		foreach ($Ossn->menu['entityextra'] as $key => $value) {
			ossn_unregister_menu($key, 'entityextra');
		}
	}
}

function com_pinned_posts_exclude_duplicates($hook, $type, $return, $params) {
	$component = new OssnComponents;
	$settings  = $component->getSettings("PinnedPosts");
	if ($settings && isset($settings->PinnedPosts) && !empty($settings->PinnedPosts)) {
		// don't display the same post(s) twice as long as they are pinned on top
		// so pass the pinned post ids to be merged with OssnWall's database queries in order to exclude them

		// 7.3dev2 bug fix
		// don't overwrite already existing 'wheres' which may have been passed by other components
		if (isset($return['wheres'])) {
			// there are already existing 'wheres', so add this new clause to the other ones in the arrey
			$return['wheres'][] = "o.guid NOT IN ({$settings->PinnedPosts})";
		} else {
			// still no 'wheres' array yet, so create a new one
			$return['wheres'] = "o.guid NOT IN ({$settings->PinnedPosts})";
		}
		return $return;
	}
}

// 7.2dev2 new feature
// add 'unpin' entries to the pinned post's menus
// see line #33 of post_collector.php
function com_pinned_posts_create_wall_post_menu_unpin_entry($hook, $type, $return, $params) {
	// prevent deleting original posts from inside of the pinned post panel
	// posts need to be unpinned now before they can be deleted completely
	ossn_unregister_menu('delete', 'wallpost');
	if (ossn_isAdminLoggedin()) {
		// only admins may unpin posts!
		// remove former entries of same name before creating the right one
		ossn_unregister_menu('unpin', 'wallpost');
		// create 'unpin' menu entry
		$unpinurl = ossn_site_url("action/PinnedPosts/frontend/unpin?post_id={$params['post']->guid}", true);
		ossn_register_menu_item('wallpost', array(
			'name'      => 'unpin',
			'class'     => 'ossn-wall-post-unpin ossn-make-sure',
			'text'      => '<div class="pinnedpost-unpin-icon-fake fa-solid fa-thumbtack"></div>' . ossn_print('com:pinned:posts:menu:entry:unpin'),
			'href'      => $unpinurl,
			'data-guid' => $params['post']->guid,
		));
	}
	return ossn_view_menu('wallpost', 'wall/menus/post-controls');
}

// 7.2dev3 new feature
// add 'pin' entries to wall post's menus
function com_pinned_posts_create_wall_post_menu_pin_entry($hook, $type, $return, $params) {
	// make sure we're actually on 'home'
	if (ossn_get_context() == 'home') {
		// we're going to do some array processing below
		// so create an empty one in case there are no pinned posts yet
		$pinned_post_ids = array();
		$component = new OssnComponents;
		$settings  = $component->getSettings("PinnedPosts");
		if (isset($settings->PinnedPosts) && !empty($settings->PinnedPosts)) {
			$pinned_posts = $settings->PinnedPosts;
			// convert comma separated list of saved pinned post ids to array
			$pinned_post_ids = explode(',', $pinned_posts);
		}
		// check if the new id to be pinned is not already included in the list of pinned ids?
		$item = array_search($params['post']->guid, $pinned_post_ids);
		// remove former entries of same name before creating the right one
		ossn_unregister_menu('pin', 'wallpost');
		if ($item === false) {
			// no, it's not - so add the entry
			// create 'pin' menu entry
			$pinurl = ossn_site_url("action/PinnedPosts/frontend/pin?post_id={$params['post']->guid}", true);
			ossn_register_menu_item('wallpost', array(
				'name'      => 'pin',
				'class'     => 'ossn-wall-post-pin ossn-make-sure',
				'text'      => ossn_print('com:pinned:posts:menu:entry:pin'),
				'href'      => $pinurl,
				'data-guid' => $params['post']->guid,
			));
		}
		return ossn_view_menu('wallpost', 'wall/menus/post-controls');
	}
}

// 7.3dev3
function com_pinned_posts_asure_requirements($hook, $type, $return, $params) {
	$return[] = 'OssnWall';
	return $return;
}

