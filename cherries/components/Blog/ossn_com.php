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

define('BLOG', ossn_route()->com . 'Blog/');
define('BLOG_PREVIEW_LENGTH', 300);
require_once(BLOG . 'classes/Blog.php');

/**
 * Blog Init
 *
 * @return void
 */
function com_blog_init()
{
	ossn_extend_view('css/ossn.default', 'css/blog');
	ossn_extend_view('js/ossn.site', 'js/blog');

	ossn_register_page('blog', 'com_blog_page_handler');

	ossn_add_hook('required', 'components', 'com_blog_asure_requirements');

	if (ossn_isLoggedin()) {
		ossn_register_action('blog/add', BLOG . 'actions/add.php');
		ossn_register_action('blog/edit', BLOG . 'actions/edit.php');
		ossn_register_action('blog/delete', BLOG . 'actions/delete.php');

		ossn_register_callback('user', 'delete', 'com_blog_user_blog_delete');
		ossn_register_callback('blog', 'deleted', 'com_blog_delete_entities');
		ossn_profile_subpage('blogs');
		ossn_register_callback('page', 'load:profile', 'com_blog_profile_blog_menu');
		ossn_add_hook('profile', 'subpage', 'com_blog_profile_blog_page');
		ossn_register_callback('comment', 'entityextra:menu', 'com_blog_allcomments');
		
		ossn_register_callback('blog', 'blog:created', 'com_blog_add_to_wall');
		ossn_add_hook('wall:template', 'blog:created', 'com_blog_display_wall_entry');
		
		ossn_add_hook('notification:view', 'like:entity:blog', 'com_blog_notifications');
		ossn_add_hook('notification:view', 'comments:entity:blog', 'com_blog_notifications');
		ossn_add_hook('notification:view', 'like:annotation', 'com_blog_notifications');

		ossn_register_callback('page', 'load:search', 'com_blog_search_menu_link');
		ossn_add_hook('search', 'type:blogs', 'com_blog_search_blogs_handler');

		ossn_register_callback('like', 'deleted', 'com_blog_delete_like_notification');
		ossn_register_callback('comment', 'delete', 'com_blog_delete_comment_notification');

		ossn_register_sections_menu('newsfeed', array(
			'name' => 'addblog',
			'text' => ossn_print('com:blog:blog:add'),
			'url' => ossn_site_url('blog/add'),
			'section' => 'blogs',
		));
		ossn_register_sections_menu('newsfeed', array(
			'name' => 'myblogs',
			'text' => ossn_print('com:blog:blog:my'),
			'url' => ossn_site_url('blog/member_blogs/' . ossn_loggedin_user()->guid),
			'section' => 'blogs',
		));
		ossn_register_sections_menu('newsfeed', array(
			'name' => 'allblogs',
			'text' => ossn_print('com:blog:blog:all'),
			'url' => ossn_site_url('blog/all_blogs_by_date'),
			'section' => 'blogs',
		));
		if (com_is_active('Gadgets')) {
			ossn_register_gadget('site/latestblogs', 'gadgets/site/latestblogs');
		} 
		// added support for Premium SharePost component
		// show "Share' link on blog page if accompanying blog wall post is available
		if (com_is_active('OssnComments') && com_is_active('SharePost')) {
			ossn_register_callback('comment', 'entityextra:menu', 'com_blog_add_entity_shareblogpost');
		}
		// prevent deleting of blog wall post, because otherwise there's no more object to share
		ossn_add_hook('wall', 'post:menu', 'com_blog_remove_blog_wall_post_menu_delete_entry');
	}
}

function com_blog_remove_blog_wall_post_menu_delete_entry($hook, $type, $return, $params)
{
	if ($params['post']->item_type == 'blog:created') {
		ossn_unregister_menu('delete', 'wallpost');
		return ossn_view_menu('wallpost', 'wall/menus/post-controls');
	}
}

