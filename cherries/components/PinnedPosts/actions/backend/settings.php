<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Pinned Posts
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
$component = new OssnComponents;
$pinnedposts = input('pinnedposts');
if (!$pinnedposts) {
	$pinnedposts = false;	 
}

$background  = input('background');
if (!$background) {
	// use bootstrap color 'info' (= cyan) by default
	$background = 'info';	 
}

// 7.2dev1 new feature: display/hide comments
$displaycomments  = input('displaycomments');
if (!$displaycomments) {
	$displaycomments = '';	 
}

// 7.3dev1 new feature: un-/collapse pinned posts
$collapseposts  = input('collapseposts');
if (!$collapseposts) {
	$collapseposts = '';	 
}

$args = array(
	'PinnedPosts' => $pinnedposts,
	'DisplayComments' => $displaycomments,
	'CollapsePosts' => $collapseposts,
	'Background'  => $background,
);

if ($component->setSettings('PinnedPosts', $args)) {
	ossn_trigger_message(ossn_print('ossn:admin:settings:saved'));
	redirect(REF);
} else {
	ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
	redirect(REF);	 
}