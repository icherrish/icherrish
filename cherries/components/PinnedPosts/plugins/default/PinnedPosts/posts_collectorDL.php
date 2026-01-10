<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Pinned Posts
 * @author    Michael Zülsdorff <ossn@z-mans.net>, Dominik Lieger
 * @copyright (C) Michael Zülsdorff, Dominik Lieger
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$pinned_posts = '';

if (isset($params["pinnedposts"]) && isset($params["pinnedposts"]->PinnedPosts)) {
	// separate the ids of the posts to be pinned
	$pinned_post_ids = explode(',', $params["pinnedposts"]->PinnedPosts);
	if (count($pinned_post_ids)) {
		// yep, we got one or more post ids !
		if (!isset($params["pinnedposts"]->DisplayComments) || (isset($params["pinnedposts"]->DisplayComments) && $params["pinnedposts"]->DisplayComments == '')) {
			// 'Display comments and allow commenting' in Configure->PinnedPosts is unchecked, so
			// 1. don't display comments
			ossn_unset_hook('post', 'comments', 'ossn_post_comments');
			ossn_unset_hook('post', 'comments:entity', 'ossn_post_comments_entity');
			// 2. remove the 'Like Comment View all comments etc' menu line
			ossn_add_hook('wall', 'post:menu', 'com_pinned_posts_remove_postextra_menu_links');
			ossn_register_callback('comment', 'entityextra:menu', 'com_pinned_posts_remove_entityextra_menu_links');
			// 3. remove the reactions line
			ossn_unset_hook('post', 'likes', 'ossn_post_likes');
			ossn_unset_hook('post', 'likes:entity', 'ossn_post_likes_entity');
			ossn_add_hook('post', 'likes:object', 'ossn_post_likes_object');
		}
		// 7.2dev2 new feature
		// add 'unpin' entries to the pinned post's menus
		ossn_add_hook('wall', 'post:menu', 'com_pinned_posts_create_wall_post_menu_unpin_entry');

		$wall  = new OssnWall();
		foreach ($pinned_post_ids as $pinned_post_id) {
			// loop through the ids and fetch the associated posts one by one
			$post  = $wall->GetPost($pinned_post_id);
			if (!$post) {
				// oops, that post must have been deleted in the meantime
				continue;
			}
			if ($post->type != 'user') {
				// data record exists, but is of wrong type
				continue;
			}
			if ($post->subtype == 'wall') {
				// correct record!
				// so pass it over to OssnWall's functions to retrieve the complete post's html, user image and stuff
				$params['post'] = $post;
				// 7.2.dev2 fix:
				$orig_post_duplicate = ossn_wall_view_template(ossn_wallpost_to_item($params['post']));
                    // embed it in an extra div with a toggle button
                    $pinned_post = '
                        <div class="pinned-post" data-post-id="' . $pinned_post_id . '">
                            <button class="btn btn-sm btn-link toggle-pinned-posts"></button>
                            <div class="pinned-post-content">' . $orig_post_duplicate . '</div>
                        </div>';
				// and add this post to already processed ones
				$pinned_posts = $pinned_posts  . $pinned_post;
			}
		}
		// done!
		// finally embed the collected posts inside of a wrapper with the configured background-color
		// 7.2dev3 fix:
		// in case of a first time installation without visiting and saving settings in Configure->PinnenPosts
		// the background color is still unset!
		// so use default color cyan (= bootstrap-color 'info'!
		$background_color = 'info';
		if (isset($params["pinnedposts"]->Background)) {
			$background_color = $params["pinnedposts"]->Background;
		}
		echo '<div class="pinnedposts"> <div class="alert alert-' . $background_color . '"> <strong>'.ossn_print('com:pinned:posts:title').'</strong> '. $pinned_posts.' </div> </div>';
	}
}
?>

<script>
// 7.3dev1 new un-/collapse feature by Dominik Lieger
$(document).ready(function(){
    // Funktion zum Ein-/Ausklappen der angepinnten Beiträge
    $('.toggle-pinned-posts').on('click', function() {
        var content = $(this).siblings('.pinned-post-content');
        content.toggle();
        var postID = $(this).closest('.pinned-post').data('post-id');
        var isCollapsed = !content.is(':visible');
        localStorage.setItem('pinned-post-' + postID + '-collapsed', isCollapsed);  // Speichere den Zustand im LocalStorage
		// und passe die Link-Texte entsprechend an
		if (isCollapsed) {
			$(this).closest('.pinned-post').children(':first')[0].innerText = Ossn.Print('com:pinned:posts:uncollapse:post');
		} else {
			$(this).closest('.pinned-post').children(':first')[0].innerText = Ossn.Print('com:pinned:posts:collapse:post');
		}
    });

    // Überprüfe den Zustand im LocalStorage und klappe Beiträge entsprechend ein oder aus
    $('.pinned-post').each(function(){
        var postID = $(this).data('post-id');
        var isCollapsed = localStorage.getItem('pinned-post-' + postID + '-collapsed') === 'true';
        if (isCollapsed) {
            $(this).find('.pinned-post-content').hide();  // Klappe den Beitrag ein
			$(this).children(':first')[0].innerText = Ossn.Print('com:pinned:posts:uncollapse:post'); // ändere den Link-Text -> entfalten
        } else {
			$(this).children(':first')[0].innerText = Ossn.Print('com:pinned:posts:collapse:post'); // ändere den Link-Text -> zusammenfalten
		}
    });

    // Alle gespeicherten Pinned-Post-IDs sammeln
    let existingPinnedPostIDs = [];
    $('.pinned-post').each(function(){
        var postID = $(this).data('post-id');
        existingPinnedPostIDs.push(postID.toString());  // Speichere die IDs als String, um sie später zu vergleichen
    });

    // Lösche alle LocalStorage-Einträge, die nicht mehr mit aktuellen Beiträgen übereinstimmen
    for (var key in localStorage) {
        if (key.startsWith("pinned-post-")) {
            var storedPostID = key.split('-')[2]; // Extrahiere die Post-ID aus dem LocalStorage-Schlüssel
            if (!existingPinnedPostIDs.includes(storedPostID)) {
                localStorage.removeItem(key);  // Lösche den LocalStorage-Eintrag, wenn die ID nicht mehr existiert
            }
        }
    }

    // Wenn keine angepinnten Beiträge vorhanden sind, lösche alle zugehörigen LocalStorage-Einträge
    if ($('.pinned-post').length === 0) {
        for (var key in localStorage) {
            if (key.startsWith("pinned-post-")) {
                localStorage.removeItem(key);  // Lösche alle LocalStorage-Einträge, die mit "pinned-post-" beginnen
            }
        }
    }

    // Event-Handler für das Unpin (Loslösen), um den LocalStorage-Eintrag zu löschen
    $('.ossn-wall-post-unpin').on('click', function(e) {
        var postID = $(this).data('guid');  // Hole die GUID des Beitrags
        localStorage.removeItem('pinned-post-' + postID + '-collapsed');  // Lösche den LocalStorage-Eintrag
    });
});

</script>
