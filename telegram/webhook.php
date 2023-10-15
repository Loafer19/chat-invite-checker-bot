<?php

namespace App\Telegram;

require_once __DIR__ . '/../public/bootstrap.php';

$telegram
    ->setWebhook([
        'url' => $_ENV['BOT_WEBHOOK'] . '/app.php?bot_token=' . $_ENV['BOT_TOKEN'],
        'allowed_updates' => [
            'chat_member',
            'chat_join_request',
        ],
    ]);
