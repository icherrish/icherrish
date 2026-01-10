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

ossn_register_languages('ro', array(
	'blog' => 'Blog',
	'blogs' => 'Blogs',
	'com:blog:blog:share:button' => 'Share',
	'com:blog:blog:share:link:copied' => "The blog's link was copied to your clipboard",
	'com:blog:blog:add' => 'Add Blog',
	'com:blog:blog:add:failed' => 'Can not create blog.',
	'com:blog:blog:added' => 'Blog has been successfully created.',
	
	'com:blog:blog:contents' => 'Blog contents',
	'com:blog:blog:title' => 'Blog Title',
	'com:blog:blog:title:warning' => 'mandatory field - enter a meaningful title, please',
	'com:blog:blog:edit' => 'Edit Blog',
	'com:blog:blog:edit:timestamp' => 'last edited: %s',
	'com:blog:blog:edit:timestamp:format' => 'm-d-Y H:i', // this format will give a stamp like '03-31-2019 16:45', see http://php.net/manual/en/function.date.php for the all available formatting placeholders
	
	'com:blog:blog:edit:failed' => 'Can not edit blog',
	'com:blog:blog:edited' => 'Blog has been successfully edited',
	
	'com:blog:dialog:confirm:delete' => 'Are you sure you want to delete this blog?',
	'com:blog:blog:deleted' => 'Blog has been deleted',
	'com:blog:blog:delete:failed' => 'Can not delete blog',

	'com:blog:blog:my' => 'My Blogs',
	'com:blog:blog:all' => 'All Blogs',
	
	'com:blog:list:sort:by:date' => 'sort by date',
	'com:blog:list:sort:by:date:page:header' => 'All blogs - sorted by date',

	'com:blog:list:sort:by:member' => 'sort by member',
	'com:blog:list:sort:by:member:page:header' => 'All blogs - sorted by member',
	
	'com:blog:list:member:page:header' => 'Blogs by %s',
	'com:blog:list:by:author:' => 'by %s',
	
	'com:blog:wall:post:subject' => 'created a new blog', 
	'com:blog:wall:post:view:complete' => 'view complete blog',
	
	'com:blog:search:result' => "found %s blogs containing '%s'",
	'com:blog:search:result:total' => 'found total number of %s blogs',
	'com:blog:search:noresult' => "no blogs found containing '%s'",
	
	'ossn:notifications:like:entity:blog' => '%s liked the blog <b>%s</b>',
	'ossn:notifications:comments:entity:blog' => '%s commented on the blog <b>%s</b>',

	'ossngadget:site:latestblogs' => 'Latest Blogs',
));
 