<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Content Sharing
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

if (!isset($params['button'])) {
	$params['button'] = ossn_print('save');
}
if (!isset($params['control'])) {
	$params['control'] = '';
}
if (!isset($params['callback'])) {
	$params['callback'] = '';
}
?>
<div class="title">
	<?php echo $params['title']; ?>
</div>
<div class="contents content-sharing">
	<div class="ossn-box-inner">
		<div style="width:100%;margin:auto;">
			<?php echo $params['contents']; ?>
		</div>
	</div>
</div>
<?php
if ($params['control'] !== false) { ?>
	<div class="control">
		<div class="controls">
			<?php
			if ($params['callback'] !== false) { ?>
				<a href="javascript:void(0);" onclick="<?php echo $params['callback']; ?>;"
				class='btn btn-primary'><?php echo $params['button']; ?></a>
			<?php
			}
			if ($params['cancel'] !== false) {?>
				<a href="javascript:void(0);" onclick="Ossn.MessageBoxClose();" class='btn btn-default'><?php echo ossn_print('cancel'); ?></a>
			<?php
			}
			?>
		</div>
	</div>
<?php 
} ?>
