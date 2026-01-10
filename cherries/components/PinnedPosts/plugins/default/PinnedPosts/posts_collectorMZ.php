<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Pinned Posts
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$pinned_posts = '';

if (isset($params["pinnedposts"]) && isset($params["pinnedposts"]->PinnedPosts)) {
	// separate the ids of the posts to be pinned
	$pinned_post_ids = explode(',', $params["pinnedposts"]->PinnedPosts);
	if (count($pinned_post_ids)) {
		// yep, we got one or more post ids !
		if (!isset($params["pinnedposts"]->DisplayComments) || (isset($params["pinnedposts"]->DisplayComments) && $params["pinnedposts"]->DisplayComments == '')) {
			// 'Display comments and allow commenting' in Configure->PinnedPosts is unchecked, so
			// 1. don't display comments
			ossn_unset_hook('post', 'comments', 'ossn_post_comments');
			ossn_unset_hook('post', 'comments:entity', 'ossn_post_comments_entity');
			// 2. remove the 'Like Comment View all comments etc' menu line
			ossn_add_hook('wall', 'post:menu', 'com_pinned_posts_remove_postextra_menu_links');
			ossn_register_callback('comment', 'entityextra:menu', 'com_pinned_posts_remove_entityextra_menu_links');
			// 3. remove the reactions line
			ossn_unset_hook('post', 'likes', 'ossn_post_likes');
			ossn_unset_hook('post', 'likes:entity', 'ossn_post_likes_entity');
			ossn_add_hook('post', 'likes:object', 'ossn_post_likes_object');
		}
		// 7.2dev2 new feature
		// add 'unpin' entries to the pinned post's menus
		ossn_add_hook('wall', 'post:menu', 'com_pinned_posts_create_wall_post_menu_unpin_entry');

		$wall  = new OssnWall();
		foreach ($pinned_post_ids as $pinned_post_id) {
			// loop through the ids and fetch the associated posts one by one
			$post  = $wall->GetPost($pinned_post_id);
			if (!$post) {
				// oops, that post must have been deleted in the meantime
				continue;
			}
			if ($post->type != 'user') {
				// data record exists, but is of wrong type
				continue;
			}
			if ($post->subtype == 'wall') {
				// correct record!
				// so pass it over to OssnWall's functions to retrieve the complete post's html, user image and stuff
				$params['post'] = $post;
				// 7.2.dev2 fix:
				$orig_post_duplicate = ossn_wall_view_template(ossn_wallpost_to_item($params['post']));
				// embed it in an extra div
				$pinned_post = '<div class="pinned-post">' . $orig_post_duplicate . '</div>';
				// and add this post to already processed ones
				$pinned_posts = $pinned_posts  . $pinned_post;
			}
		}
		// done!
		// finally embed the collected posts inside of a wrapper with the configured background-color
		// 7.2dev3 fix:
		// in case of a first time installation without visiting and saving settings in Configure->PinnenPosts
		// the background color is still unset!
		// so use default color cyan (= bootstrap-color 'info'!
		$background_color = 'info';
		if (isset($params["pinnedposts"]->Background)) {
			$background_color = $params["pinnedposts"]->Background;
		}
		echo '<div class="pinnedposts"> <div class="alert alert-' . $background_color . '"> <strong>'.ossn_print('com:pinned:posts:title').'</strong> '. $pinned_posts.' </div> </div>';
	}
}