<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Bot;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class BotController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('login');
    }


    public function config()
    {

        return view('home.config');
    }

    public function configBot()
    {

        return view('home.bot');
    }

    public function listBot()
    {

        $user = auth()->user();

        $contas = Bot::where([
            'usuario' => $user->email
        ])->get();

        //var_export($contas);

        return view('home.bot_list', compact('contas'));
    }

    public function configBotForm(Request $request)
    {
        try {

            $request->validate([
                'tipo_bot' => 'required|string',
                'email' => 'required|email'
            ]);

            if (is_null($request->token_bot)) {

                return redirect()->route('configBot')->with('info', 'Token Vazio');
            }


            $bot = Bot::where([
                'token' => $request->token_bot,
                'usuario' => $request->email,
            ])->get();


            if (count($bot) == 0) {

                Bot::create([
                    'token' => $request->token_bot,
                    'usuario' => $request->email,
                    'tipo_bot' => $request->tipo_bot
                ]);
            } else {

                $bot->toQuery()->update([
                    'tipo_bot' => $request->tipo_bot,
                    'token' => $request->token_bot
                ]);
            }

            return redirect()->route('configBot')->with('success', 'Sucesso!')->with('token', $request->token);
        } catch (\Throwable $th) {
            return redirect()->route('configBot')->with('error', $th->getMessage())->with('token', $request->token);
        }
    }
}