function com_blog_add_entity_shareblogpost($callback, $type, $params)
{
	// add Premium SharePost link on blog page
	// if accompanying announcement post on newsfeed still exists
	if ($params['entity']->subtype == 'blog' && $params['entity']->permission == OSSN_PUBLIC) {
		$object = new OssnObject;
		$searchparms = array(
			'type'       => 'user',
			'subtype'    => 'wall',
		);
		$searchparms['entities_pairs'][] = array(
			'name'   => 'item_guid',
			'value'  => $params['entity']->owner_guid,
		);
		$blog_wallpost = $object->searchObject($searchparms);
		if ($blog_wallpost && $blog_wallpost[0]->item_type == 'blog:created') {
			ossn_unregister_menu('shareblogpost', 'entityextra');
			ossn_register_menu_item('entityextra', array(
				'name'      => 'shareblogpost',
				'class'     => 'share-object-select',
				'data-type' => 'object',
				'data-guid' => $blog_wallpost[0]->guid,
				'href'      => 'javascript:void(0);',
				'text'      => ossn_print('post:share'),
			));
		}
	}
}

function com_blog_asure_requirements($hook, $type, $return, $params)
{
	$return[] = 'OssnProfile';
	$return[] = 'TextareaSupport';
	return $return;
}

/**
 * Add blog to wall
 *
 * @param string $callback Name of callback
 * @param string $type Callback type
 * @param array  $params array|object
 *
 * @return void
 * @access private
 */
function com_blog_add_to_wall($callback, $type, $params) {
	if (isset($params['blog_guid'])) {
		$wall = new Blog();
		$wall->addWall($params['blog_guid']);
	}
}

/**
 * Template for wall display
 *
 * @return string
 */
function com_blog_display_wall_entry($hook, $type, $return, $params)
{
	return ossn_plugin_view("blog/wall/template", $params);
}

/** 
 * Get blog object
 * 
 * @param integer $guid A blog guid
 * 
 * @return object|boolean
 */
function com_blog_get_blog($guid)
{
	if ($object = ossn_get_object($guid)) {
		$type = (array) $object;
		if ($object->subtype == 'blog') {
			return arrayObject($type, 'Blog');
		}
	}
	return false;
}

function com_blog_get_blog_entity($guid)
{
	$entity = new OssnEntities;
	$entity->type    = 'object';
	$entity->subtype = 'blog';
	$entity->owner_guid = $guid;
	if ($blog_entity = $entity->get_entities()) {
		return $blog_entity[0];
	}
	// add entities - make backward compatible
	// since former blogs had no entities
	// common stuff goes first
	$entity->owner_guid		= $guid;
	$entity->type			= 'object';
	$entity->time_created	= time();
	$entity->time_updated	= 0;
	$entity->permission		= OSSN_PUBLIC;
	$entity->active			= 1;
	// blog access (will be implemented later)
	$entity->subtype		= 'access';
	$entity->value			= OSSN_PUBLIC;
	$entity->add();
	// do we really need that one?
	$entity->subtype		= 'poster_guid';
	$entity->value			= ossn_loggedin_user()->guid;
	$entity->add();
	// main anchor point
	$entity->subtype		= 'blog';
	$entity->value			= $guid;
	$entity->add();
	//
	if ($blog_entity = $entity->get_entities()) {
		return $blog_entity[0];
	}
	return false;
}

/** 
 * Blog pages
 * 
 * @param array $pages A pages
 * 
 * @return mixdata
 */
