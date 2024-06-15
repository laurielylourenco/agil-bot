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
        'mensagem',
        'id_bot'
    ];


    public function getMensagemSequencialAll($user, $id)
    {
        $msgs = $this->where(['usuario' => $user, 'id_bot' => $id])->orderBy('ordem', 'asc')->get();
        return $msgs;
    }
}
