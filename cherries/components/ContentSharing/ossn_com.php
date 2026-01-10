<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Content Sharing
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

define('__CONTENT_SHARING__', ossn_route()->com . 'ContentSharing/');

function com_content_sharing_init()
{
	ossn_extend_view('css/ossn.default', 'css/ContentSharing');
	ossn_extend_view('js/ossn.site.public', 'js/ShareablePageJS');
	ossn_extend_view('js/ossn.site', 'js/ContentSharing');
	ossn_extend_view('js/ossn.site', 'js/vendors/html2canvas.min.js');
	ossn_add_hook('private:network', 'allowed:pages', 'com_content_sharing_extend_private_network');
	ossn_register_page('shared_content', 'com_content_sharing_page_handler');
	ossn_register_callback('login', 'success', 'com_content_sharing_login_redirect');

	if (ossn_isLoggedin()){
		if (com_is_active('OssnWall')) {
			ossn_add_hook('wall', 'post:menu', 'com_content_sharing_add_post_share_link');
		}
		if (com_is_active('OssnComments')) {
			ossn_register_callback('comment', 'entityextra:menu', 'com_content_sharing_add_entity_share_link');
		}
		ossn_register_action('ContentSharing/html2png', __CONTENT_SHARING__ . 'actions/ContentSharing/html2png.php');
	}
}

function com_content_sharing_login_redirect($callback, $type, $params)
{
	if (isset($_COOKIE['ossn_joined_redirection_guid'])) {
		if ($_COOKIE['ossn_joined_redirection_guid'] == false) {
			$visited_url = $_COOKIE['ossn_joined_redirection_url'];
			setcookie('ossn_joined_redirection_guid', '', time() - 3600, "/");
			setcookie('ossn_joined_redirection_url', '', time() - 3600, "/");
			redirect($visited_url);
			exit;
		} else {
			setcookie('ossn_joined_redirection_guid', '', time() - 3600, "/");
			setcookie('ossn_joined_redirection_url', '', time() - 3600, "/");
		}	
	}
}

