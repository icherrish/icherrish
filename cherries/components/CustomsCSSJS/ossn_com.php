<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Customs CSS/JS
 * @author    Hugo Cuellar <https://www.opensource-socialnetwork.org/u/Erassus>
 * @copyright (C) Hugo Cuellar
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

define('__CSSJS__', ossn_route()->com . 'CustomsCSSJS/');
function cssjs_init() {
		ossn_register_com_panel('CustomsCSSJS', 'settings');
		if(ossn_isAdminLoggedin()) {
				ossn_register_action('cssjs/edit', __CSSJS__ . 'actions/edit.php');
		}

		ossn_extend_view('ossn/site/head', 'css/customs');
		ossn_extend_view('ossn/site/head', 'js/customs');

		ossn_extend_view('ossn/admin/head', 'css/customs.admin');
		ossn_extend_view('ossn/admin/head', 'js/customs.admin');
}
function cssjs($action = 'ossn') {
		switch($action) {
			case 'backend_css':
			case 'backend_js':
			case 'frontend_css':
			case 'frontend_js':
				$settings = new OssnComponents();
				$settings = $settings->getComSettings('CustomsCSSJS');
				if(!empty($settings->$action)) {
						if(stripos($action, '_css') !== false) {
								$pre = "\n<style>\n";
								$suf = "\n</style>\n";
						} else {
								$pre = "\n<script>\n";
								$suf = "\n</script>\n";
						}
						echo htmlspecialchars_decode($pre . $settings->$action . $suf, ENT_QUOTES);
				}
				return;
				break;
			case 'form':
				$params = array(
						'backend_css'  => false,
						'backend_js'   => false,
						'frontend_css' => false,
						'frontend_js'  => false,
				);
				$settings = new OssnComponents();
				$settings = $settings->getComSettings('CustomsCSSJS');
				if(!empty($settings)) {
						foreach($params as $field => $param) {
								$content = $settings->$field;
								switch($field) {
									case 'backend_css':
									case 'backend_js':
									case 'frontend_css':
									case 'frontend_js':
										$params[$field] = $content;
								}
						}
				}
				return $params;
				break;
			case 'edit':
				if(!ossn_isAdminLoggedin()) {
						echo ossn_error_page();
						return;
				}

				$OssnComponents = new OssnComponents();
				$fields         = array(
						'backend_css',
						'backend_js',
						'frontend_css',
						'frontend_js',
				);
				foreach($fields as $field) {
						$label   = ossn_print('cssjs:' . $field);
						$guid    = intval(input("{$field}_id"));
						$content = input("{$field}");
						$saved   = $OssnComponents->setSettings('CustomsCSSJS', array(
								$field => $content,
						));
						if($saved) {
								ossn_trigger_message(
										ossn_print('com:customs:cssjs:update', array(
												$label,
										)),
										'success'
								);
						} else {
								ossn_trigger_message(
										ossn_print('com:customs:cssjs:update:fail', array(
												$label,
										)),
										'error'
								);
						}
				}
				redirect(REF);
		}
		redirect(REF);
}
ossn_register_callback('ossn', 'init', 'cssjs_init');