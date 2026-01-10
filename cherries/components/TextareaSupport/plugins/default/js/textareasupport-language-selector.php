<script>
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Textarea Support
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
<?php
	$current_lang = ossn_site_settings('language');
	if (ossn_isLoggedin()) {
		$user = ossn_loggedin_user();
		if (isset($user->language)) {
			$current_lang = $user->language;
		}
	}
?>
$(document).ready(function() {
	$("[class*='textarea-language-']").hide();
	$('.textarea-language-<?php echo $current_lang; ?>').show();
});
function comTextareaSupportToRGB(color) {
	if (color.indexOf('rgba') === -1)
		color += ',1'; 
	return color.match(/[\.\d]+/g).map(function (a) {
		return +a
	});
}
</script>