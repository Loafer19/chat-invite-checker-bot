<?php

namespace App\App;

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$dotenv->required('BOT_TOKEN')->allowedRegexValues('/^(\d+):([a-zA-Z0-9\-_]+)$/');
$dotenv->required('BOT_WEBHOOK')->allowedRegexValues('/^https?:\/\/.+\..+$/');

$dotenv->required('CHAT_ID')->notEmpty();

$dotenv->required('SERVER_WEBHOOK')->allowedRegexValues('/^https?:\/\/.+\..+$/');

require_once __DIR__ . '/telegram.php';
require_once __DIR__ . '/../database/connection.php';
