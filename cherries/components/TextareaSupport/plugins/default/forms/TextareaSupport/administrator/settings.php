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
$settings = $component->getSettings('TextareaSupport');

$scripting_options = array(
	'off',
	'on'
);
foreach ($scripting_options as $option) {
	 $scripting_option_strings[$option] = ossn_print("ossn:admin:settings:{$option}"); 
}
?>
<div class="card">
	<div class="card-header">
		<?php echo ossn_print('com:textareasupport:admin:settings:label:scripting:support');?>
	</div>
	<div class="card-body">
		<?php 
		echo ossn_print('com:textareasupport:admin:settings:label:invalid:elements:description');
		echo ossn_plugin_view('input/radio', array(
				'name' => 'scripting_and_svg',
				'value' => (($settings ? $settings->scripting_and_svg : false) ?: 'off'),
				'options' => $scripting_option_strings,
				'class' => ''
		));
		?>
		<input type="submit" class="btn btn-success btn-sm" value="<?php echo ossn_print('save'); ?>"/>
	</div>
</div>