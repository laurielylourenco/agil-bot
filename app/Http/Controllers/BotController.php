<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Bot;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

            if (!validarTokenTelegram($request->token_bot)) {

                return redirect()->route('configBot')->with('info', 'Token Invalido');
            }


            $bot = Bot::where([
                'token' => $request->token_bot,
                'usuario' => $request->email,
            ])->get();


            if (count($bot) == 0) {

                $name_bot = date('dmys') . '' . $request->email;

                $name_bot = hash('sha256', $name_bot);
                Bot::create([
                    'token' => $request->token_bot,
                    'usuario' => $request->email,
                    'tipo_bot' => $request->tipo_bot,
                    'name_bot' =>  $name_bot
                ]);


                $response = Http::get("https://api.telegram.org/bot" . $request->token_bot . "/setWebhook", [
                    'url' => "https://e283-45-169-49-148.ngrok-free.app/api/telegram?bot=$name_bot",
                    'allowed_updates' => json_encode(['message', 'callback_query', 'inline_query']),
                ]);

                $body = $response->body();
                
                file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/teste.json", json_encode($body) . ",", FILE_APPEND);
                file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/teste1.json", json_encode($name_bot) . ",", FILE_APPEND);
                       
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


function validarTokenTelegram($token)
{
    $padraoRegex = '/^\d+:[\w-]+$/i';

    // Use preg_match para verificar a correspondência
    return preg_match($padraoRegex, $token) === 1;
}
