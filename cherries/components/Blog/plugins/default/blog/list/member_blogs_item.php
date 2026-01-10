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
<div class="row blog-item">
	<div class="col-md-12">
		<a href="<?php echo $params['item']->profileURL();?>"><?php echo $params['item']->title;?>&nbsp;&nbsp;<i style="font-weight:normal; font-size:smaller"><?php echo ossn_print('com:blog:blog:edit:timestamp' , array(date(ossn_print('com:blog:blog:edit:timestamp:format'), $params['item']->time_updated))); ?></i></a> 
	</div>
</div>