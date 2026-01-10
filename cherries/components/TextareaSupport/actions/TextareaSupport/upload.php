<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Textarea Support
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
$user = ossn_loggedin_user();

if ($user) {
	$album = new OssnObject();
	// check if album for tinyMCE pics already exists?
	$search = array(
		'owner_guid' => $user->guid,
		'type' => 'user',
		'subtype' => 'ossn:album',
		'description' => '__tinyMCE__'
	);
	$found_album = $album->searchObject($search);
	if ($found_album) {
		$album_id = $found_album[0]->guid;
	} else {
		// no, so create it!
		$album->owner_guid   = $user->guid;
		$album->type         = 'user';
		$album->subtype      = 'ossn:album';
		$album->data->access = OSSN_PUBLIC;
		$album->title        = ossn_print('com:textareasupport:storage:album:title');
		$album->description	 = '__tinyMCE__';
		if ($album->addObject()) {
			$album_id = $album->getObjectId();
		} else {
			echo json_encode(array(
				"success" => 0,
				"path" => ossn_print('com:textareasupport:storage:album:error:not:available')
			));
			exit;
		}
	}
	// add the photo to the 'Editor' album
	$photo = new OssnPhotos();
	$entity_id = $photo->AddPhoto($album_id, 'file', OSSN_PUBLIC);
	if ($entity_id) {
		// retrieve the filename
		$entity = new OssnEntities();
		$entity->entity_guid = $entity_id;
		$found_entity = $entity->get_entity();
		if ($found_entity) {
			$path = $found_entity->value;
			//$path = str_replace('photos', 'getphoto/' . $found_entity->owner_guid, $path); old 6.1 mechanism via object guid
			$path = str_replace('photos', 'getphoto/' . $found_entity->guid, $path);
			echo json_encode(array(
				"success" => 1,
				"path" => $path
			));
			exit;
		}
	} else {
		echo json_encode(array(
			"success" => 0,
			"path" => ossn_print('com:textareasupport:storage:album:error:upload:failure')
		));
		exit;
	}

} else {
	echo json_encode(array(
		"success" => 0,
		"path" => ossn_print('com:textareasupport:storage:album:error:access:denied')
	));
	exit;
}