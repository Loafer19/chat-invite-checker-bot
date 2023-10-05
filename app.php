<?php

// @todo: move to bootstrap
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

$dotenv->load();

$dotenv->required('BOT_TOKEN')->allowedRegexValues('/^(\d+):([a-zA-Z0-9\-_]+)$/');
// end @todo

echo $_ENV['BOT_TOKEN'];
