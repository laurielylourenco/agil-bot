<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fluxo extends Model
{
    use HasFactory;


    public function nextMessageSequencial($sequencia)
    {
        if ($sequencia == 1) {
            return Sequencial::where('ordem', '<=', $sequencia)->get();
        }

        return Sequencial::where('ordem', $sequencia)->get();
    }


    public function lastOrdemSequencial()
    {
        
        $ultimoRegistro = Sequencial::orderBy('ordem', 'desc')->first();

        if ($ultimoRegistro) {
            return (int) $ultimoRegistro->ordem;
        }
        return 0;
    }
}
