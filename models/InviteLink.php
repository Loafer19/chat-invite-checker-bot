<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InviteLink extends Model
{
    protected $guarded = [];

    public int $id;

    public int $external_id;

    public int $chat_id;

    public string $url;

    public ?string $join_request_at = null;

    protected $casts = [
        'id' => 'integer',
        'external_id' => 'integer',
        'chat_id' => 'integer',
        'url' => 'string',
        'join_request_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function joinRequest(): void
    {
        $this->update([
            'join_request_at' => new \DateTime(),
        ]);
    }
}
