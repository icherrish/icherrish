<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Ads Inserter
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
echo ossn_view_form('administrator/settings', array(
    'action' => ossn_site_url() . 'action/AdsInserter/admin/settings',
    'component' => 'AdsInserter',
    'class' => 'ossn-admin-form'	
), false);