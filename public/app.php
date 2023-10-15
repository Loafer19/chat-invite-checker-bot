<?php

namespace App\Public;

require_once __DIR__ . '/bootstrap.php';

use App\Models\InviteLink;

$bot_token = $_GET['bot_token'] ?? null;
$click_id = $_GET['click_id'] ?? null;

if ($bot_token) {
    $response = $telegram->getWebhookUpdate();

    if ($response->objectType() === 'chat_join_request') {
        $url = $response->getInviteLink();

        $lnvite_link = InviteLink::where('url', $url)->first();

        if ($lnvite_link) {
            $lnvite_link->joinRequest();

            $lnvite_link->sendUpdate();
        }
    }

    log_to_file($response);
}

if ($click_id) {
    $chat_id = $_ENV['CHAT_ID'];

    $response = $telegram->createChatInviteLink([
        'chat_id' => $chat_id,
        'expire_date' => time() + 60 * 60 * 24 * 7, // 7 days
        'creates_join_request' => true,
    ]);

    $lnvite_link = InviteLink::create([
        'click_id' => $click_id,
        'chat_id' => $chat_id,
        'url' => $response->getInviteLink(),
    ]);

    echo $lnvite_link->json();
}
