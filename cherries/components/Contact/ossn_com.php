<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team | Sathish Kumar <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED, 2014 webbehinds
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

define('__CONTACT__', ossn_route()->com . 'Contact/');

function com_contact_init() {
	if(ossn_isAdminLoggedin()){
		ossn_register_com_panel('Contact', 'settings');
		ossn_register_action('Contact/admin/settings', __CONTACT__ . 'actions/Contact/admin/settings.php');		
	}	
	ossn_register_action('Contact/contactmail', __CONTACT__ . 'actions/Contact/contactmail.php');
	ossn_register_page('contact', 'com_contact_page_handler');
	ossn_register_menu_link('Contact', ossn_print('contact:form:title'), ossn_site_url('contact'), 'footer');
	ossn_extend_view('js/ossn.site.public', 'Contact/js');
	ossn_add_hook('captcha', 'protected:components', 'com_contact_captcha_registration');
}

function com_contact_captcha_registration($hook, $type, $return, $params) {
		// let any Captcha component know which action and form needs to be protected
		$return['protected_actions'][]  = 'Contact/contactmail';
		$return['protected_forms'][]    = 'Contact/contactform';
		return $return;
}

function com_contact_page_handler($page) {
	if (empty($page)) {
		redirect(REF);
	}
	$title = ossn_print('contact:form:title');
	$contents = array('content' => ossn_plugin_view('pages/contactpage'));
	$content = ossn_set_page_layout('contents', $contents);
	echo ossn_view_page($title, $content);			
}

ossn_register_callback('ossn', 'init', 'com_contact_init');
