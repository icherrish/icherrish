<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Ads Inserter
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

define('__ADSINSERTER__', ossn_route()->com . 'AdsInserter/');

function com_adsinserter_init()
{
		ossn_register_action('AdsInserter/getAds', __ADSINSERTER__ . 'actions/AdsInserter/getAds.php');
	    ossn_extend_view('css/ossn.default', 'css/AdsInserter');
		$component = new OssnComponents();
		if ($component->isActive('PublicWall')) {
			ossn_extend_view('js/ossn.site.public', 'js/AdsInserter');
		} else {
			ossn_extend_view('js/ossn.site', 'js/AdsInserter');
		}
		if (ossn_isLoggedin()) {
			$settings = $component->getComSettings('AdsInserter');
			if ($settings && $settings->aboutpage_ad == 'checked') {
				ossn_add_hook('profile', 'subpage', 'com_adsinserter_about_page');
			}
			if (ossn_isAdminLoggedin()) {
				ossn_add_hook('required', 'components', 'com_adsinserter_asure_requirements');
				ossn_register_com_panel('AdsInserter', 'settings');
				ossn_register_action('AdsInserter/admin/settings', __ADSINSERTER__ . 'actions/AdsInserter/admin/settings.php');		
			}	
		}
}

function com_adsinserter_asure_requirements($hook, $type, $return, $params)
{
		$return[] = 'OssnAds';
		$return[] = 'OssnWall';
		return $return;
}

function com_adsinserter_fetch_ads($show_widget)
{
		$ads = new OssnAds;
		$ads = $ads->getAds();
		if ($ads) {
			$formatted_ads = array();
			foreach ($ads as $ad) {
				if ($show_widget) {
					$ad_html = '<div class="ossn-ads ads-inserter">' . ossn_plugin_view('widget/view', array('title' => ossn_print('sponsored'), 'contents' => ossn_plugin_view('ads/item', array('item' => $ad)))) . '</div>';
					$formatted_ads[] = preg_replace("/\r|\n|\r\n/", "", $ad_html);
				} else {
					$ad_html = '<div class="ossn-ads">' . ossn_plugin_view('ads/item', array('item' => $ad)) . '</div>';
					$formatted_ads[] = preg_replace("/\r|\n|\r\n/", "", $ad_html);
				}
			}
			return $formatted_ads;
		}
		return false;
}

function com_adsinserter_fetch_random_ad($show_widget)
{
		$ads = new OssnAds;
		$ads = $ads->getAds();
		if ($ads) {
			if ($show_widget) {
				$ad_html = '<div class="ossn-ad ads-inserter" >' . ossn_plugin_view('widget/view', array('title' => ossn_print('sponsored'), 'contents' => ossn_plugin_view('AdsInserter/Newsfeed-Ad-Item', array('item' => $ads[0])))) . '</div>';
			} else {
				$ad_html = '<div class="ossn-ads">' . ossn_plugin_view('ads/item', array('item' => $ads[0])) . '</div>';
			}
			return preg_replace("/\r|\n|\r\n/", "", $ad_html);
		}
		return false;
}

function com_adsinserter_about_page($hook, $type, $return, $params)
{
		if ($ad = com_adsinserter_fetch_random_ad(true)) {
			if (isset($params['subpage']) && $params['subpage'] == 'about') {
				$params['ads'] = $ad;
				echo ossn_plugin_view('AdsInserter/About', $params);
			}
		}
}

ossn_register_callback('ossn', 'init', 'com_adsinserter_init');
