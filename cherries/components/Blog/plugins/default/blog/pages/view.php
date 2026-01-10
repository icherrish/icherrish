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

$blog_content = ossn_call_hook('textarea', 'purify', false, html_entity_decode($params['blog']->description));
$blog_content = ossn_call_hook('textarea', 'responsify', false, $blog_content);
$user = ossn_user_by_guid($params['blog']->owner_guid);
?>
<div class="gbg-11or12-column col-md-11">
	<div class="blog ossn-wall-item">
		<div class="meta">
			<img class="user-img" src="<?php echo $user->iconURL()->small;?>" />
			<div class="user">
				<a href="<?php echo $user->profileURL();?>"><?php echo $user->fullname;?></a>
			</div>
			<div class="post-meta">
				<span class="time-created"><?php echo ossn_print('com:blog:blog:edit:timestamp' , array(date(ossn_print('com:blog:blog:edit:timestamp:format'), $params['blog']->time_updated)));?></span>
			</div>
		</div>
		<div class="ossn-widget">
			<div class="widget-heading">
				<?php echo $params['blog']->title;?>
				<div class="blog-list-sort-option">
					<?php if (ossn_loggedin_user() && (ossn_loggedin_user()->guid == $params['blog']->owner_guid || ossn_loggedin_user()->canModerate())) { ?>
					<a id="BlogDeleteButton" href="<?php echo $params['blog']->deleteURL();?>" class="button-grey"><?php echo ossn_print('delete');?></a>
					<a href="<?php echo $params['blog']->profileURL('edit');?>" class="button-grey"><?php echo ossn_print('edit');?></a>
					<?php } ?>
				</div>
			</div>
			<div class="widget-contents">
				<?php echo $blog_content;?>
			</div> 
		</div>
		<?php 
		if ($params['blog_entity']) {
			$vars['entity'] = $params['blog_entity'];
			if (!ossn_isLoggedin()) {
				$vars['full_view'] = true;
			} else {
				$vars['full_view'] = $params['full_view'];
			}
			echo ossn_plugin_view('entity/comment/like/share/view', $vars);
		}
		?>
	</div>
</div>
