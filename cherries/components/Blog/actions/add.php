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
$description = trim(htmlspecialchars(input('contents')));

$blog = new Blog;
if ($guid = $blog->addBlog($title, $description)) {
	$args['blog_guid'] = $guid;
	ossn_trigger_callback('blog', 'blog:created', $args);
	ossn_trigger_message(ossn_print("com:blog:blog:added"));
	$translit = OssnTranslit::urlize($title);
	redirect("blog/view/{$guid}");
} else {
	ossn_trigger_message(ossn_print("com:blog:blog:add:failed"), 'error');
	redirect(REF);
}