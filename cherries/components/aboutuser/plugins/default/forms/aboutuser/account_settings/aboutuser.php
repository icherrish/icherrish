<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$aboutuser_access_options = array(
		OSSN_PUBLIC,
		OSSN_FRIENDS,
		OSSN_PRIVATE
);
foreach ($aboutuser_access_options as $option) {
		$aboutuser_access_option_strings[$option] = ossn_print("com:aboutuser:accessibility:option:{$option}"); 
}

?>
<label><?php echo ossn_print('com:aboutuser:accessibility'); ?></label>
<?php
echo ossn_plugin_view('input/radio', array(
		'name' => 'aboutuser_access',
		'value' => (int) $params['aboutuser_access'],
		'options' => $aboutuser_access_option_strings,
		'class' => ''
));

?>
<br />
<input type="hidden" value="<?php echo $params['username']; ?>" name="username"/>
<input type="submit" class="btn btn-primary" value="<?php echo ossn_print('save'); ?>"/>
