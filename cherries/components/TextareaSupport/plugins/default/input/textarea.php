<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Textarea Support
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$class = 'ossn-textarea-input';
if (isset($params['class'])) {
	$class = $class .' '. $params['class'];
}
$value = (isset($params['value'])) ? $params['value'] : '';
unset ($params['value']);

$defaults = array(
	'disabled' => false,
	'class' => $class,
);
$params = array_merge($defaults, $params);
$attributes = ossn_args($params);
if (strpos ($class , 'ossn-editor') !== false) {
	if (com_is_active('KatexRendering')) {
		$katexIsActive = true;
	} else {
		$katexIsActive = false;
	}	
?>
	<script>
	
	// init TinyMCE and add emoji button to pop up OssnSmilies selector
	$(document).ready(function() {
		var katexIsActive = '<?php echo $katexIsActive; ?>';
		var editor_skin = 'oxide';
		var editor_css  = Ossn.site_url + 'css/view/bootstrap.min.css,' + Ossn.site_url + '/css/view/ossn.default.css';
		if (katexIsActive) {
			editor_css = editor_css + ', //cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css';
		}
		var fg_str = $('.ossn-form textarea').css('color');
		if (typeof fg_str != 'undefined') {
			var fg_rgb_array = comTextareaSupportToRGB(fg_str);
			if ((fg_rgb_array[0] > 130 && fg_rgb_array[1] > 130 && fg_rgb_array[2] > 130) || (fg_rgb_array[0] + fg_rgb_array[1] + fg_rgb_array[2] >= 390)) {
				editor_skin = 'oxide-dark';
				editor_css  = editor_css + ', dark';
			}
		}
		
		if ((typeof tinymce !== 'undefined') ) {
			if (typeof tinymce.settings.toolbar == 'undefined') {
				tinymce.init({
					toolbar: "bold italic underline alignleft aligncenter alignright bullist numlist image media link unlink emoticons autoresize fullscreen insertdatetime print spellchecker preview",
					selector: '.ossn-editor',
					convert_urls: false,
					relative_urls: false,
					skin: editor_skin,
					content_css: editor_css,
					language: "<?php echo ossn_site_settings('language'); ?>",
					<?php if (com_is_active('OssnSmilies')) { ?>
					plugins: "table lists code image media link fullscreen insertdatetime print spellchecker preview",
					setup: function(editor) {
						editor.ui.registry.addButton('emoticons', {
							icon: 'emoji',
							tooltip: 'Emojis',
								onAction: function (_) {
								Ossn.OpenEmojiBox('.ossn-editor');
							}
						});
						editor.on('paste', function (e) {
							var imageBlob = retrieveImageFromClipboardAsBlob(e);
							if (!imageBlob) {
								return;
							}
							e.preventDefault();
							var formData = new FormData();
							formData.append('file', imageBlob);
							formData.append('ossn_ts', Ossn.Config.token.ossn_ts);
							formData.append('ossn_token', Ossn.Config.token.ossn_token);
							var url = Ossn.site_url + 'action/TextareaSupport/upload';
							$.ajax({
								url: url,
								type: 'POST',
								data: formData,
								async: true,
								cache: false,
								contentType: false,
								processData: false,
								error: function(xhr, status, error) {
									if (error == 'Internal Server Error' || error !== '') {
										Ossn.MessageBox('syserror/unknown');
									}
								},
								success: function(callback) {
									json = JSON.parse(callback);
									if (json.success == 1) {
										// insert image url directly in TinyMCE window
										editor.insertContent('<img src="' + Ossn.site_url + json.path + '" />');
									} else {
										// show error in message box
										Ossn.MessageBox(json.path);
									}
								}
							});
							// prevent Tiny from inserting image blobs
							return false;
						});
					},
					<?php } else { ?>
					plugins: "table lists code image media link fullscreen insertdatetime print spellchecker preview emoticons",
					<?php } ?>

					images_upload_handler: function (blobInfo, success, failure) {
						var formData = new FormData();
						formData.append('file', blobInfo.blob(), blobInfo.filename());
						formData.append('ossn_ts', Ossn.Config.token.ossn_ts);
						formData.append('ossn_token', Ossn.Config.token.ossn_token);
						var url = Ossn.site_url + 'action/TextareaSupport/upload';
						$.ajax({
							url: url,
							type: 'POST',
							data: formData,
							async: true,
							cache: false,
							contentType: false,
							processData: false,
							error: function(xhr, status, error) {
								if (error == 'Internal Server Error' || error !== '') {
									Ossn.MessageBox('syserror/unknown');
								}
							},
							success: function(callback) {
								json = JSON.parse(callback);
								if (json.success == 1) {
									// return image url back to TinyMCE Insert/Image window
									success(Ossn.site_url + json.path);
								} else {
									// this will close TinyMCE Insert/Image window and display action error instead
									failure(json.path);
								}
							}
						});
						return false;
					}
				});
			}
			tinymce.settings['content_css'] = Ossn.site_url + 'css/view/bootstrap.min.cs';
			tinymce.settings['invalid_elements'] = 'script';
			<?php
			$OssnComponents = new OssnComponents;
			$settings = $OssnComponents->getSettings('TextareaSupport');
			if ($settings && $settings->scripting_and_svg == 'on') { ?>
				tinymce.settings['invalid_elements'] = '';
				tinymce.settings['extended_valid_elements'] = 'script[language|type|src],svg[*],defs[*],pattern[*],desc[*],metadata[*],g[*],mask[*],path[*],line[*],marker[*],rect[*],circle[*],ellipse[*],polygon[*],polyline[*],linearGradient[*],radialGradient[*],stop[*],image[*],view[*],text[*],textPath[*],title[*],tspan[*],glyph[*],symbol[*],switch[*],use[*]';
				tinymce.settings['non_empty_elements'] = 'td,th,iframe,video,audio,object,script,pre,code,area,base,basefont,br,col,frame,hr,img,input,isindex,link,meta,param,embed,source,wbr,track,svg,defs,pattern,desc,metadata,g,mask,path,line,marker,rect,circle,ellipse,polygon,polyline,linearGradient,radialGradient,stop,image,view,text,textPath,title,tspan,glyph,symbol,switch,use';
			<?php } ?>
		} else {
			// tinymce not? or too late? initialized
			// reported to happen on Chromebooks with Chromium 
			var field_name = $('.ossn-editor')[0].name;
			var msg = Ossn.Print('com:textareasupport:incompatible:msg', [field_name]);
			alert(msg);
			$('.ossn-editor').hide();
		}
	});

function retrieveImageFromClipboardAsBlob(pasteEvent)
{
	if (pasteEvent.clipboardData === false) {
		return false;
	}

	var items = pasteEvent.clipboardData.items;

	if (items === undefined) {
		return false;
	}

	for (var i = 0; i < items.length; i++) {
		// Only paste if image is only choice
		if (items[i].type.indexOf("image") === -1) {
			return false;
		}
		// Retrieve image on clipboard as blob
		var blob = items[i].getAsFile();

		// load image if there is a pasted image
		if (blob !== null) {
			const reader = new FileReader();
			reader.onload = function(e) {
				// console.log('result', e.target.result);
			};
			reader.readAsDataURL(blob);
			return blob;
		}
	}
	return false;
}

	</script>
<?php
}

echo "<textarea {$attributes}>{$value}</textarea>";