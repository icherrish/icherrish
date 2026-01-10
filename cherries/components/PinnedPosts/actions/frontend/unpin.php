<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Pinned Posts
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

// 7.2dev2 new feature
// this action being called means: you (the admin) clicked 'unpin' in the pinned post menue
// the id of the post to be unpinned is provided as a parameter of the action url
// see line #120 of 'com_pinned_posts_create_wall_post_menu_unpin_entry'
//
$id = input('post_id');

$component = new OssnComponents;
$settings  = $component->getSettings("PinnedPosts");
if ($settings && isset($settings->PinnedPosts) && !empty($settings->PinnedPosts) && $id) {
	// convert comma separated list of saved pinned post ids to array
	$pinned_post_ids = explode(',', $settings->PinnedPosts);
	if (count($pinned_post_ids)) {
		// yep, this array has one or more ids
		// check if the to be deleted id is included?
		$item = array_search($id, $pinned_post_ids);
		if ($item !== false) {
			// yes, it is - so remove it from the array
			unset($pinned_post_ids[$item]);
			// convert the shrinked array back to a comma separated list
			$pinned_posts = implode(',', $pinned_post_ids);
			// prepare for saving
			$args = array(
				'PinnedPosts' => $pinned_posts
			);
			// save (and prepare message in case of error)
			if (!$component->setSettings('PinnedPosts', $args)) {
				ossn_trigger_message(ossn_print('com:pinned:posts:save:error'), 'error');
			}
			// this post_id has been removed from the list of pinned posts in the database now
		}
	}
}

// proceed and reload the home page with the updated (shrinked) list of pinned posts
redirect(REF); 