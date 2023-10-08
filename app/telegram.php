<?php

namespace App\Telegram;

use Telegram\Bot\BotsManager;

$config = [
    'bots' => [
        'main' => [
            'token' => $_ENV['BOT_TOKEN'],
            'webhook_url' => $_ENV['BOT_WEBHOOK'],
        ],
    ],
    'default' => 'main',
];

$telegram = new BotsManager($config);

function telegramSetWebhook()
{
    global $telegram;

    $telegram
        ->setAsyncRequest(true)
        ->setWebhook([
            'url' => $_ENV['BOT_WEBHOOK'] . '/app.php?bot_token=' . $_ENV['BOT_TOKEN'],
            'allowed_updates' => [
                'chat_join_request',
            ],
        ]);
};
