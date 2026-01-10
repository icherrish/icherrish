<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Pinned Posts
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

// 7.2dev3 new feature
// this action being called means: you (the admin) clicked 'pin' ina  wall post menue
// the id of the post to be pinned is provided as a parameter of the action url
// see line #162 of 'com_pinned_posts_create_wall_post_menu_pin_entry'
//
$id = input('post_id');

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
$item = array_search($id, $pinned_post_ids);
if ($item === false) {
	// no, it's not - so add the entry to the array
	// by default on top, (same ordering as on the newsfeed: latest first
	array_unshift($pinned_post_ids, $id);
	// or at the bottom if you prefer that way
	// $pinned_post_ids[] = $id;
	// convert the enlarged array back to a comma separated list
	$pinned_posts = implode(',', $pinned_post_ids);
	// prepare for saving
	$args = array(
		'PinnedPosts' => $pinned_posts
	);
	// save (and prepare message in case of error)
	if (!$component->setSettings('PinnedPosts', $args)) {
		ossn_trigger_message(ossn_print('com:pinned:posts:save:error'), 'error');
	}
	// this post_id has been added to the list of pinned posts in the database now

}

// proceed and reload the home page with the updated (enlarged) list of pinned posts
redirect(REF); 