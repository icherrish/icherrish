<?php
/**
 * helpers/note.php
 * 🇳🇱 Zet een Fediverse Note-URL om naar een OSSN-postlink
 * 🇬🇧 Converts a Fediverse note URL to an OSSN post URL
 *
 * Door Eric Redegeld – nlsociaal.nl
 */

/**
 * Geeft de originele OSSN contentsharing link terug
 * ➤ /shared_content/post/{guid}/{timestamp}
 * Alleen als ContentSharing actief is
 *
 * @param string $note_url Volledige federatieve Note-URL
 * @return string|null OSSN content link of null
 */
function fediversebridge_note_to_original_url($note_url) {
	$parsed = parse_url($note_url);
	if (!isset($parsed['path'])) {
		return null;
	}

	// Match: /fediverse/note/username/guid
	if (!preg_match('#/fediverse/note/([^/]+)/([0-9]+)#', $parsed['path'], $matches)) {
		return null;
	}
	$guid = (int)$matches[2];

	// ✅ Check of post bestaat
	if (!function_exists('ossn_is_component_active') || !ossn_is_component_active('ContentSharing')) {
		return null;
	}
	$post = ossn_get_object($guid);
	if (!$post || $post->type !== 'user' || $post->subtype !== 'wall') {
		return null;
	}

	$timestamp = strtotime($post->time_created);
	if (!$timestamp) {
		$timestamp = time();
	}
	return ossn_site_url("shared_content/post/{$guid}/{$timestamp}");
}

/**
 * Eenvoudige publieke OSSN-link naar wall post
 * ➤ /post/view/{guid}
 *
 * @param int $guid Post GUID
 * @return string Publieke URL van de post
 */
function fediversebridge_note_to_public_post_url($guid) {
	if (!$guid || !is_numeric($guid)) {
		return '#';
	}
	return ossn_site_url("post/view/{$guid}");
}

/**
 * Haalt de numerieke GUID uit een federatieve Note-URL
 * ➤ https://.../fediverse/note/{username}/{guid}
 *
 * @param string $note_url
 * @return int|null
 */
function fediversebridge_extract_guid_from_note_url($note_url) {
	$parsed = parse_url($note_url);
	if (!isset($parsed['path'])) {
		return null;
	}
	if (preg_match('#/fediverse/note/[^/]+/([0-9]+)#', $parsed['path'], $matches)) {
		return (int)$matches[1];
	}
	return null;
}
