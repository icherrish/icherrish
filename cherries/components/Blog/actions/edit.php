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
 
$title = input('title');
$description = input('contents');
$guid = input('guid');

$blog = com_blog_get_blog($guid);
if (!$blog) {
	ossn_trigger_message(ossn_print("com:blog:blog:edit:failed"), 'error');
	redirect(REF);
}
$blog->title = $title;
$blog->description = trim(htmlspecialchars($description));

if ((($blog->owner_guid == ossn_loggedin_user()->guid) || ossn_loggedin_user()->canModerate()) && $blog->save()) {
	$params['object_guid'] = $blog->guid;
	$params['poster_guid'] = $blog->owner_guid;
	ossn_trigger_callback('blog', 'edited', $params);
	ossn_trigger_message(ossn_print("com:blog:blog:edited"));
} else {
	ossn_trigger_message(ossn_print("com:blog:blog:edit:failed"), 'error');
}
redirect("blog/view/{$blog->guid}");