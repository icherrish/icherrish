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
//<script>

var wide_screen_insert = false;
document.addEventListener("DOMContentLoaded", function() {
	<?php
	$component = new OssnComponents;
	$settings = $component->getComSettings('AdsInserter');
	if ($settings && $settings->wide_screen_insert == 'checked') {
	?>
		wide_screen_insert = true;
	<?php
	}
	if ($settings && $settings->hide_column_ads == 'checked') {
	?>
		$('.ossn-ads').hide();
	<?php
	}
	?>
		
	if (($('.ossn-wall-item').length && $('.ossn-ads').length && $('.ossn-ads').is(':hidden')) || ($('.ossn-wall-item').length && wide_screen_insert)) {
		// Part I: used on first newsfeed page and if Autopagination is disabled
		$offset = 1;
		Ossn.PostRequest({
			action: false,
			url: Ossn.site_url + "action/AdsInserter/getAds",
			params: 'offset=' + $offset,
			callback: function(callback) {
				if (callback['process']) {
					var position = callback['position'];
					var data = callback['data'];
					var elements = $(".ossn-wall-item").length;
					if (position > elements) {
						position = elements;
					}
					var insertpos = $('.ossn-wall-item').not('[class*="ossn-wall-shared-item-"]').eq( position - 1 );
					$(callback['data']).insertAfter(insertpos);
					<?php
					if ($settings && $settings->blogpage_ad == 'checked') {
					?>
						$('.blog-wrapper .ads-inserter').show();
					<?php
					}
					?>
				}
			}
		});

		if (typeof Ossn.isInViewPort == 'function') {
			// Part II: used on further newsfeed pages if Autopagination is turned on
			$calledOnceAd = [];
			Ossn.isInViewPort({
				element: '.user-activity .ossn-pagination',
				callback: function(event, $all_elements) {
					$next = $(this).find('.active').next();
					if ($next) {
						$actual_next_url = $next.find('a').attr('href');
						$url = $actual_next_url;
						$offset = Ossn.AutoPaginationURLparam('offset', $url);
						$url = '?offset=' + $offset;
						if ($.inArray($url, $calledOnceAd) == -1 && $offset > 0) {
							$calledOnceAd.push($url);
							Ossn.PostRequest({
								action: false,
								url: $actual_next_url,
								callback: function(callback) {
									$element = $(callback).find('.user-activity');
									if ($element.length) {
										Ossn.PostRequest({
											action: false,
											url: Ossn.site_url + "action/AdsInserter/getAds",
											params: 'offset=' + $offset,
											callback: function(callback) {
												if (callback['process']) {
													var position = callback['position'];
													var data = callback['data'];
													var elements = $(".user-activity .ossn-wall-item").length;
													if(position > elements) {
														position = elements;
													}
													var insertpos = $('.ossn-wall-item').not('[class*="ossn-wall-shared-item-"]').eq( position - 1 );
													$(callback['data']).insertAfter(insertpos);
												}
											}
										});
									}
								}
							});
						} 
					}
				}
			});
		}
	}
});
