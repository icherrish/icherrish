/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$(document).ready(function() {
	$('#BlogDeleteButton').on('click', function(e) {
		e.preventDefault();
		var del = confirm(Ossn.Print('com:blog:dialog:confirm:delete'));
		if(del == true){
			var actionurl = $(this).attr('href');
			window.location = actionurl;
		}
	});
});
