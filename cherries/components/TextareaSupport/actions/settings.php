<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Textarea Support
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$component = new OssnComponents;
$modes = array(
		'off',
		'on'
);
$scripting_and_svg  = input('scripting_and_svg');
if (in_array($scripting_and_svg, $modes)) {
	if ($component->setSettings('TextareaSupport', array('scripting_and_svg' => $scripting_and_svg))) {
		ossn_trigger_message(ossn_print('ossn:admin:settings:saved'));
		redirect(REF);
	}
}
ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
redirect(REF);