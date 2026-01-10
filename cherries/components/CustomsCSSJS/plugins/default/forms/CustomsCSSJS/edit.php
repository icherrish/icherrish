<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Customs CSS/JS
 * @author    Hugo Cuellar <https://www.opensource-socialnetwork.org/u/Erassus>
 * @copyright (C) Hugo Cuellar
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$params = cssjs('form');

?>
<label><h3><?php echo ossn_print('com:customs:cssjs:backend:title'); ?></h3></label>
<br/>

<label><h5><?php echo ossn_print('com:customs:css'); ?></h5></label>
<textarea class="pre" name="backend_css"><?php echo $params['backend_css'];?></textarea>
<br/>
<label><h5><?php echo ossn_print('com:customs:js'); ?></h5></label>
<textarea class="pre" name="backend_js"><?php echo $params['backend_js'];?></textarea>
<br/>
<hr>

<label><h3><?php echo ossn_print('com:customs:cssjs:frontend:title'); ?></h3></label>
<br/>
<label><h5><?php echo ossn_print('com:customs:css'); ?></h5></label>
<textarea class="pre" name="frontend_css"><?php echo $params['frontend_css'];?></textarea>
<br/>
<label><h5><?php echo ossn_print('com:customs:js'); ?></h5></label>
<textarea class="pre" name="frontend_js"><?php echo $params['frontend_js'];?></textarea>
<br/>
<hr>

<br/>
<input type="submit" class="btn btn-primary" value="<?php echo ossn_print('save'); ?>"/>
