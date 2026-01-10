<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (3ncircle.com).ossn
 * @author    AT3META <at3meta@3ncircle.com>
 * @copyright 2021 3NCIRCLE Inc.
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
define('__SOCIAL__', ossn_route()->com . 'Social/');

function social_init() {
	ossn_register_page('social', 'social_pages');
	  if (ossn_isLoggedin()) {       
		
		ossn_extend_view('css/ossn.default', 'css/social');
		
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'facebook',

						'text' => ossn_print('com:ossn:facebook'),

						'url' => ossn_site_url('social/facebook'),

						'section' => 'social',

				));
				
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'twitter',

						'text' => ossn_print('com:ossn:twitter'),

						'url' => ossn_site_url('social/twitter'),

						'section' => 'social',

				));	
				
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'instagram',

						'text' => ossn_print('com:ossn:instagram'),

						'url' => ossn_site_url('social/instagram'),

						'section' => 'social',

				));
				
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'tumblr',

						'text' => ossn_print('com:ossn:tumblr'),

						'url' => ossn_site_url('social/tumblr'),

						'section' => 'social',

				));
					
    }
}
function social_pages($pages) {

if(!ossn_isLoggedin()) {

				ossn_error_page();
		}


		switch($pages[0]) {

				case 'facebook':

						$guid                = $pages[1];

						$title               = ossn_print('com:ossn:facebook');
						
						$contents['content'] = ossn_plugin_view('pages/facebook', array(

								'guid' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

						break;
						
				case 'twitter':

						$guid                = $pages[2];

						$title               = ossn_print('com:ossn:twitter');
						
						$contents['content'] = ossn_plugin_view('pages/twitter', array(

								'guid' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

						break;
						
				case 'instagram':

						$guid                = $pages[3];

						$title               = ossn_print('com:ossn:instagram');
						
						$contents['content'] = ossn_plugin_view('pages/instagram', array(

								'guid' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

						break;
						
				case 'tumblr':

						$guid                = $pages[4];

						$title               = ossn_print('com:ossn:tumblr');

						$contents['content'] = ossn_plugin_view('pages/tumblr', array(

								'guid' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

	}
}
ossn_register_callback('ossn', 'init', 'social_init');
