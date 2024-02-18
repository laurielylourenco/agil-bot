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
}
