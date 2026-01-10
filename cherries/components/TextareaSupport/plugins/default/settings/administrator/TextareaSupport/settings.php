<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Textarea Support
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
echo ossn_view_form('administrator/settings', array(
	'action' => ossn_site_url() . 'action/admin/textarea_support/settings',
	'component' => 'TextareaSupport',
	'params' => $params,
	'class' => 'ossn-admin-form'
), false);
