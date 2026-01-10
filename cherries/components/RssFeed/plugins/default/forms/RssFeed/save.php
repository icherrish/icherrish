<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 
$component = new OssnComponents;
$settings = $component->getComSettings('RssFeed');
?>

<label><?php echo ossn_print('com_rssfeed:admin:settings:mobile_rssbar:title');?></label>
<?php echo ossn_print('com_rssfeed:admin:settings:mobile_rssbar:note');?>
<select name="mobile_rssbar">
 	<?php
	$mobile_rssbar_off = '';
	$mobile_rssbar_on = '';
	if($settings && $settings->mobile_rssbar == 'on'){
		$mobile_rssbar_on = 'selected';
	} else {
		$mobile_rssbar_off = 'selected';
	}
	?>
	<option value="off" <?php echo $mobile_rssbar_off;?>><?php echo ossn_print('ossn:admin:settings:off');?></option>
	<option value="on" <?php echo $mobile_rssbar_on;?>><?php echo ossn_print('ossn:admin:settings:on');?></option>
</select>
<br />
 <div>
	<label><?php echo ossn_print('com_rssfeed:entertext'); ?></label>
	<input type="text" name="rss" value="<?php echo $settings->rss_html;?>"></input>	
 </div>
<br />
 <div>
 	<input type="submit" value="<?php echo ossn_print('com_rssfeed:save'); ?>" class="btn btn-success"/>
 </div>   
