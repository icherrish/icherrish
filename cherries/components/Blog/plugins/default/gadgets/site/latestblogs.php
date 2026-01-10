<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$blog = new Blog();
$search_options = array();
if (ossn_isLoggedin() && com_is_active('OssnBlock')) {
	$loggedin      = ossn_loggedin_user();
	$blocked       = "(o.owner_guid NOT IN (SELECT DISTINCT relation_to FROM `ossn_relationships` WHERE relation_from={$loggedin->guid} AND type='userblock') AND o.owner_guid NOT IN (SELECT 	DISTINCT relation_from FROM `ossn_relationships` WHERE relation_to={$loggedin->guid} AND type='userblock'))";
	$search_options['wheres'] = $blocked;
	$blogs = $blog->getBlogsByDate($search_options);
	$search_options['count'] = true;
	$count = $blog->getBlogsByDate($search_options);
} else {
	$blogs = $blog->getBlogsByDate($search_options);
	$search_options['count'] = true;
	$count = $blog->getBlogsByDate($search_options);
}

if ($blogs) {
	foreach ($blogs as $item) {
		echo ossn_plugin_view('blog/list/all_blogs_item', array('item' => $item));
	}
}
