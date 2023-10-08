<?php

namespace App\Database;

use Illuminate\Database\Capsule\Manager as DB;

if (!DB::schema()->hasTable('invite_links')) {
    DB::schema()->create('invite_links', function ($table) {
        $table->increments('id');
        $table->integer('click_id');
        $table->bigInteger('chat_id');
        $table->string('url');
        $table->timestamp('join_request_at')->nullable();
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    });
}
