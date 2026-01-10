<?php
/**
 * helpers/fediversebridge_sign.php
 * Versturen van ActivityPub Accept-berichten
 */

require_once __DIR__ . '/sign.php';

/**
 * 🇳🇱 Verstuurt automatisch een Accept terug bij Follow
 * 🇬🇧 Sends an ActivityPub Accept message in response to a Follow
 *
 * @param string $actor_url        De volger (actor) – bijv. https://mastodon.social/users/abc
 * @param string $local_username  Lokale gebruiker (bijv. 'admin')
 * @param array $follow_data      Originele Follow-activiteit (inbox payload)
 * @return void
 */
function fediversebridge_send_accept($actor_url, $local_username, $follow_data) {
    $domain = parse_url(ossn_site_url(), PHP_URL_HOST);
    $actor_self = ossn_site_url("fediverse/actor/{$local_username}");

    // 🔍 Inbox van de volger ophalen
    $json = @file_get_contents($actor_url);
    if (!$json) {
        fediversebridge_log("⚠️ Kon actor niet ophalen: {$actor_url}");
        return;
    }

    $actor_data = json_decode($json, true);
    $inbox = $actor_data['inbox'] ?? null;
    if (!$inbox) {
        fediversebridge_log("⚠️ Geen inbox gevonden bij actor: {$actor_url}");
        return;
    }

    // 📄 Accept object opbouwen
    $activity_id = ossn_site_url("fediverse/accept/" . time() . '/' . uniqid());
    $accept = [
        '@context' => 'https://www.w3.org/ns/activitystreams',
        'id' => $activity_id,
        'type' => 'Accept',
        'actor' => $actor_self,
        'object' => $follow_data
    ];

    $body = json_encode($accept, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    $headers = fediversebridge_sign_request($inbox, $body, $local_username);

    if (!$headers) {
        fediversebridge_log("❌ Kon headers niet ondertekenen voor Accept door {$local_username}");
        return;
    }

    // 📤 Versturen via cURL
    $ch = curl_init($inbox);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    fediversebridge_log("📬 Accept verstuurd naar {$inbox} | Status: {$http_code}");
    file_put_contents(
        ossn_get_userdata("components/FediverseBridge/logs/fediverse.log"),
        date('c') . " 📬 Accept response: \n{$response}\n\n",
        FILE_APPEND
    );
}
