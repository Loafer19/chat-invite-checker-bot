<?php

namespace App\Database;

require_once __DIR__ . '/../public/bootstrap.php';

use Illuminate\Database\Capsule\Manager;

if (!Manager::schema()->hasTable('invite_links')) {
    Manager::schema()->create('invite_links', function ($table) {
        $table->increments('id');
        $table->integer('click_id');
        $table->bigInteger('chat_id');
        $table->string('url');
        $table->timestamp('join_request_at')->nullable();
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    });
}
