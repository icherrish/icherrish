/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Content Sharing
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
//<script>

$(document).ready(function() {
    $('.post-control-sharepostlink, .entity-menu-extra-sharepostlink').off('click').on('click', function(e) {
		contentSharingCopyLink(e, $(this)[0].href);
    });
});

$(document).ajaxComplete(function(event, xhr, settings) {
	substrings = ['/action/wall/post/a', '/action/wall/post/u', '/action/wall/post/g', '/action/wall/post/embed', '?offset='];
	if (substrings.some(substrings=>settings.url.includes(substrings))) {
		$('.post-control-sharepostlink, .entity-menu-extra-sharepostlink').off('click').on('click', function(e){
			contentSharingCopyLink(e, $(this)[0].href);
		});
	}
});

function contentSharingCopyLink(e, url) {
    e.preventDefault();
	
	// exclude some nodes on preview image
	contentSharingHideNodes();

	// copy to clipboard
	const el = document.createElement('textarea');
	el.value = url;
	el.setAttribute('readonly', '');
	el.style.position = 'absolute';
	el.style.left = '-9999px';
	document.body.appendChild(el);
	el.select();
	document.execCommand('copy');
	document.body.removeChild(el);

	// sharing url
	var path_elements = url.split('/');
	var path_length = path_elements.length;
	var content_type = path_elements[path_length - 3];
	var content_guid = path_elements[path_length - 2];
	var content_created = path_elements[path_length - 1];
	
	if (content_type == 'photo' || content_type == 'profilecover' || content_type == 'profilephoto') {
		// no previews needed, facebook will take the original photos
		contentSharingMessageBox('com_content_sharing:link:copied');
	} else {
		// render preview dependent on type
		switch(content_type) {
			case 'post':
				var selector = '#activity-item-' + content_guid;
				var cloned_post = $(selector).clone();
				selector = '.content_sharing_cloned_post';
				/* */
				var iframe = $(cloned_post).find('iframe:first');
				if (iframe.length) {
					// found iframe! 
					var iframe_src = iframe.attr('src');
					// console.log('1', iframe_src.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/));
					// console.log('2', iframe_src.match(/youtube\.com.*(\?v=|\/embed\/)/));
					// console.log('3', iframe_src.match(/youtube\.com.*(\?v=|\/embed\/)(.*)/));

					console.log('4', iframe_src.match(/player\.vimeo\.com.*(\?v=|\/video\/)(.*)/));


					var embed_url = iframe_src.match(/youtube\.com.*(\?v=|\/embed\/)(.*)/);
					// if there's a youtube video inside replace iframe by preview image provided by youtube 
					if (embed_url) {
						var video_thumbnail = $('<img src="//img.youtube.com/vi/'+embed_url.pop()+'/0.jpg" style="max-width:560px; width:560px; height:420px">');
						$(video_thumbnail).insertBefore(iframe.parent());
					}

					embed_url = iframe_src.match(/player\.vimeo\.com.*(\?v=|\/video\/)(.*)/);
					// if there's a youtube video inside replace iframe by preview image provided by youtube 
					if (embed_url) {
						console.log('pop', '<img src="//vumbnail.com/'+embed_url.pop()+'.jpg" style="max-width:560px; width:560px; height:420px">');
						var video_thumbnail = $('<img src="//vumbnail.com/'+embed_url.pop()+'.jpg" style="max-width:560px; width:560px; height:420px">');
						$(video_thumbnail).insertBefore(iframe.parent());
					} else {
						// this iframe doesn't include a youtube video
						// what is it? needs further processing ... 
					}
					// since having 1 preview image is sufficient, search for further iframes and delete them
					$(cloned_post).find('.ossn_embed_video').remove();
				}
				
				$(cloned_post).find('.comments-likes').remove();
				$(cloned_post).find('.meta').remove();
				// pass clone to html2canvas instead of orginal post
				$('body').append('<div class="content_sharing_cloned_post">');
				$('.content_sharing_cloned_post').append(cloned_post);
				/* */
			break;
			case 'blog':
				var selector = '.blog';
				var cloned_post = $(selector).clone();
				selector = '.content_sharing_cloned_post';
				var iframe = $(cloned_post).find('iframe:first');
				if (iframe.length) {
					var iframe_src = iframe.attr('src');
					if (iframe_src.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/)) {
						var youtube_video_id = iframe_src.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/).pop();
						if (youtube_video_id.length == 11) {
							var video_thumbnail = $('<img src="//img.youtube.com/vi/'+youtube_video_id+'/0.jpg" style="max-width:560px; width:560px; height:420px">');
							$(video_thumbnail).insertBefore(iframe.parent().parent());
						}
					} else {
					}
					$(cloned_post).find('.textarea-support-responsive-video-default-width').remove();
				}
				$(cloned_post).find('.blog-list-sort-option').remove();
				$(cloned_post).find('.comments-likes').remove();
				$(cloned_post).find('.meta').remove();
				$('body').append('<div class="content_sharing_cloned_post">');
				$('.content_sharing_cloned_post').append(cloned_post);
			break;
			case 'poll':
				// poll on poll's page ?
				var guid = content_guid;
				var selector = '.ossn-poll-main';
				if (! $(selector).length) {
					// no, poll on wall
					guid++;
					selector = '#activity-item-' + guid;
				}
				var cloned_post = $(selector).clone();
				selector = '.content_sharing_cloned_post';
				$(cloned_post).find('.comments-likes').remove();
				$(cloned_post).find('.meta').remove();
				$(cloned_post).find('.panel-footer').remove();
				$('body').append('<div class="content_sharing_cloned_post">');
				$('.content_sharing_cloned_post').append(cloned_post);
			break;
		}

		/* */
		var scroll_top = $(window).scrollTop();
		html2canvas(document.querySelector(selector), {
			scrollY: -scroll_top,
			proxy: 'https://api.codetabs.com/v1/proxy?quest=',
			width: 1200,
			height: 630,
			onclone: function (clone) {
				/**/
			}
		}).then(canvas => {
			var base64image = canvas.toDataURL("image/png");
			var blob = contentSharingDataURLtoBlob(base64image);
			var formData = new FormData();
			formData.append('content_img', blob);
			formData.append('content_str', content_type + '/' + content_guid + '/' + content_created);
			var upload_url = Ossn.AddTokenToUrl(Ossn.site_url + 'action/ContentSharing/html2png');
			$.ajax({
				async: true,
				cache: false,
				contentType: false,
				type: 'post',
				url: upload_url,
				data: formData,
				processData: false,
				success: function (callback) {
					contentSharingMessageBox(callback['msg'], callback['err']);
				},
				error: function () {
					contentSharingMessageBox(callback['msg'], callback['err']);
				}
			});
		}).catch(function(error) {
			contentSharingMessageBox('com_content_sharing:preview:imgage:failed', error);
		});
		/* */
	}
}