function com_content_sharing_page_handler($pages)
{
	$page = $pages[0];
	if (empty($page)) {
		return false;
	}
	if (empty($pages[2])) {
		ossn_error_page();
	}

	switch($page) {
		case 'request':
				if ($pages[1] == 'join') {
					$caller_id = 0;
					if (ossn_isLoggedin()){
						$caller_id = ossn_loggedin_user()->guid;
					}
					setcookie('ossn_joined_redirection_guid', $caller_id, time() + (60 * 60 * 24), "/");  // 1 day
					setcookie('ossn_joined_redirection_url', input('redirection_url'), time() + (60 * 60 * 24), "/");  // 1 day
					exit;
				}
		break;
		case 'msg':
				$msg  = "<div class='ossn-ajax-error'>" . ossn_print(input('msg')) . " " . ossn_print(input('err')) . "</div>";
				$params = array(
					'title' => ossn_print('com_content_sharing:messagebox:title'),
					'contents' => $msg,
					'button' => ossn_print('com_content_sharing:messagebox:button:ok'),
					'cancel' => false,
					'callback' => 'contentSharingUnhideHiddenNodes()'
				);
				echo ossn_plugin_view('ContentSharing/messagebox', $params);
		break;
		
		case 'css':
				$file = ossn_route()->com . 'ContentSharing/plugins/default/css/shared_content.css';
				header('Content-Type:text/css');
				header('Content-Length: ' . filesize($file));
				echo file_get_contents($file);
		break;
		
		case 'preview':
				if ($pages[1] == 'image') {
					$file = ossn_get_userdata('components/ContentSharing/previews/' . $pages[2]);
					header('Content-Type:image/png');
					header('Content-Length: ' . filesize($file));
					echo file_get_contents($file);
				}					
		break;
		
		case 'post':
				$wall  = new OssnWall;
				$post  = $wall->GetPost($pages[1]);
				if ($post && $post->time_created == $pages[2]) {
					$params['post'] = $post;
					$contents = array(
						'content' => ossn_plugin_view('wall/pages/view', $params)
					);
					$content  = ossn_set_page_layout('contents', $contents);
					$params['contents'] = $content;
					$params['title'] = ossn_print('post');
					$params['og_title'] = ossn_print('post');
					$params['og_description'] = ossn_print('com_content_sharing:creator', array(com_content_sharing_creator($post->poster_guid)));
					$params['og_image'] = ossn_site_url() . 'shared_content/preview/image/_shared_content_post_' . $pages[1] . '_' . $pages[2] . '.png?t=' . time();
					$params['og_url'] = current_url(true);
					$params['visited_url'] = 'post/view/' . $pages[1];
					echo ossn_plugin_view('ContentSharing/ShareablePage', $params);
				} else {
					ossn_error_page();
				}
		break;

		case 'blog':
				if (com_is_active('Blog')) {
					$blog = com_blog_get_blog($pages[1]);
					$blog_entity = com_blog_get_blog_entity($pages[1]);
					if($blog && $blog_entity && $blog_entity->time_created == $pages[2]) {
						$contents = array(
							'content' => ossn_plugin_view('blog/pages/view', array(
								'blog' 		  => $blog,
								'blog_entity' => $blog_entity,
								'full_view'   => 'all_comments'
								)
							)
						);
						$content = ossn_set_page_layout('contents', $contents);
						$params['contents'] = $content;
						$params['title'] = ossn_print('blog');
						$params['og_title'] = $blog->title;
						$params['og_description'] = ossn_print('com_content_sharing:creator', array(com_content_sharing_creator($blog->owner_guid)));
						$params['og_image'] = ossn_site_url() . 'shared_content/preview/image/_shared_content_blog_' . $pages[1] . '_' . $pages[2] . '.png?t=' . time();
						$params['og_url'] = current_url(true);
						$params['visited_url'] = 'blog/view/' . $pages[1];
						echo ossn_plugin_view('ContentSharing/ShareablePage', $params);
					} else {
						ossn_error_page();
					}
				} else {
					ossn_error_page();
				}
		break;

		case 'poll':
				if(com_is_active('Polls')) {
					$poll = ossn_poll_get($pages[1]);
					if ($poll && $poll->time_created == $pages[2]) {
						$contents['content'] = ossn_plugin_view('polls/pages/view', array(
							'poll' => $poll
						));
						$content = ossn_set_page_layout('contents', $contents);
						$params['contents'] = $content;
						$params['title'] = ossn_print('polls:poll');
						$params['og_title'] = $poll->title;
						$params['og_description'] = ossn_print('com_content_sharing:creator', array(com_content_sharing_creator($poll->owner_guid)));
						$params['og_image'] = ossn_site_url() . 'shared_content/preview/image/_shared_content_poll_' . $pages[1] . '_' . $pages[2] . '.png?t=' . time();
						$params['og_url'] = current_url(true);
						$params['visited_url'] = 'polls/view/' . $pages[1];
						echo ossn_plugin_view('ContentSharing/ShareablePage', $params);
					} else {
						ossn_error_page();
					}
				} else {
					ossn_error_page();
				}
		break;

		case 'photo':
				if (com_is_active('OssnPhotos')) {
					$view = new OssnPhotos;
					$image = $view->GetPhoto($pages[1]);
					if ($image && $image->time_created == $pages[2]) {
						$albumget = ossn_albums();
						$owner = $albumget->GetAlbum($image->owner_guid)->album;
						$contents = array(
							'content' => ossn_plugin_view('photos/pages/photo/view', array(
								'photo' => $pages[1],
								'entity' => $image,
								'full_view' => 'all_comments'
								)
							)
						);
						$content = ossn_set_page_layout('contents', $contents);
						$params['contents'] = $content;
						$params['title'] = ossn_print('photos');
						$params['og_title'] = ossn_print('photos');
						$params['og_description'] = ossn_print('com_content_sharing:creator', array(com_content_sharing_creator($owner->owner_guid)));
						$params['og_url'] = current_url(true);
						$params['visited_url'] = 'photos/view/' . $pages[1];
						echo ossn_plugin_view('ContentSharing/ShareablePage', $params);
					} else {
						ossn_error_page();
					}
				} else {
					ossn_error_page();
				}
		break;

		case 'profilecover':
				if (com_is_active('OssnPhotos')) {
					$view = new OssnPhotos;
					$image = $view->GetPhoto($pages[1]);
					if ($image && $image->time_created == $pages[2]) {
						$contents = array(
							'content' => ossn_plugin_view('photos/pages/profile/covers/view', array(
								'photo' => $pages[1],
								'entity' => $image,
								'full_view' => 'all_comments'
								)
							)
						);
						$content = ossn_set_page_layout('contents', $contents);
						$params['contents'] = $content;
						$params['title'] = ossn_print('photos');
						$params['og_title'] = ossn_print('photos');
						$params['og_description'] = ossn_print('com_content_sharing:creator', array(com_content_sharing_creator($image->owner_guid)));
						$params['og_url'] = current_url(true);
						$params['visited_url'] = 'photos/cover/view/' . $pages[1];
						echo ossn_plugin_view('ContentSharing/ShareablePage', $params);
					} else {
						ossn_error_page();
					}
				} else {
					ossn_error_page();
				}
		break;

		case 'profilephoto':
				if (com_is_active('OssnPhotos')) {
					$view = new OssnPhotos;
					$image = $view->GetPhoto($pages[1]);
					if ($image && $image->time_created == $pages[2]) {
						$contents = array(
							'content' => ossn_plugin_view('photos/pages/profile/photos/view', array(
								'photo' => $pages[1],
								'entity' => $image,
								'full_view' => 'all_comments'
								)
							)
						);
						$content = ossn_set_page_layout('contents', $contents);
						$params['contents'] = $content;
						$params['title'] = ossn_print('photos');
						$params['og_title'] = ossn_print('photos');
						$params['og_description'] = ossn_print('com_content_sharing:creator', array(com_content_sharing_creator($image->owner_guid)));
						$params['og_url'] = current_url(true);
						$params['visited_url'] = 'photos/user/view/' . $pages[1];
						echo ossn_plugin_view('ContentSharing/ShareablePage', $params);
					} else {
						ossn_error_page();
					}
				} else {
					ossn_error_page();
				}
		break;

		default:
				ossn_error_page();
		break;
	}
}

