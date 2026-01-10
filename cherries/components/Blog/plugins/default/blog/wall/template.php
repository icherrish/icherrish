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
$blog = new OssnObject;
$blog->object_guid = $params['post']->item_guid;
$preview = $blog->getObjectById();
if (!$preview) {
	return;
}
$preview_content = ossn_call_hook('textarea', 'purify', false, html_entity_decode($preview->description));
$preview_content = ossn_call_hook('textarea', 'responsify', false, $preview_content);
if (mb_strlen($preview_content, 'UTF-8') > BLOG_PREVIEW_LENGTH) {
	$preview_content = mb_substr(strip_tags($preview_content), 0, BLOG_PREVIEW_LENGTH, 'UTF-8') . ' ...';
}
?>
<div class="ossn-wall-item ossn-wall-item-<?php echo $params['post']->guid; ?>" id="activity-item-<?php echo $params['post']->guid; ?>">
	<div class="row">
		<div class="meta">
			<img class="user-img" src="<?php echo $params['user']->iconURL()->small; ?>" />
			<div class="post-menu">
				<div class="dropdown">
					<?php
					if (ossn_is_hook('wall', 'post:menu') && ossn_isLoggedIn()) {
						$menu['post'] = $params['post'];
						echo ossn_call_hook('wall', 'post:menu', $menu);
					}
					?>
				</div>
			</div>
			<div class="user">
				<?php if ($params['user']->guid == $params['post']->owner_guid) { ?>
					<a class="owner-link" href="<?php echo $params['user']->profileURL(); ?>"> <?php echo $params['user']->fullname; ?> </a>
					<div class="ossn-wall-item-type"><?php echo ossn_print('com:blog:wall:post:subject'); ?></div>
				<?php } ?>
			</div>
			<div class="post-meta">
				<span class="time-created ossn-wall-post-time" title="<?php echo date('d/m/Y', $params['post']->time_created);?>" onclick="Ossn.redirect('<?php echo("post/view/{$params['post']->guid}");?>');"><?php echo ossn_user_friendly_time($params['post']->time_created); ?></span>
				<?php
				echo ossn_plugin_view('privacy/icon/view', array(
					'privacy' => $params['post']->access,
					'text' => '-',
					'class' => 'time-created',
				));
				?>
			</div>
		</div>

		<div class="post-contents">
			<div class="blog-wall-item">
				<div class="blog-wall-item-title"><?php echo $preview->title;?></div>
				<div>
					<?php 
					echo $preview_content;
					?>
				</div>
				<br>
				<a target="_self" href="<?php echo ossn_site_url("blog/view/{$preview->guid}");?>"><i><?php echo ossn_print('com:blog:wall:post:view:complete');?></i></a>
			</div>
		</div>
		<?php if (com_is_active('SharePost')) { ?>
		<div class="comments-likes">
			<div class="menu-likes-comments-share">
				<li><a class="post-control-shareobject share-object-select" data-type="object" data-guid="<?php echo("{$params['post']->guid}");?>" href="javascript:void(0);"><?php echo ossn_print('post:share'); ?></a></li>
			</div>
		</div>
		<?php } ?>
 
	</div>
</div>
