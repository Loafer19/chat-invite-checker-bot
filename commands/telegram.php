<?php

namespace App\Commands;

require_once __DIR__ . '/../app/bootstrap.php';

$telegram
    ->setWebhook([
        'url' => $_ENV['BOT_WEBHOOK'] . '/app.php?bot_token=' . $_ENV['BOT_TOKEN'],
        'allowed_updates' => [
            'chat_member',
            'chat_join_request',
        ],
    ]);
