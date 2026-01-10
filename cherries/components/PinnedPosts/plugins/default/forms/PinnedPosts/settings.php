<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Pinned Posts
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$settings = $params['settings'];
if (!$settings) {
	$settings = new stdClass();
	$settings->PinnedPosts = '';
}
if (!isset($settings->Background)) {
	$settings->Background = "info";
}
// 7.2dev1 new feature: display/hide comments
if (!isset($settings->DisplayComments)) {
	$settings->DisplayComments = '';
}
// 7.3dev1 new feature: un-/collapse pinned posts
if (!isset($settings->CollapsePosts)) {
	$settings->CollapsePosts = '';
}
?>
<div>
	<label>
		<?php echo ossn_print('com:pinned:posts:announcement:text'); ?>
	</label>
	<?php
	echo ossn_plugin_view('input/text', array(
		'name' => 'pinnedposts',
		'value' => $settings->PinnedPosts,
	)
	);
	?>
</div>
<div>
	<label>
		<?php echo ossn_print('com:pinned:posts:display:comments'); ?>
	</label>
	<?php
	echo ossn_plugin_view('input/checkbox', array(
		'name' => 'displaycomments',
		'value' => $settings->DisplayComments,
	)
	);
	?>
</div>
<div>
	<label>
		<?php echo ossn_print('com:pinned:posts:collapse:posts'); ?>
	</label>
	<?php
	echo ossn_plugin_view('input/checkbox', array(
		'name' => 'collapseposts',
		'value' => $settings->CollapsePosts,
	)
	);
	?>
</div>
<div class="mt-4">
	<label>
		<?php echo ossn_print('com:pinned:posts:background:color'); ?>
	</label>
    <?php
		echo ossn_plugin_view('input/dropdown', array(
				'name' => 'background',
				'value' => $settings->Background,
				'id' => 'pinnedposts-background',
				'options' => array(
						'info' => ossn_print('com:pinned:posts:background:color:cyan'),
						'primary' => ossn_print('com:pinned:posts:background:color:blue'),
						'warning' => ossn_print('com:pinned:posts:background:color:yellow'),
						'success' => ossn_print('com:pinned:posts:background:color:green'),
						'danger' => ossn_print('com:pinned:posts:background:color:red'),
						'light' => ossn_print('com:pinned:posts:background:color:white'),
						'secondary' => ossn_print('com:pinned:posts:background:color:lightgrey'),
						'dark' => ossn_print('com:pinned:posts:background:color:darkgrey'),
				 ),											  
		));
	?>
    <script>
		$(document).ready(function() {
				// add formerly chosen color on page load
				$('#pinnedposts-background option').each(function(){
					$val = $(this).val();
					$(this).addClass("alert alert-"+$val);
				});						   
				$('#pinnedposts-background').addClass("alert alert-" + $('#pinnedposts-background')[0].value);
		});
		$("#pinnedposts-background").change(function () {
				// add changed color
				$('#pinnedposts-background').removeClass();
				$('#pinnedposts-background').addClass("ossn-dropdown-input alert alert-"+$(this).val());
		});					   
	</script>
</div>
<div>
	<div class="margin-top-10">
		<input type="submit" class="btn btn-success" value="<?php echo ossn_print('save'); ?>" />
	</div>
</div>
