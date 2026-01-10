<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Content Sharing
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$dst_dir = ossn_get_userdata('components/ContentSharing/previews');
if (!is_dir($dst_dir)) {
	if (!mkdir("{$dst_dir}", 0755, true)) {
		error_log('ContentSharing: The directory for preview images cannot be created');
		com_content_sharing_load_component_languages();
		ossn_trigger_message(ossn_print('com_content_sharing:preview:directory:creation:failure'), 'error');
		redirect(REF);
	}
}

function com_content_sharing_load_component_languages()
{
	$codes = ossn_standard_language_codes();
	$path  = ossn_route();
	foreach ($codes as $code) {
		$file = $path->components . "/ContentSharing/locale/ossn.{$code}.php";
		if (is_file($file)) {
			include_once($file);
		}
	}
}