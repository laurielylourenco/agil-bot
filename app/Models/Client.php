<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';

    protected $fillable = [
        'usuario',
        'client',
        'name',
        'username',
        'sequencia'
    ];

    public function getClient($token_client)
    {
        $client = $this->where(['client' => $token_client])->first();
        return $client ? $client : null;
    }

    public function createClient($client)
    {
        return $this->create($client);
    }

    public function updateSequencia($token_client, $ordem)
    {
        $client = $this->where(['client' => $token_client])->first();

        if ($client) {

            $new_sequencia = $client->sequencia + 1;

            if ($new_sequencia > $ordem) {
                $new_sequencia = 1;
            }

            $client->update(['sequencia' => $new_sequencia]);
            $client = $client->fresh();

            return $client;
        }

        return false;
    }
}
