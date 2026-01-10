<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Textarea Support
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
define('__TEXTAREA_SUPPORT__', ossn_route()->com . 'TextareaSupport/');
require_once __TEXTAREA_SUPPORT__ . 'vendors/htmlpurifier-4.12.0-lite/library/HTMLPurifier.auto.php';

/**
 * Initialize component
 *
 * @return void
 */
function com_textarea_support_init()
{
		ossn_extend_view('ossn/site/head', 'js/textareasupport-language-selector');
		ossn_extend_view('ossn/admin/head', 'js/textareasupport-language-selector');
		ossn_extend_view('css/ossn.default', 'css/textareasupport');
		
		if (!com_textarea_support_tinymce_available()) {
			ossn_load_external_js('tinymce.min');
		}
		if (ossn_isAdminLoggedin()){
			ossn_register_com_panel('TextareaSupport', 'settings');
			ossn_register_action('admin/textarea_support/settings', __TEXTAREA_SUPPORT__ . 'actions/settings.php');
		}
		ossn_add_hook('textarea', 'purify', 'com_textarea_support_purify');
		ossn_add_hook('textarea', 'responsify', 'com_textarea_support_responsify');
		if (ossn_isloggedin()) {
			ossn_register_action('TextareaSupport/upload', __TEXTAREA_SUPPORT__ . 'actions/TextareaSupport/upload.php');
		}
}

function com_textarea_support_tinymce_available()
{
		global $Ossn;
		return array_search('tinymce.min', $Ossn->jsheadExternal['site']);
}

function com_textarea_support_purify($hook, $type, $return, $params)
{
		$OssnComponents = new OssnComponents;
		$settings = $OssnComponents->getSettings('TextareaSupport');
		if ($settings && $settings->scripting_and_svg == 'on') {
			return html_entity_decode($return);
		} else {
			$purify_config = HTMLPurifier_Config::createDefault();
			$purify_config->set('Attr.AllowedFrameTargets', '_blank');
			$purify_config->set('HTML.SafeIframe', true);
			$purify_config->set('URI.SafeIframeRegexp', '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%');
			$purify_config->set('CSS.Trusted', true);
			$def = $purify_config->getHTMLDefinition(true);
			$def->addAttribute('iframe', 'allowfullscreen', 'Bool');
			$def->addAttribute('img', 'style', 'CDATA');
			$purifier = new HTMLPurifier($purify_config);
			return $purifier->purify(html_entity_decode($return));
		}
}

function com_textarea_support_responsify($hook, $type, $return, $params)
{
	$regex = '#<\s*?iframe[^>]*>(.*?)</iframe\b[^>]*>#s';
	if (preg_match_all($regex, $return, $vmatches)) {
		if (is_array($vmatches)) {
			$found_videos = $vmatches[0];
			foreach ($found_videos as $video) {
				$styled_video = str_replace('<iframe src', '<iframe class="textarea-support-responsive-video-iframe" src', $video);
				$return = str_replace($video, '<div class="textarea-support-responsive-video-default-width"><div class="textarea-support-responsive-video-aspect-ratio">' . $styled_video . '</div></div>', $return);
			}
			unset($vmatches);
		}
	}

	$regex = '#<img[^>]*>#s';
	if (preg_match_all($regex, $return, $imatches)) {
		if (is_array($imatches)) {
			$found_images = $imatches[0];
			foreach ($found_images as $image) {
				preg_match('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i', $image, $match);
				$img_src = $match[2];
				preg_match_all('/(width|height)="[0-9]*"/i', $image, $match);
				$styled_image = $image;
				if (isset($match[0][0]) && isset($match[0][1])) {
					$img_width = explode('"', $match[0][0])[1];
					$img_height = explode('"', $match[0][1])[1];
					$styled_image = '<img class="textarea-support-responsive-image" src="' . $img_src . '" style="width: ' . $img_width . 'px; aspect-ratio: ' . $img_width . '/' . $img_height . '" />';
				} else {
					ossn_trigger_message(ossn_print('com:textareasupport:storage:image:error:dimensions'), 'error');
				}
				$return = str_replace($image, $styled_image, $return);
				unset($match);
			}
			unset($imatches);
		}
	}
	return $return;
}

ossn_register_callback('ossn', 'init', 'com_textarea_support_init');
