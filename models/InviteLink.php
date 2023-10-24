<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

use function App\Public\log_to_file;

class InviteLink extends Model
{
    protected $guarded = [];

    public int $id;

    public int $click_id;

    public int $chat_id;

    public string $url;

    public ?string $join_request_at = null;

    protected $casts = [
        'id' => 'integer',
        'click_id' => 'integer',
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

    public function sendUpdate(): void
    {
        $client = new Client([
            'base_uri' => $_ENV['SERVER_WEBHOOK'],
            'timeout'  => 2,
        ]);

        $client->post('', $this->toArray());

        log_to_file($this->json());
    }

    public function json(): string
    {
        return json_encode($this->toArray());
    }
}
