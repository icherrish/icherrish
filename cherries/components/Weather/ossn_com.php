<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 
function weather_widget_init() {	
		if(ossn_isLoggedin()) {
				ossn_add_hook('newsfeed', "sidebar:right", 'weather_widget', 1);
		}
}
/**
 * Weather Widget
 *
 * @param string $hook A name of hook
 * @param string $type A type of hook
 * @param array  $return A mixed data arrays
 *
 * @return array
 */
function weather_widget($hook, $type, $return) {
		$return[] = ossn_plugin_view('widget/view', array(
				'title' => ossn_print('weather'),
				'contents' => ossn_plugin_view('weather/widget'),
				'class' => 'weather-widget'
		));
		return $return;
}
ossn_register_callback('ossn', 'init', 'weather_widget_init', 1);