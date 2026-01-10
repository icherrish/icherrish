<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   bio
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
?>
<div class="ossn-widget">
	<div class="widget-heading">
		<i class="fa fa-eye"></i> <?php echo $params['page_header']; ?>
	</div>
	<div class="widget-contents">
		<?php
			$bios = $params['bios'];
			if ($bios) {
				foreach ($bios as $item) {
					echo ossn_plugin_view('bio/list/all_bios_item', array('item' => $item));	
				}
			}
		?>
	</div>
</div>