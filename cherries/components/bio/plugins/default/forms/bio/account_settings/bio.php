<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   bio
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
$bio_access_options = array(
	OSSN_PUBLIC,
	OSSN_FRIENDS
);
foreach ($bio_access_options as $option) {
	 $bio_access_option_strings[$option] = ossn_print("com:bio:accessibility:option:{$option}"); 
}

echo ossn_plugin_view('input/textarea', array(
	'label' => 'bio',
	'class' => 'ossn-editor',
	'name'  => 'bio',
	'value' => html_entity_decode($params['bio']),
	'placeholder' => ossn_print('com:bio:placeholder')
));
?>
<br />
<h6><?php echo ossn_print('com:bio:visibility'); ?></h6>
<?php
echo ossn_plugin_view('input/radio', array(
	'name' => 'bio_access',
	'value' => ((int) $params['bio_access'] ?: OSSN_PUBLIC),
	'options' => $bio_access_option_strings,
	'class' => ''
));

?>
<br />
<input type="hidden" value="<?php echo $params['username']; ?>" name="username"/>
<input type="submit" class="btn btn-primary" value="<?php echo ossn_print('save'); ?>"/>
