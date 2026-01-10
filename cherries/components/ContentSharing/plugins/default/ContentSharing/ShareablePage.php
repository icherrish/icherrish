<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Content Sharing
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$sitename = ossn_site_settings('site_name');
$sitelanguage = ossn_site_settings('language');
if (isset($params['title'])) {
    $title = $params['title'] . ' : ' . $sitename;
} else {
    $title = $sitename;
}
if (isset($params['contents'])) {
    $contents = $params['contents'];
} else {
    $contents = '';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $sitelanguage; ?>">
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php
ossn_unload_external_js('tinymce.min');
echo ossn_fetch_extend_views('ossn/site/head');
?>

<meta property="fb:app_id" content="966242223397117" />
<meta property="og:type" content="article">
<?php if (isset($params['og_url'])) { ?>
<meta property="og:url" content="<?php echo $params['og_url']; ?>" />
<?php } ?>
<?php if (isset($params['og_title'])) { ?>
<meta property="og:title" content="<?php echo $params['og_title']; ?>" />
<?php } ?>
<?php if (isset($params['og_image'])) { ?>
<meta property="og:image" content="<?php echo $params['og_image']; ?>" />
<?php } ?>
<?php if (isset($params['og_description'])) { ?>
<meta property="og:description" content="<?php echo $params['og_description']; ?>" />
<?php } ?>
<script>
    <?php echo ossn_fetch_extend_views('ossn/js/head'); ?>
	document.addEventListener('DOMContentLoaded', function() {
		$('.meta, .comments-likes').find('a').removeAttr('href');
		$('.ossn-wall-post-time').removeAttr('onclick');
	});
</script>

<link rel="stylesheet" type="text/css" href="<?php echo ossn_site_url('shared_content/css/default/shared_content.css'); ?>" />
</head>

<body>
	<div class="opensource-socalnetwork">
		<div class="ossn-page-container">
			<div class="ossn-inner-page">
				<?php echo $contents; ?>
				<div class="content-sharing-join-button">
					<a href="javascript:void(0);" onClick="contentSharingSaveVisitedURL('<?php echo $params['visited_url']; ?>');"
					class='btn btn-success'><?php echo ossn_print('com_content_sharing:join:button', array($sitename)); ?></a>
				</div>
			</div>
		</div>
    </div>
</body>
</html>
