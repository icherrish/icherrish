/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Content Sharing
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
//<script>
function contentSharingSaveVisitedURL(url) {
	Ossn.PostRequest({
		url: Ossn.site_url + 'shared_content/request/join/communitiy',
		params: 'redirection_url=' + url,
		beforeSend: function() {
		},
		callback: function(callback) {
			window.open(Ossn.site_url, '_blank');
		},
	});
}
