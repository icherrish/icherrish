<?php
/**
 * 🇬🇧 English translations for GroupSlugRouter
 * Author: Eric Redegeld
 */

$en = array(
    // 🌐 User → Groups subpage
    'usergroups:title' => 'Groups of %s',
    'ossn:user:groups:sort' => 'Sort by:',
    'ossn:user:groups:newest' => 'Newest first',
    'ossn:user:groups:oldest' => 'Oldest first',
    'ossn:user:groups:members' => 'Most members',
    'ossn:user:groups:az' => 'Group name A-Z',
    'ossn:user:groups:za' => 'Group name Z-A',
    'usergroups:no_groups' => 'This user does not manage any groups yet.',
    'usergroups:privacy:unknown' => 'Unknown privacy setting',
    'usergroups:showcovers' => 'Show covers:',
    'usergroups:apply' => 'Apply',
    'usergroups:members' => '%s members',

    // ⚠️ Conflict warning
    'groupslugrouter:usergroupsconflict' => 'The component "UserGroups" is still active. It may conflict with GroupSlugRouter. Please disable "UserGroups" first for correct operation.',

    // 🧪 Slug Debug
    'slugdebug:title' => 'Slug Debug Tool',

    // ⚠️ Slug exists warning
    'groupslugrouter:slugexistswarning' => '⚠️ This slug was already in use, an alternative has been created:',

    // ♻️ Yes/No
    'yes' => 'Yes',
    'no'  => 'No',
);
ossn_register_languages('en', $en);
