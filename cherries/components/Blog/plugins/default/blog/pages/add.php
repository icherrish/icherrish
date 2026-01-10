<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div class="gbg-11or12-column col-md-11">
	<div class="ossn-page-contents">
		<div class="blog">
			<?php
			echo ossn_view_form('blog/add', array(
				'action' => ossn_site_url() . 'action/blog/add',
			));
			?>
		</div>
	</div>
</div>