<?php

namespace App\Commands;

use function App\Telegram\telegramSetWebhook;

require_once __DIR__ . '/../app/bootstrap.php';

telegramSetWebhook();
