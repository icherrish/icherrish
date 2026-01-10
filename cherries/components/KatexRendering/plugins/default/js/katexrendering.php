/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   KaTeX Rendering
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$(document).ready(function() {
	// render all formulas on page loading
	renderMathInElement(document.body, {
		// macros: {'\\green': '\\text{red}\\,'}
	});
	
	// render newly inserted/edited posts and comments
	$(document).ajaxComplete(function(event, xhr, settings) {
		var substrings = ['/action/wall/post/a', '/action/wall/post/u', '/action/wall/post/g', '/action/wall/post/embed'];

		if (substrings.some(substrings=>settings.url.includes(substrings))) {
			var postId = '#' + xhr.responseText.split('id=\\"')[1].split('\\"')[0];
			var post   = $(postId).find('.post-contents')[0];
			renderMathInElement(post);
		}

		substrings = ['/action/post/comment', '/action/post/entity/comment', '/action/comment/embed'];
		if (substrings.some(substrings=>settings.url.includes(substrings))) {
			var commentId = '#' + xhr.responseText.split('id=\\"')[1].split('\\"')[0];
			var comment   = $(commentId).find('.comment-text')[0];
			renderMathInElement(comment);
		}

		substrings = ['?offset='];
		if (substrings.some(substrings=>settings.url.includes(substrings))) {
			var newsfeed = $('.user-activity')[0];
			renderMathInElement(newsfeed, {ignoredClasses: ['katex']}); 
		}

	});

});

// render formulas in editor preview window
$(window).on('load', function (we) {
	setTimeout(function() {
		if (tinymce && tinymce.editors.length) {
			tinymce.editors[0].on('ExecCommand', function (e) {
				if (e.command == 'mcePreview') {
					setTimeout(function() {
						var preview_iframe_body = $('.tox-navobj').first().contents().first().next()[0].contentDocument.body;
						renderMathInElement(preview_iframe_body);
					}, 100);
				}
			});
		}
	}, 0);
});
