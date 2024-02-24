<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;

    protected $table = 'bot';

    protected $fillable = [
        'usuario',
        'token',
        'tipo_bot',
        'name_bot'
    ];

    public function getTypeBot($botName)
    {
        $bot = $this->where(['name_bot' => $botName])->first();
        return $bot ? $bot->tipo_bot : null;
    }

    public function getManagerBot($botName)
    {
        $bot = $this->where(['name_bot' => $botName])->first();
        return $bot ? $bot->usuario : null;
    }


    public function getBotToken($botName)
    {
        $bot = $this->where(['name_bot' => $botName])->first();
        return $bot ? $bot->token : null;
    }
}
