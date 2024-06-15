<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $fillable = [
        'usuario',
        'option',
        'menu',
        'resposta',
        'id_bot'
    ];

    public function getMenuAll($user, $id)
    {
        $msgs = $this->where(['usuario' => $user, 'id_bot' => $id])->orderBy('option', 'asc')->get();
        return $msgs;
    }
}
