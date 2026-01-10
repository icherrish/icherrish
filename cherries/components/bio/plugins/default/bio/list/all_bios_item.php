<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   bio
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$fullname = $params['item']->first_name . ' ' . $params['item']->last_name;
if (com_is_active('DisplayUsername')) {
	$fullname = $params['item']->username;
}
?>
<div class="row">
	<div class="col-md-12">
		<a href="<?php echo 'u/' . $params['item']->username . '/bio';?>"><?php echo $fullname;?></a>
	</div>
</div>