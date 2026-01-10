<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
define('__RSS_FEED__', ossn_route()->com . 'RssFeed/');

/**
 * Rss sidebar initlize the component
 * 
 * return void
 */
 
function com_rss_feed(){
	// where css is added the .php to it*/
	ossn_extend_view('css/ossn.default', 'css/rssfeed');
	ossn_add_hook('newsfeed', "sidebar:right", 'com_rss_widget');
	$component = new OssnComponents;
	$settings = $component->getComSettings('RssFeed');
	if($settings && $settings->mobile_rssbar == 'on'){
		ossn_add_hook('newsfeed', "center:top", 'com_rss_widget');
	}
    if (ossn_isAdminLoggedin()) {
		ossn_register_com_panel('RssFeed', 'settings');	
        ossn_register_action('html/rssbar/save', __RSS_FEED__ . 'actions/save.php');  /*BUG SQUASHED sidebar to rssbar */
    }	
}
/**
 * Show rss on sidebar
 * 
 * return array
 */
function com_rss_widget($hook, $tye, $return){
	$return[] = ossn_plugin_view('rssfeed/contents');
	return $return;
}
/**
 * return void|string
 */
function com_rss_feed_output($text = ''){
	if(!empty($text)){
		return html_entity_decode($text, ENT_QUOTES, 'utf-8');
	}
}
ossn_register_callback('ossn', 'init', 'com_rss_feed');
