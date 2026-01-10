<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Ads Inserter
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$reduced_placement  = input('reduced_placement');
$aboutpage_ad       = input('aboutpage_ad');
$blogpage_ad        = input('blogpage_ad');
$wide_screen_insert = input('wide_screen_insert');
$hide_column_ads	= input('hide_column_ads');

$component = new OssnComponents;
if ($component->setSettings('AdsInserter',
	array(
		'reduced_placement' => $reduced_placement,
		'aboutpage_ad' => $aboutpage_ad,
		'blogpage_ad' => $blogpage_ad,
		'wide_screen_insert' => $wide_screen_insert,
		'hide_column_ads' => $hide_column_ads
	))) {
	if (ossn_site_settings('cache') == true) {
		ossn_disable_cache();
		ossn_create_cache();
		ossn_trigger_message(ossn_print('cache:flushed'));
	}		
	ossn_trigger_message(ossn_print('ossn:admin:settings:saved'));
	redirect(REF);
} else {
	ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
	redirect(REF);
}
