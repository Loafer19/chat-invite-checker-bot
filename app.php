<?php

namespace App;

require_once __DIR__ . '/app/bootstrap.php';

use App\Models\InviteLink;

$bot_token = $_GET['bot_token'] ?? null;
$chat_id = $_GET['create_invite_link_for_chat'] ?? null;
$external_id = $_GET['external_id'] ?? null;

if ($bot_token) {
    $response = $telegram->getWebhookUpdate();

    if ($response->objectType() === 'chat_join_request') {
        $url = $response->getInviteLink();

        $lnvite_link = InviteLink::where('url', $url)->first();

        if ($lnvite_link) {
            $lnvite_link->joinRequest();
        }
    }

    file_put_contents('log.txt', print_r($response, TRUE), FILE_APPEND);
}

if ($chat_id) {
    $response = $telegram->createChatInviteLink([
        'chat_id' => $chat_id,
        'expire_date' => time() + 60 * 60 * 24 * 7, // 7 days
        'creates_join_request' => true,
    ]);

    $lnvite_link = InviteLink::create([
        'external_id' => $external_id,
        'chat_id' => $chat_id,
        'url' => $response->getInviteLink(),
    ]);

    echo json_encode($lnvite_link->toArray());
}
