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
?>
<div class="col-lg-11">
	<div class="ossn-profile-edit-layout">
		<div class="profile-edit-layout-title">
			<?php echo ossn_print('com:aboutuser:aboutuser'); ?>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<div class="profile-edit-tabs">
					<?php
						echo ossn_view_menu('profile/about/tabs', 'profile/menus/edittabs')
						?>
				</div>
			</div>
			<div class="col-lg-9">
				<div class="profile-edit-layout-right">
					<?php echo $params['contents'];?>
				</div>
			</div>
		</div>
	</div>
</div>