<?php

namespace App\Public;

require_once __DIR__ . '/bootstrap.php';

use App\Models\InviteLink;

$bot_token = $_GET['bot_token'] ?? null;
$click_id = $_GET['click_id'] ?? null;

if ($bot_token) {
    $response = $telegram->getWebhookUpdate();

    if (
        isset($response[$response->objectType()]['new_chat_participant'])
        || isset($response[$response->objectType()]['left_chat_participant'])
        || isset($response[$response->objectType()]['new_chat_title'])
        || isset($response[$response->objectType()]['new_chat_photo'])
    ) {
        $telegram->deleteMessage([
            'chat_id' => $response[$response->objectType()]['chat']['id'],
            'message_id' => $response[$response->objectType()]['message_id'],
        ]);
    }

    if ($response->objectType() === 'chat_join_request') {
        $telegram->approveChatJoinRequest([
            'chat_id' => $response[$response->objectType()]['chat']['id'],
            'user_id' => $response[$response->objectType()]['from']['id'],
        ]);

        if (isset($response[$response->objectType()]['invite_link']['invite_link'])) {
            $url = $response[$response->objectType()]['invite_link']['invite_link'];

            $lnvite_link = InviteLink::where('url', $url)->first();

            if ($lnvite_link) {
                $lnvite_link->joined();

                $lnvite_link->sendUpdate();
            }
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

    $url = $response->getInviteLink();

    $lnvite_link = InviteLink::create([
        'click_id' => $click_id,
        'chat_id' => $chat_id,
        'url' => $url,
    ]);

    header('Location: ' . $url);
}

exit();
