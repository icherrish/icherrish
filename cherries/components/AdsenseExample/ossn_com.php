<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   AdsenseExample
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

 function com_AdsenseExample_init()
{
	// All code derived from https://developers.google.com/publisher-tag/samples/display-test-ad
	//
	// make Google's main adsense library available for Ossn
	ossn_new_external_js('adsense.min', '//securepubads.g.doubleclick.net/tag/js/gpt.js', false);
	ossn_load_external_js('adsense.min');

	// some more script to define an insertion anchor for the Google ad 
	ossn_extend_view('js/ossn.site', 'AdsenseExample/Config');

}
ossn_register_callback('ossn', 'init', 'com_AdsenseExample_init');
