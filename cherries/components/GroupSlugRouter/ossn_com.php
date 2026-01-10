<?php
/**
 * GroupSlugRouter Component
 * Auteur: Eric Redegeld
 * Friendly vanity URLs for OSSN groups using slug entities (zonder DB-aanpassing)
 * Met dank aan Michael Zülsdorff voor waardevolle inzichten.
 */

define('__GROUPSLUGROUTER__', ossn_route()->com . 'GroupSlugRouter/');
require_once __GROUPSLUGROUTER__ . 'helpers/slug.php';

/**
 * 🇳🇱 Initialisatie van de component
 */
function com_GroupSlugRouter_init() {
    ossn_extend_view('ossn/site/head', 'css/usergroups.css');

    // /g/slug redirect
    ossn_register_page('g', 'groupslugrouter_vanity_handler');

    // /slugdebug
    ossn_register_page('slugdebug', 'groupslugrouter_debug_slug');

    // Profielsubpagina: /u/gebruikersnaam/groups
    ossn_profile_subpage('groups');
    ossn_add_hook('profile', 'subpage', 'groupslugrouter_subpage_handler');

    // Tab “Groepen” op profiel
    ossn_register_callback('page', 'load:profile', 'groupslugrouter_profile_link');

    // Bij nieuwe groep
    ossn_register_callback('group', 'add', 'groupslugrouter_on_group_added');

    // Bij wijziging groepstitel
    ossn_register_callback('group', 'update', 'groupslugrouter_on_group_updated');

    // Admin link voor fix pagina
    ossn_register_admin_sidemenu('fixslugs', 'Slugs herstellen', 'administrator/group-slugs/fix', 'admin');
}
ossn_register_callback('ossn', 'init', 'com_GroupSlugRouter_init');

/**
 * 📌 Callback bij aanmaken van groep
 */
function groupslugrouter_on_group_added($event, $type, $params) {
    if (!isset($params['group_guid'])) {
        return;
    }
    $group = ossn_get_group_by_guid($params['group_guid']);
    if ($group) {
        groupslugrouter_generate_slug($group);
    }
}

/**
 * 📌 Callback bij wijzigen van groepstitel
 */
function groupslugrouter_on_group_updated($event, $type, $params) {
    if (!isset($params['group_guid'])) {
        return;
    }
    $group = ossn_get_group_by_guid($params['group_guid']);
    if ($group) {
        groupslugrouter_generate_slug($group); // Oude slug wordt automatisch verwijderd
    }
}

/**
 * 📌 /g/slug handler
 */
function groupslugrouter_vanity_handler($pages) {
    if (empty($pages[0])) {
        return ossn_error_page();
    }

    $slug = strtolower($pages[0]);
    $group = groupslugrouter_get_group_by_slug($slug);

    if ($group && isset($group->guid)) {
        return redirect("group/{$group->guid}");
    }

    // Fallback: probeer alsnog via titel
    $fallback = ossn_get_entities([
        'type' => 'object',
        'subtype' => 'ossngroup',
        'page_limit' => false,
    ]);

    if (!empty($fallback) && is_array($fallback)) {
        foreach ($fallback as $g) {
            if (!isset($g->title)) continue;

            $title_slug = strtolower(trim(preg_replace('/[^a-z0-9]+/', '-', $g->title), '-'));
            if ($title_slug === $slug) {
                $exists = ossn_get_entities([
                    'type' => 'object',
                    'subtype' => 'groupslugname',
                    'owner_guid' => $g->guid,
                    'limit' => 1,
                ]);
                if (!$exists) {
                    groupslugrouter_generate_slug($g);
                }
                return redirect("group/{$g->guid}");
            }
        }
    }

    return ossn_error_page();
}

/**
 * 📌 /slugdebug voor admins
 */
function groupslugrouter_debug_slug($pages) {
    if (!ossn_isAdminLoggedin()) {
        return ossn_error_page();
    }

    $output = '<div class="ossn-page-contents">';
    $output .= '<h2>Slug Debug Tool</h2>';
    $output .= '<form method="GET"><input name="s" value="' . htmlentities($_GET['s'] ?? '') . '" />';
    $output .= '<button type="submit">Zoek / Search</button></form>';

    if (isset($_GET['s'])) {
        $group = groupslugrouter_get_group_by_slug($_GET['s']);
        if ($group) {
            $output .= "<p>✅ Gevonden: <a href='" . ossn_site_url("group/{$group->guid}") . "'>group/{$group->guid}</a></p>";
        } else {
            $output .= "<p>❌ Niet gevonden / Not found</p>";
        }
    }

    $output .= '</div>';
    echo ossn_view_page('Slug Debug', $output);
}

/**
 * 📌 Subpage handler /u/username/groups
 */
function groupslugrouter_subpage_handler($hook, $type, $return, $params) {
    if ($params['subpage'] == 'groups' && isset($params['user'])) {
        ossn_set_input('username', $params['user']->username);
        include __GROUPSLUGROUTER__ . 'pages/user/groups.php';
        return true;
    }
    return $return;
}

/**
 * 📌 Menu-item op profielpagina
 */
function groupslugrouter_profile_link() {
    $user = ossn_user_by_guid(ossn_get_page_owner_guid());
    if ($user) {
        ossn_register_menu_link(
            'groups',
            ossn_print('groups'),
            ossn_site_url("u/{$user->username}/groups"),
            'user_timeline'
        );
    }
}
