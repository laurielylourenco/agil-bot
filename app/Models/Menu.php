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
        'resposta'
    ];

    public function getMenuAll($user)
    {
        $msgs = $this->where(['usuario' => $user])->orderBy('option', 'asc')->get();
        return $msgs;
    }

}
