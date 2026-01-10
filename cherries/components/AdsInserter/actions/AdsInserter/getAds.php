<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Ads Inserter
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$offset = input('offset');
$offset = $offset * 10;
$position = rand($offset - 9, $offset - 1);

$component = new OssnComponents;
$settings = $component->getComSettings('AdsInserter');
if ($settings && $settings->reduced_placement == 'checked') {
	$position = $position * rand(0, 1);
}

$ads = new OssnAds;
header('Content-Type: application/json');
if ($ads = $ads->getAds(array('limit' => 1, 'offset' => 1))) {
	$ad_html = '<div class="ads-inserter ads-inserter-newsfeed" >' . ossn_plugin_view('widget/view', array('title' => ossn_print('sponsored'), 'contents' => ossn_plugin_view('AdsInserter/Newsfeed-Ad-Item', array('item' => $ads[0])))) . '</div>';
	$data    = preg_replace("/\r|\n|\r\n/", "", $ad_html);
	echo json_encode(array(
            "data"     => $data,
			"position" => $position,
            "process"  => 1
	));
	exit;
}
echo json_encode(array(
	"data"    => '',
    "process" => 0
));
exit;


