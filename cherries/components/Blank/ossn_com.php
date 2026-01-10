<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   Blank
 * @author    AT3META <at3meta@3ncircle.com>
 * @copyright 2021 3NCIRCLE Inc.
 * @license   General Public License v3
 * @link      https://www.gnu.org/licenses/gpl-3.0.en.html
 */
define('__BLANK__', ossn_route()->com . 'Blank/');

function blank_init() {
	ossn_register_page('blank', 'blank_pages');
	  if (ossn_isLoggedin()) {       
		ossn_extend_view('css/ossn.default', 'css/blank');
		
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'blank1',

						'text' => ossn_print('com:ossn:blank1'),

						'url' => ossn_site_url('blank/blank1'),

						'section' => 'blank',

				));
				
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'blank2',

						'text' => ossn_print('com:ossn:blank2'),

						'url' => ossn_site_url('blank/blank2'),

						'section' => 'blank',

				));	
				
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'blank3',

						'text' => ossn_print('com:ossn:blank3'),

						'url' => ossn_site_url('blank/blank3'),

						'section' => 'blank',

				));
				
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'blank4',

						'text' => ossn_print('com:ossn:blank4'),

						'url' => ossn_site_url('blank/blank4'),

						'section' => 'blank',

				));
					
    }
}
function blank_pages($pages) {

if(!ossn_isLoggedin()) {

				ossn_error_page();
		}


		switch($pages[0]) {

				case 'blank1':

						$guid                = $pages[1];

						$title               = ossn_print('com:ossn:blank1');
						
						$contents['content'] = ossn_plugin_view('pages/blank1', array(

								'blank1' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

						break;
						
				case 'blank2':

						$guid                = $pages[2];

						$title               = ossn_print('com:ossn:blank2');
						
						$contents['content'] = ossn_plugin_view('pages/blank2', array(

								'blank2' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

						break;
						
				case 'blank3':

						$guid                = $pages[3];

						$title               = ossn_print('com:ossn:blank3');
						
						$contents['content'] = ossn_plugin_view('pages/blank3', array(

								'blank3' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

						break;
						
				case 'blank4':

						$guid                = $pages[4];

						$title               = ossn_print('com:ossn:blank4');

						$contents['content'] = ossn_plugin_view('pages/blank4', array(

								'blank4' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

	}
}
ossn_register_callback('ossn', 'init', 'blank_init');
