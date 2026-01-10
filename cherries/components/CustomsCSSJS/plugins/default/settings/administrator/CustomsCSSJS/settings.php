<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Customs CSS/JS
 * @author    Hugo Cuellar <https://www.opensource-socialnetwork.org/u/Erassus>
 * @copyright (C) Hugo Cuellar
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

echo ossn_view_form('edit', array(
    'action' => ossn_site_url() . 'action/cssjs/edit',
    'component' => 'CustomsCSSJS',
    'class' => 'cssjs-form',
), false);
?>
