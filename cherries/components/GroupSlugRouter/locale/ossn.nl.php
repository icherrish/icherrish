<?php
/**
 * 🇳🇱 Nederlandse vertalingen voor GroupSlugRouter
 * Auteur: Eric Redegeld
 */

$nl = array(
    // 🌐 Gebruiker → Groepen subpagina
    'usergroups:title' => 'Groepen van %s',
    'ossn:user:groups:sort' => 'Sorteren op:',
    'ossn:user:groups:newest' => 'Nieuwste eerst',
    'ossn:user:groups:oldest' => 'Oudste eerst',
    'ossn:user:groups:members' => 'Meeste leden',
    'ossn:user:groups:az' => 'Groepsnaam A-Z',
    'ossn:user:groups:za' => 'Groepsnaam Z-A',
    'usergroups:no_groups' => 'Deze gebruiker beheert nog geen groepen.',
    'usergroups:privacy:unknown' => 'Onbekende privacy-instelling',
    'usergroups:showcovers' => 'Toon covers:',
    'usergroups:apply' => 'Toepassen',
    'usergroups:members' => '%s leden',

    // ⚠️ Conflictmelding
    'groupslugrouter:usergroupsconflict' => 'De component \'UserGroups\' is actief. Deze kan conflicteren met GroupSlugRouter. Zet \'UserGroups\' eerst uit voor correcte werking.',

    // 🧪 Slug Debug
    'slugdebug:title' => 'Slug Debug Tool',

    // ⚠️ Slug bestaat al
    'groupslugrouter:slugexistswarning' => '⚠️ De slug was al in gebruik, er is een alternatief aangemaakt:',

    // ♻️ Ja/Nee
    'yes' => 'Ja',
    'no'  => 'Nee',
);

ossn_register_languages('nl', $nl);
