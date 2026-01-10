<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Content Sharing
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

if (!ossn_is_xhr()) {
    redirect(REF);
} 
$preview_file = ossn_get_userdata('components/ContentSharing/previews/_shared_content_' . str_replace('/', '_', input('content_str')) . '.png');
if ( isset($_FILES['content_img']) and !$_FILES['content_img']['error'] ) {
	file_put_contents($preview_file, file_get_contents($_FILES['content_img']['tmp_name']));
	$msg = 'com_content_sharing:link:copied';
	$err = '';
} else {
	copy(ossn_route()->com . 'ContentSharing/images/noimage.png', $preview_file);
	$msg = 'com_content_sharing:preview:imgage:failed';
	$err = 'com_content_sharing:file:copy:failed';
}
header('Content-Type: application/json');
echo json_encode(array(
	'msg' => $msg,
	'err' => $err
));
exit;