function com_blog_page_handler($pages)
{
	$page = $pages[0];
	switch ($page) {
		case 'add':
			if (ossn_isLoggedin()) {
				$title               = ossn_print('com:blog:blog:add');
				$contents['content'] = ossn_plugin_view('blog/pages/add');
				$content             = ossn_set_page_layout('contents', $contents);
				echo ossn_view_page($title, $content);
			} else {
				ossn_error_page();
			}
			break;
		case 'view':
			$blog		 = com_blog_get_blog($pages[1]);
			if (!$blog) {
				ossn_error_page();
			}
			$blog_entity = com_blog_get_blog_entity($pages[1]);

			$contents['content'] = ossn_plugin_view('blog/pages/view', array(
				'blog' 		  => $blog,
				'blog_entity' => $blog_entity,
				'full_view' => (isset($pages[2])) ? true : false
			));
			$content = ossn_set_page_layout('contents', $contents);
			echo ossn_view_page($blog->title, $content);
			break;
		case 'edit':
			if (ossn_isLoggedin()) {
				$blog = com_blog_get_blog($pages[1]);
				if (!$blog) {
					ossn_error_page();
				}
				if (($blog->owner_guid == ossn_loggedin_user()->guid) || ossn_loggedin_user()->canModerate()) {
					$title               = ossn_print('com:blog:blog:edit');
					$contents['content'] = ossn_plugin_view('blog/pages/edit', array(
						'blog' => $blog
					));
					$content             = ossn_set_page_layout('contents', $contents);
					echo ossn_view_page($title, $content);
				} else {
					ossn_error_page();
				}
			} else {
				ossn_error_page();
			}
			break;
		case 'all_blogs_by_date':
			$blog = new Blog;
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
			$title               = ossn_print('com:blog:blog:all');
			$contents['content'] = ossn_plugin_view('blog/pages/all_blogs_by_date', array(
				'blogs' => $blogs,
				'count' => $count,
				'page_header' => ossn_print('com:blog:list:sort:by:date:page:header')
			));
			$content             = ossn_set_page_layout('contents', $contents);
			echo ossn_view_page($title, $content);
			break;
		case 'all_blogs_by_member':
			$blog = new Blog;
			$search_options = array();
			if (ossn_isLoggedin() && com_is_active('OssnBlock')) {
				$loggedin      = ossn_loggedin_user();
				$blocked       = "(o.owner_guid NOT IN (SELECT DISTINCT relation_to FROM `ossn_relationships` WHERE relation_from={$loggedin->guid} AND type='userblock') AND o.owner_guid NOT IN (SELECT 	DISTINCT relation_from FROM `ossn_relationships` WHERE relation_to={$loggedin->guid} AND type='userblock'))";
				$search_options['wheres'] = $blocked;
				$blogs = $blog->getBlogsByMember($search_options);
				$search_options['count'] = true;
				$count = $blog->getBlogsByMember($search_options);
			} else {
				$blogs = $blog->getBlogsByMember($search_options);
				$search_options['count'] = true;
				$count = $blog->getBlogsByMember($search_options);
			}
			$title               = ossn_print('com:blog:blog:all');
			$contents['content'] = ossn_plugin_view('blog/pages/all_blogs_by_member', array(
				'blogs' => $blogs,
				'count' => $count,
				'page_header' => ossn_print('com:blog:list:sort:by:member:page:header') 
			));
			$content             = ossn_set_page_layout('contents', $contents);
			echo ossn_view_page($title, $content);
			break;
		case 'member_blogs':
			$user  = ossn_user_by_guid($pages[1]);
			if (!$user) {
				ossn_error_page();
			}
			$blog = new Blog;
			$blogs = $blog->getUserBlogs($user);
			$count = $blog->getUserBlogs($user, array(
				'count' => true
			));
			$title               = ossn_print('com:blog:blog:my');
			$contents['content'] = ossn_plugin_view('blog/pages/member_blogs', array(
				'blogs' => $blogs,
				'count' => $count,
				'page_header' => ossn_print('com:blog:list:member:page:header', array($user->fullname)),
			));
			$content             = ossn_set_page_layout('contents', $contents);
			echo ossn_view_page($title, $content);
			break;
	}
}
/**
 * Delete user blogs
 *
 * @param string $callback A name of callback
 * @param string $type A event type
 * @param array  $params A option values
 *
 * @return void
 */
function com_blog_user_blog_delete($callback, $type, $params)
{
	if (!empty($params['entity']->guid)) {
		$blogs = new Blog;
		$list  = $blogs->getUserBlogs($params['entity']->guid, array(
			'page_limit' => false
		));
		if ($list) {
			foreach ($list as $item) {
				ossn_trigger_callback('blog', 'deleted', $item->guid);
				$item->deleteObject();
			}
		}
	}
}

