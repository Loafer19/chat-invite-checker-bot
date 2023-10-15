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