function com_content_sharing_creator($creator_guid)
{
	$fullname = '';
	$creator = ossn_user_by_guid($creator_guid);
	if ($creator) {
		if (com_is_active('DisplayUsername')) {
			$fullname = $creator->username;
		} else {
			$fullname = $creator->fullname;
		}
	}
	return $fullname;
}

function com_content_sharing_add_post_share_link($hook, $type, $return, $params)
{
	$show_entry = false;
	ossn_unregister_menu('sharepostlink', 'postextra');
	if ($params['post']->type == 'user') {
		if ($params['post']->access == OSSN_PUBLIC) {
			$show_entry = true;
		}
	} elseif ($params['post']->type == 'group') {
		$group = ossn_get_object($params['post']->owner_guid);
		if ($group->membership == OSSN_PUBLIC) {
			$show_entry = true;
		}
	}
	if ($show_entry) {
		$share_url = ossn_site_url("shared_content/post/{$params['post']->guid}/{$params['post']->time_created}", false);
		ossn_register_menu_item("postextra", array(
				'name' => 'sharepostlink',
				'text' => ossn_print('com_content_sharing:share:postlink'),
				'href' => $share_url,
				'priority' => 300
		));
	}
}

function com_content_sharing_add_entity_share_link($callback, $type, $params)
{
	if ($params['entity']->permission == OSSN_PUBLIC) {
		$show_entry = false;
		ossn_unregister_menu('sharepostlink', 'entityextra');
		switch ($params['entity']->subtype) {
			case 'blog':
				$share_url = ossn_site_url("shared_content/blog/{$params['entity']->owner_guid}/{$params['entity']->time_created}", false);
				$show_entry = true;
			break;
			case 'poll_entity':
				$share_url = ossn_site_url("shared_content/poll/{$params['entity']->owner_guid}/{$params['entity']->time_created}", false);
				$show_entry = true;
			break;
			case 'file:ossn:aphoto':
				$share_url = ossn_site_url("shared_content/photo/{$params['entity']->guid}/{$params['entity']->time_created}", false);
				$show_entry = true;
			break;
			case 'file:profile:cover':
				$share_url = ossn_site_url("shared_content/profilecover/{$params['entity']->guid}/{$params['entity']->time_created}", false);
				$show_entry = true;
			break;
			case 'file:profile:photo':
				$share_url = ossn_site_url("shared_content/profilephoto/{$params['entity']->guid}/{$params['entity']->time_created}", false);
				$show_entry = true;
			break;
		}
		if ($show_entry) {
			ossn_register_menu_item("entityextra", array(
				'name' => 'sharepostlink',
				'text' => ossn_print('com_content_sharing:share:postlink'),
				'href' => $share_url,
				'priority' => 300
			));
		}
	}
}

function com_content_sharing_extend_private_network($hook, $type, $allowed_pages, $params)
{
    $allowed_pages[0][] = 'shared_content';  
    $allowed_pages[1][] = 'post/photo';
	$allowed_pages[1][] = 'comment/image';
    $allowed_pages[1][] = 'album/getphoto';
    $allowed_pages[1][] = 'album/getcover';
    return $allowed_pages;
}

ossn_register_callback('ossn', 'init', 'com_content_sharing_init', 500);