function com_blog_delete_entities($callback, $type, $params)
{
	$entity = new OssnEntities;
	// delete likes, comments and notifications belonging to blog
	$blog_entity = $entity->searchEntities(array(
		'type'    => 'object',
		'subtype' => 'blog',
		'value'   => $params
	));
	if ($blog_entity) {
		$blog_entity_guid = $blog_entity[0]->guid;
		// delete blog likes
		if (class_exists('OssnLikes')) {
			$likes = new OssnLikes;
			$likes->deleteLikes($blog_entity_guid, 'entity');
		}
		if (class_exists('OssnComments')) {
			$comments = new OssnComments;
			$comments->commentsDeleteAll($blog_entity_guid, 'comments:entity');
		}
		if (class_exists('OssnNotifications')) {
			$notification = new OssnNotifications;
			$notification->deleteNotification(array(
				'subject_guid' => $blog_entity_guid,
				'type' => array(
					'comments:entity:blog',
					'like:entity:blog',
					'like:annotation'
				)
			));
		}
	}
	// delete wall post belonging to blog
	// so find entity with item_guid == our blog guid
	$blog_wall_entity = $entity->searchEntities(array(
		'type'    => 'object',
		'subtype' => 'item_guid',
		'value'   => $params
	));
	// since the blog owner or admin may have deleted the wall post manually in advance
	// it's no error if we receive a false here, so checking makes sense
	if ($blog_wall_entity) {
		$wall_post_guid = $blog_wall_entity[0]->owner_guid;
		$wall_object = new OssnObject;
		$wall_object->deleteObject($wall_post_guid);
	}
}

/**
 * Blog profile menu
 *
 * @param string $event A name of callback
 * @param string $type A event type
 * @param array  $params A option values
 *
 * @return void
 */
function com_blog_profile_blog_menu($event, $type, $params)
{
	$owner = ossn_user_by_guid(ossn_get_page_owner_guid());
	if ($owner) {
		ossn_register_menu_link('blogs', 'blogs', $owner->profileURL('/blogs'), 'user_timeline');
	}
}

/**
 * Add a pagehandler for the 'blogs' sub page of profile
 *
 * @return string
 */
function com_blog_profile_blog_page($hook, $type, $return, $params)
{
	if ($params['subpage'] == 'blogs') {
		$blog = new Blog;
		$blogs = $blog->getUserBlogs($params['user']);
		$count = $blog->getUserBlogs($params['user'], array(
			'count' => true
		));
		$title               = ossn_print('com:blog:blog:my');
		$content = ossn_plugin_view('profile/blogs', array(
			'blogs' => $blogs,
			'count' => $count,
		));
		echo ossn_set_page_layout('module', array(
			'title' => ossn_print('blogs'),
			'content' => $content
		));
	}
}

/**
 * Set template for blog likes and comments for OssnNotifications
 *
 * @return html;
 * @access private;
 */
function com_blog_notifications($hook, $type, $return, $params)
{
	$blog_entity_guid = $params->subject_guid;
	$entity = new OssnEntities;
	$entity->entity_guid = $blog_entity_guid;
	if ($blog_entity = $entity->get_entity()) {
		$blog_guid = $blog_entity->owner_guid;
	} else {
		return;
	}
	if ($blog_entity->subtype != 'blog') {
		return;
	}
	$blog_object  = com_blog_get_blog($blog_entity->owner_guid);
	$notif        = $params;
	$user         = ossn_user_by_guid($notif->poster_guid);
	if (preg_match('/like/i', $notif->type)) {
		$type = 'like';
	}
	if (preg_match('/comments/i', $notif->type)) {
		$type = 'comment';
	}
	$url          = ossn_site_url("blog/view/{$blog_guid}");

	return ossn_plugin_view('notifications/template/view', array(
		'iconURL'     => $user->iconURL()->small,
		'guid'        => $notif->guid,
		'type'        => $notif->type,
		'viewed'      => $notif->viewed,
		'icon_type'   => $type,
		'instance'    => $notif,
		'fullname'    => $user->fullname,
		'customprint' => ossn_print("ossn:notifications:{$notif->type}", array('<strong>'.$user->fullname.'</strong>', $blog_object->title)),
		'url'	      => $url
	));

}

