<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        $ch = curl_init($_ENV['SERVER_WEBHOOK']);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->json(),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ]);

        curl_exec($ch);
        curl_close($ch);

        file_put_contents(__DIR__ . '/../log.txt', PHP_EOL . print_r($this->json(), TRUE), FILE_APPEND);
    }

    public function json(): string
    {
        return json_encode($this->toArray());
    }
}
