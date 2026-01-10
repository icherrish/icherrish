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
	<input type="text" name="title" placeholder="<?php echo ossn_print('com:blog:blog:title:warning');?>"/>
</div>
<div>
	<label><?php echo ossn_print('com:blog:blog:contents');?></label>
	<?php
	echo ossn_plugin_view('input/textarea', array(
		'class' => 'ossn-editor',
		'name'  => 'contents',
	));
	?>
</div>
<div class="margin-top-10">
	<div class="blog controls">
		<a href="javascript:history.back()" class="btn btn-default"><?php echo ossn_print('cancel');?></a>
		<input type="submit" class="btn btn-success" value="<?php echo ossn_print('save');?>" />
	</div>
</div>