<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sequencial;


class SequencialController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth')->except('login');
    }

    public function sequencial($id)
    {

        $user = auth()->user();
        $sequencial = new Sequencial();
        $mensagens = $sequencial->getMensagemSequencialAll($user->email, $id);


        return view('home.sequencial', ['mensagens' => $mensagens, 'bot_id' => $id]);
    }

    public function createMensagem(Request $request)
    {
        try {

            $request->validate([
                'mensagem' => 'required|string|min:5',
                'ordem' => 'required|string|max:2',
                'email' => 'required|email',
                'bot_id' => 'required'
            ]);

            $menu =  Sequencial::where([
                'ordem' => $request->ordem,
                'usuario' => $request->email, //
                'id_bot' => $request->bot_id
            ])->get();


            if (count($menu) == 0) {

                Sequencial::create([
                    'ordem' => $request->ordem,
                    'usuario' => $request->email,
                    'mensagem' => $request->mensagem,
                    'id_bot' => $request->bot_id
                ]);
            } else {

                $menu->toQuery()->update([
                    'mensagem' => $request->mensagem
                ]);
            }

            $prencher = Sequencial::where([
                'ordem' => $request->ordem,
                'usuario' => $request->email,
                'id_bot' => $request->bot_id
            ])->first();


            return redirect()->route('menu-sequencial')->with('success', 'Operação realizada com sucesso!')->with('mensagem_criada', $prencher->mensagem);
        } catch (\Exception $e) {
            // Captura e trata outros erros
            //var_export($e);
            return redirect()->route('menu-sequencial')->with('error', "Erro ao criar a mensagem")->with('mensagem_criada', "erro");
        }
    }


    public function checkOrdem(Request $request)
    {
        $optionData = Sequencial::where([
            'ordem' => $request->ordem,
            'usuario' => $request->email,
            'id_bot' => $request->bot_id
        ])->first();

        if ($optionData) {
            return response()->json(['hasData' => true, 'mensagem' => $optionData->mensagem]);
        } else {
            return response()->json(['hasData' => false]);
        }
    }
}
