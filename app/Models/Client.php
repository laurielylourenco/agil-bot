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
        'sequencia'
    ];

    public function getClient($token_client)
    {
        $client = $this->where(['client' => $token_client])->first();
        return $client ? $client->id : null;
    }

    public function createClient($client)
    {
        return $this->create($client);
    }

    public function updateSequencia($token_client)
    {
        $client = $this->where(['client' => $token_client])->first();

        if ($client) {
            
            $new_sequencia = $client->sequencia++;
            return  $client->toQuery()->update(['sequencia' => $new_sequencia]);
        }

        return false;
    }
}
