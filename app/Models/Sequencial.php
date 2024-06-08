<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sequencial extends Model
{
    use HasFactory;

    protected $table = 'sequencial';

    protected $fillable = [
        'usuario',
        'ordem',
        'mensagem'
    ];


    public function getMensagemSequencialAll($user)
    {
        $msgs = $this->where(['usuario' => $user])->orderBy('ordem', 'asc')->get();
        return $msgs;
    }
}
