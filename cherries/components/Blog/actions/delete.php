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
 
$guid = input('guid');

$blog = com_blog_get_blog($guid);
if (!$blog) {
	ossn_trigger_message(ossn_print("com:blog:blog:delete:failed"), 'error');
	redirect(REF);
}
if ((($blog->owner_guid == ossn_loggedin_user()->guid) || ossn_loggedin_user()->canModerate())) {
	ossn_trigger_callback('blog', 'deleted', $guid);
	$blog->deleteObject();
	ossn_trigger_message(ossn_print("com:blog:blog:deleted"));
	redirect('blog/member_blogs/' . $blog->owner_guid);
}
ossn_trigger_message(ossn_print("blog:delete:failed"), 'error');
redirect(REF);