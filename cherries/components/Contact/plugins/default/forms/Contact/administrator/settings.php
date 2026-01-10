<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team | Sathish Kumar <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED, 2014 webbehinds
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
if (isset($params['settings']->email)) {
	$email = $params['settings']->email;
} else {
	$email = '';
}
if (isset($params['settings']->map)) {
	$map = $params['settings']->map;
} else {
	$map = '';
}

?>
<br>
<label><?php echo ossn_print('contact:admin:form:label:contactform:receiver'); ?></label>
<input type="text" name="email" value="<?php echo $email;?>"/>
<br>
<label><?php echo ossn_print('contact:admin:form:label:contactform:top:html'); ?></label>
<textarea name="map"><?php echo $map;?></textarea>
<br>
<input type="submit" class="ossn-admin-button btn btn-success" value="<?php echo ossn_print('contact:admin:form:button:save'); ?>"/>