function contentSharingDataURLtoBlob(dataURL) {
	var binary = atob(dataURL.split(',')[1]);
	var array = [];
	for (var i = 0; i < binary.length; i++) {
		array.push(binary.charCodeAt(i));
	}
	return new Blob([new Uint8Array(array)], {type: 'image/png'});
}

function contentSharingHideNodes() {
	$('.ossn-page-loading-annimation').show();
}

function contentSharingUnhideHiddenNodes() {
	$('.content_sharing_cloned_post').remove();
	Ossn.MessageBoxClose();
}

contentSharingMessageBox = function(msg, err = '') {
	Ossn.PostRequest({
		url: Ossn.site_url + 'shared_content/msg/box/dialog',
		params: 'msg=' + msg + '&err=' + err,
		beforeSend: function() {
			$('.ossn-page-loading-annimation').hide();
			$('.ossn-halt').addClass('ossn-light');
			$('.ossn-halt').attr('style', 'height:' + $(document).height() + 'px;');
			$('.ossn-halt').show();
			$('.ossn-message-box').html('<div class="ossn-loading ossn-box-loading"></div>');
			$('.ossn-message-box').fadeIn('slow');
		},
		callback: function(callback) {
			$('.ossn-message-box').html(callback).fadeIn();
		},
	});
};