function com_blog_delete_like_notification($callback, $type, $params)
{
	if (class_exists('OssnNotifications')) {
		$notification = new OssnNotifications;
		$notification->deleteNotification(array(
			'subject_guid' => $params['subject_id'],
			'type' => array(
				'like:entity:blog'
			)
		));
	}
}

function com_blog_delete_comment_notification($callback, $type, $params)
{
	if (class_exists('OssnNotifications')) {
		$notification = new OssnNotifications;
		$notification->deleteNotification(array(
			'item_guid' => $params['comment'],
			'type' => array(
				'comments:entity:blog'
			)
		));
	}
}

/**
 * Blog search handler
 *
 * @return mixdata;
 * @access private
 */

function com_blog_search_blogs_handler($hook, $type, $return, $params)
{
	$count = 0;
	$query = input('q');
	$converted_query = htmlspecialchars(htmlspecialchars(htmlentities($query)));
	$search_options = array('distinct' => true);
	$blog = new Blog;

	if (ossn_isLoggedin() && com_is_active('OssnBlock')) {
		$loggedin      = ossn_loggedin_user();
		$blocked       = "(description REGEXP '{$converted_query}[^=|^;|^\:]' OR title LIKE '%{$query}%') AND (o.owner_guid NOT IN (SELECT DISTINCT relation_to FROM `ossn_relationships` WHERE relation_from={$loggedin->guid} AND type='userblock') AND o.owner_guid NOT IN (SELECT 	DISTINCT relation_from FROM `ossn_relationships` WHERE relation_to={$loggedin->guid} AND type='userblock'))";
		$search_options['wheres'] = $blocked;
		$blogs = $blog->getBlogsByDate($search_options);
		$search_options['count'] = true;
		$count = $blog->getBlogsByDate($search_options);
	} else {
		$search_options['wheres'] = "(description REGEXP '{$converted_query}[^=|^;|^\:]' OR title LIKE '%{$query}%') ";
		$blogs = $blog->getBlogsByDate($search_options);
		$search_options['count'] = true;
		$count = $blog->getBlogsByDate($search_options);
	}

	if ($count) {
		$found['blogs'] = $blogs;
		if (!strlen($query)) {
			$found['page_header'] = ossn_print('com:blog:search:result:total', array($count));
		} else {
			$found['page_header'] = ossn_print('com:blog:search:result', array($count, $query));
		}
		$search = ossn_plugin_view('blog/pages/search_results', $found);
		$search .= ossn_view_pagination($count);
		return $search;
	}
	$found['blogs'] = false;
	$found['page_header'] = ossn_print('com:blog:search:noresult', array($query));
	$search = ossn_plugin_view('blog/pages/search_results', $found);
	return $search;
}

/**
 * Add links to search page menu
 *
 * @return void;
 * @access private
 */
function com_blog_search_menu_link($event, $type, $params)
{
	$url = OssnPagination::constructUrlArgs(array(
		'type'
	));
	ossn_register_menu_link('com_blog_search_blogs', 'blogs', "search?type=blogs{$url}", 'search');
}

function com_blog_allcomments($callback, $type, $params) 
{
	if (class_exists('OssnComments') && $params['entity']->subtype == 'blog') {
		ossn_unregister_menu('commentall', 'entityextra');
		$url = ossn_site_url("blog/view/{$params['entity']->owner_guid}/all_comments");

		$comment = new OssnComments;
		if ($comment->countComments($params['entity']->guid, 'entity') > 5 && !$params['full_view']) {
			ossn_register_menu_item('entityextra', array(
				'name' => 'commentall',
				'href' => $url,
				'text' => ossn_print('comment:view:all')
			));
		}
	}
}

ossn_register_callback('ossn', 'init', 'com_blog_init');