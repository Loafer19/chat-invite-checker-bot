<?php

namespace App\Public;

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$dotenv->required('BOT_TOKEN')->allowedRegexValues('/^(\d+):([a-zA-Z0-9\-_]+)$/');
$dotenv->required('BOT_WEBHOOK')->allowedRegexValues('/^https?:\/\/.+\..+$/');

$dotenv->required('CHAT_ID')->notEmpty();

$dotenv->required('SERVER_WEBHOOK')->allowedRegexValues('/^https?:\/\/.+\..+$/');

require_once __DIR__ . '/../telegram/config.php';
require_once __DIR__ . '/../database/config.php';

function log_to_file(mixed $message)
{
    file_put_contents(__DIR__ . '/../log.txt', print_r($message, TRUE), FILE_APPEND);
}
