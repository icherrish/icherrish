<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Ads Inserter
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$reduced_placement_setting = '';
$aboutpage_ad_setting = '';
$blogpage_ad_setting = '';
$component = new OssnComponents;
$settings = $component->getComSettings('AdsInserter');
if ($settings) {
	$reduced_placement_setting = $settings->reduced_placement;
	$aboutpage_ad_setting = $settings->aboutpage_ad;
	$blogpage_ad_setting = $settings->blogpage_ad;
	$wide_screen_insert_setting = $settings->wide_screen_insert;
	$hide_column_ads_setting = $settings->hide_column_ads;
} else {
	$reduced_placement_setting = '';
	$aboutpage_ad_setting = '';
	$blogpage_ad_setting = '';
	$wide_screen_insert_setting = '';
	$hide_column_ads_setting = '';	
}
?> 
<div class="card">
	<div class="card-body">
		<br />
		<input type="checkbox" name="reduced_placement" value='checked' <?php echo $reduced_placement_setting; ?>> <?php echo ossn_print('com:adsinserter:reduce:placements'); ?>
		<br />
		<br />
		<input type="checkbox" name="aboutpage_ad" value='checked' <?php echo $aboutpage_ad_setting; ?>> <?php echo ossn_print('com:adsinserter:aboutpage:ad'); ?>
		<br />
		<br />
		<input type="checkbox" name="blogpage_ad" value='checked' <?php echo $blogpage_ad_setting; ?>> <?php echo ossn_print('com:adsinserter:blogpage:ad'); ?>
		<br />
		<br />
		<input type="checkbox" name="wide_screen_insert" value='checked' <?php echo $wide_screen_insert_setting; ?>> <?php echo ossn_print('com:adsinserter:widescreen:insert'); ?>
		<br />
		<br />
		<input type="checkbox" name="hide_column_ads" value='checked' <?php echo $hide_column_ads_setting; ?>> <?php echo ossn_print('com:adsinserter:hide:column:ads'); ?>
		<br />
		<br />
		<input type="submit" value="<?php echo ossn_print('save');?>" class="btn btn-success"/>
	</div>
</div>