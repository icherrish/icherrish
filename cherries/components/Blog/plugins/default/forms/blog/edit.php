<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

?>
<div>
	<label><?php echo ossn_print('com:blog:blog:title');?></label>
	<input type="text" name="title" value="<?php echo $params['blog']->title;?>"/>
</div>
<div>
	<label><?php echo ossn_print('com:blog:blog:contents');?></label>
	<?php
	echo ossn_plugin_view('input/textarea', array(
		'class' => 'ossn-editor',
		'name'  => 'contents',
		'value' => html_entity_decode($params['blog']->description)
	));
	?>
</div>
<div class="margin-top-10">
	<div class="blog controls">
		<input type="hidden" name="guid" value="<?php echo $params['blog']->guid;?>" />
		<a href="<?php echo ossn_site_url('blog/view/' . $params['blog']->guid);?>" class="btn btn-default"><?php echo ossn_print('cancel');?></a>
		<input type="submit" class="btn btn-success" value="<?php echo ossn_print('save');?>" />
	</div>
</div>