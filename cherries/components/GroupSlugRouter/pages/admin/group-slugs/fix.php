<?php
/**
 * fixslugs.php - Admin tool voor het herstellen van ontbrekende group slugs
 * 📍 URL: /administrator/group-slugs/fix
 */

define('__GROUPSLUGROUTER__', ossn_route()->com . 'GroupSlugRouter/');
require_once __GROUPSLUGROUTER__ . 'helpers/slug.php';

if (!ossn_isAdminLoggedin()) {
    redirect();
}

echo '<div class="ossn-page-contents">';
echo "<h2>🔧 Slug-hersteltool voor groepen</h2>";

$groepen = ossn_get_data("SELECT * FROM ossn_object WHERE subtype = 'ossngroup'");
$hersteld = 0;

if ($groepen && is_array($groepen)) {
    foreach ($groepen as $g) {
        $group_guid = (int) $g->guid;
        $title = $g->title ?? '';

        // Skip als geen titel
        if (empty(trim($title))) {
            echo "<p>⚠️ Groep {$group_guid} heeft geen titel, wordt overgeslagen.</p>";
            continue;
        }

        // Controleer of al een slug bestaat
        $bestaand = ossn_get_entities([
            'type' => 'object',
            'subtype' => 'groupslugname',
            'owner_guid' => $group_guid,
            'limit' => 1,
        ]);

        if ($bestaand) {
            echo "<p>✅ Groep {$group_guid} heeft al een slug: '{$bestaand[0]->value}'</p>";
            continue;
        }

        // Slug genereren en opslaan
        $group_obj = ossn_get_group_by_guid($group_guid);
        if ($group_obj) {
            $slug = groupslugrouter_generate_slug($group_obj);
            if ($slug) {
                echo "<p>🛠️ Slug '{$slug}' aangemaakt voor groep {$group_guid} ({$title})</p>";
                $hersteld++;
            } else {
                echo "<p>❌ Slug aanmaken mislukt voor groep {$group_guid} ({$title})</p>";
            }
        } else {
            echo "<p>⚠️ Groep object niet gevonden voor GUID {$group_guid}</p>";
        }
    }
    echo "<p>✅ Totaal herstelde slugs: {$hersteld}</p>";
} else {
    echo "<p>⚠️ Geen groepen gevonden in de database.</p>";
}

echo '</div>';
