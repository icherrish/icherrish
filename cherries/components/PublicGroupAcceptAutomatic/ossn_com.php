<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author     OSSN Core Team <contact@arsalanshah.com>
 * @copyright (c) Engr. Arsalan Shah
 * @license   OPEN SOURCE SOCIAL NETWORK LICENSE 4.0
 * @link      https://www.opensource-socialnetwork.org/
 */

function automatic_public_groups_accept_init(){
		ossn_register_callback('group', 'send:request', 'automatic_public_groups_accept');
}
function automatic_public_groups_accept($callback, $type, $params){
		if(isset($params['user_guid'])){
				$group = new OssnGroup();
				$object = ossn_get_group_by_guid($params['group_guid']);
				
				if($object && $object->membership == OSSN_PUBLIC && $group->requestExists($params['user_guid'], $params['group_guid'])){
						$group->approveRequest($params['user_guid'], $params['group_guid']);
				}
		}
}
ossn_register_callback('ossn', 'init', 'automatic_public_groups_accept_init');