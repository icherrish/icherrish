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
<div class="gbg-11or12-column col-md-11">
	<div class="ossn-page-contents">
		<div class="ossn-widget">
			<div class="widget-heading">
				<i class="fa fa-edit"></i> <?php echo $params['page_header']; ?>
				<div class="blog-list-sort-option">
					<a href="<?php echo ossn_site_url('blog/all_blogs_by_member?offset=1'); ?>" class="button-grey"><?php echo ossn_print('com:blog:list:sort:by:member'); ?></a>
				</div>
			</div>
			<div class="widget-contents">
				<?php
				$blogs = $params['blogs'];
				$count = $params['count'];
				if ($blogs) {
					foreach ($blogs as $item) {
						echo ossn_plugin_view('blog/list/all_blogs_item', array('item' => $item));
					}
					echo ossn_view_pagination($count);
				}
				?>
			</div>
		</div>
	</div>
</div>