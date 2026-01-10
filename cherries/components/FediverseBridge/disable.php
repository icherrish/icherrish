<?php
/**
 * disable.php – Deactivation script for FediverseBridge
 * Door Eric Redegeld – nlsociaal.nl
 *
 * Features:
 * - Verwijdert testberichten van bekende gebruikers
 * - Reset het logbestand
 * - Stuurt Undo-berichten naar alle volgers van actieve gebruikers
 * - (optioneel) Verwijdert sleutelpaarbestanden
 * - (optioneel) Verwijdert volledige componentdata (voor testgebruik)
 */

//  Zorg dat de undo-helper beschikbaar is
require_once __DIR__ . '/helpers/undo.php';

//  Pad naar userdata
$base = ossn_get_userdata('components/FediverseBridge');
$log_file = "{$base}/logs/fediverse.log";

//  Verwijder test-outbox-bestanden van bekende gebruikers
$users = ['admin', 'testsociaal'];
foreach ($users as $username) {
    $testfile = "{$base}/outbox/{$username}/enable-test.json";
    if (file_exists($testfile)) {
        unlink($testfile);
        file_put_contents($log_file, date('c') . " INFO: Test message deleted: {$testfile}\n", FILE_APPEND);
    }
}

//  Reset het logbestand (leegmaken, niet verwijderen)
if (file_exists($log_file)) {
    file_put_contents($log_file, date('c') . " INFO: Log file cleared\n");
}

// Stuur Undo Follow voor alle actieve gebruikers met opt-in
$optin_dir = "{$base}/optin";
if (is_dir($optin_dir)) {
    $optin_files = glob("{$optin_dir}/*.json");
    foreach ($optin_files as $file) {
        $username = basename($file, '.json');
        if (function_exists('fediversebridge_send_undo_follows')) {
            fediversebridge_send_undo_follows($username);
            file_put_contents($log_file, date('c') . " INFO: Sent UNDO for @{$username}\n", FILE_APPEND);
        }
    }
}

// Optioneel: verwijder private/public sleutels
$delete_keys = false; // Zet op true om sleutels te verwijderen

if ($delete_keys) {
    foreach ($users as $username) {
        $key = "{$base}/private/{$username}.pem";
        $pub = "{$base}/private/{$username}.pubkey";

        if (file_exists($key)) {
            unlink($key);
            file_put_contents($log_file, date('c') . " INFO: Private key deleted: {$key}\n", FILE_APPEND);
        }
        if (file_exists($pub)) {
            unlink($pub);
            file_put_contents($log_file, date('c') . " INFO: Public key deleted: {$pub}\n", FILE_APPEND);
        }
    }
}

//  Gevaarlijk: verwijder volledige userdata (voor testomgeving)
$delete_all_data = false;

if ($delete_all_data && is_dir($base)) {
    /**
     * Recursieve verwijdering van directory
     */
    function rrmdir($dir) {
        foreach (glob($dir . '/*') as $f) {
            if (is_dir($f)) {
                rrmdir($f);
            } else {
                unlink($f);
            }
        }
        rmdir($dir);
    }

    rrmdir($base);
    error_log("[FediverseBridge] WARNING: Entire userdata structure removed from {$base}");
}
