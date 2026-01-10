<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Ads Inserter
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

?>
<div class="ossn-ad-item">
	<div class="row">
		<a target="_blank" href="<?php echo $params['item']->site_url;?>">
		<div class="col-md-12">
			<div class="ad-title"><?php echo $params['item']->title;?></div>
			<img class="ads-inserter-newsfeed-ad-image" src="<?php echo ossn_ads_image_url($params['item']->guid); ?>" />
			<div class="ads-inserter-newsfeed-ad-description"><?php echo $params['item']->description;?></div>
		</div>
		</a>
	</div>
</div>
