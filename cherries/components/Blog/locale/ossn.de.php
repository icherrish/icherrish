<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

ossn_register_languages('de', array(
	'blog' => 'Blog',
	'blogs' => 'Blogs',
	'com:blog:blog:share:button' => 'Teilen',
	'com:blog:blog:share:link:copied' => "Der Link zum Blog wurde in die Zwischenablage kopiert",
	'com:blog:blog:add' => 'Blog erstellen',
	'com:blog:blog:add:failed' => 'Blog konnte nicht erstellt werden.',
	'com:blog:blog:added' => 'Blog erfolgreich erstellt.',
	
	'com:blog:blog:contents' => 'Blog Inhalt',
	'com:blog:blog:title' => 'Blog Titel',
	'com:blog:blog:title:warning' => 'Pflichtfeld - bitte wähle einen sinnvollen Titel',
	'com:blog:blog:edit' => 'Blog editieren',
	'com:blog:blog:edit:timestamp' => 'zuletzt geändert: %s',
	'com:blog:blog:edit:timestamp:format' => 'd.m.Y H:i', // diese Formatierung ergibt einen Zeitstempel wie '31.03.2019 16:45', auf http://php.net/manual/de/function.date.php finden sich alle verfügbaren Formatierungs-Platzhalter
	
	'com:blog:blog:edit:failed' => 'Änderung konnte nicht gespeichert werden',
	'com:blog:blog:edited' => 'Die Änderung wurde gespeichert',

	'com:blog:dialog:confirm:delete' => 'Bist Du sicher, dass Du diesen Blog löschen möchtest?',
	'com:blog:blog:deleted' => 'Der Blog wurde gelöscht',
	'com:blog:blog:delete:failed' => 'Der Blog konnte nicht gelöscht werden',

	'com:blog:blog:my' => 'Meine Blogs',
	'com:blog:blog:all' => 'Alle Blogs',
	
	'com:blog:list:sort:by:date' => 'nach Datum sortieren',
	'com:blog:list:sort:by:date:page:header' => 'Alle Blogs - nach Datum sortiert',

	'com:blog:list:sort:by:member' => 'nach Mitgliedern sortieren',
	'com:blog:list:sort:by:member:page:header' => 'Alle Blogs - nach Mitgliedern sortiert',
	
	'com:blog:list:member:page:header' => 'Blogs von %s',
	'com:blog:list:by:author:' => 'von %s',
	
	'com:blog:wall:post:subject' => 'hat einen Blog erstellt', 
	'com:blog:wall:post:view:complete' => 'kompletten Blog ansehen',
	
	'com:blog:search:result' => "es wurden %s Blogs gefunden, die '%s' enthalten",
	'com:blog:search:result:total' => 'insgesamt wurden %s Blogs gefunden',
	'com:blog:search:noresult' => "es wurden keine Blogs gefunden, die '%s' enthalten",
	
	'ossn:notifications:like:entity:blog' => '%s hat auf den Blog <b>%s</b> reagiert',
	'ossn:notifications:comments:entity:blog' => '%s hat den Blog <b>%s</b> kommentiert',

	'ossngadget:site:latestblogs' => 'Neuste Blogs',
));
