<?php

// @todo: move to bootstrap
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

$dotenv->load();

$dotenv->required('BOT_TOKEN')->allowedRegexValues('/^(\d+):([a-zA-Z0-9\-_]+)$/');
$dotenv->required('BOT_WEBHOOK')->allowedRegexValues('/^https?:\/\/.+\..+$/');
// end @todo

// @todo: move config & handler
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

$response = $telegram->getMe();

echo $response;

// don't work when webhook is set
// $response = $telegram->getUpdates();
// echo '[' . implode(',', $response) . ']';

// $telegram
//     ->setAsyncRequest(true)
//     ->setWebhook([
//         'url' => $_ENV['BOT_WEBHOOK'] . '/app.php?bot_token=' . $_ENV['BOT_TOKEN'],
//     ]);

// $telegram->removeWebhook();

if (isset($_GET['bot_token']) && $_GET['bot_token'] === $_ENV['BOT_TOKEN']) {
    $response = $telegram->getWebhookUpdate();

    file_put_contents('log.txt', print_r($response->getChat()->id, true) . PHP_EOL, FILE_APPEND);
}
