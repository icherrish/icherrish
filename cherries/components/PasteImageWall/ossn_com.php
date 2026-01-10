<?php
/**
 * Open Source Social Network
 *
 * @package   Premium Social Network
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   OPENTEKNIK LLC, COMMERCIAL LICENSE v1.0 https://www.openteknik.com/license/commercial-license-v1
 * @link      https://www.openteknik.com
 */

ossn_register_callback('ossn', 'init', function(){
			ossn_extend_view('js/ossn.site', 'paste_image_wall/js');		

});