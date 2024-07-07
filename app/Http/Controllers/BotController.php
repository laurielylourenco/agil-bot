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
        //$this->middleware('auth')->except('login');
    }

    public function config()
    {

        return view('home.config');
    }

    public function configBot($id)
    {

        $botinfo = Bot::where([
            'id' =>  $id
        ])->first();

        return view('home.bot', [
            'bot_id' => $id, 'bot_tokent' => $botinfo->token_telegram,
            'bot_nome' => $botinfo->nome,
            'bot_desc' => $botinfo->descricao

        ]);
    }

    function archiveBot($id)
    {
        $botinfo = Bot::where([
            'id' =>  $id
        ])->first();

        if ($botinfo) {
            $botinfo->update(['ativo' => 0]);
            return redirect()->route('lista-bot')->with('success', 'Sucesso!');
        }

        return redirect()->route('lista-bot')->with('error', "Ao deletar o bot");
    }

    public function listBot()
    {

        $user = auth()->user();

        $contas = Bot::where([
            'usuario' => $user->email,
            'ativo' => 1
        ])->get();

        return view('home.bot_list', compact('contas'));
    }


    public function createbot(Request $request)
    {
        try {

            file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/create_requestbotname.txt", json_encode($request->botname));

            $request->validate([
                'botname' => 'required|string',
                'email' => 'required|email',
                'tipo_bot' => 'required|string',
            ]);

            $hash_bot = date('dmys') . '' . $request->email;
            $hash_bot = hash('sha256', $hash_bot);


            Bot::create([
                'usuario' => $request->email,
                'tipo_bot' => $request->tipo_bot,
                'nome' => $request->botname,
                'token_telegram' => "",
                'hash_bot' =>  $hash_bot,
                'descricao' => $request->descBot ?? ""
            ]);


            /// var_export($request);
            return redirect()->route('lista-bot')->with('success', 'Sucesso!');
        } catch (\Throwable $th) {

            file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/newcreate.txt", $th->getMessage() . "\n", FILE_APPEND);

            ///var_export($th->getMessage());
            return redirect()->route('lista-bot')->with('error', "Ao criar um bot");
        }
    }

    public function configBotForm(Request $request, $id)
    {
        try {

            $request->validate([
                'email' => 'required|email'
            ]);

            if ($request->token_bot) {
                if (!$this->validarTokenTelegram($request->token_bot)) {
                    return redirect()->route('lista-bot')->with('error', 'token_telegram Invalido');
                }
            }
            $bot = Bot::where([
                'id' => $id,
                'usuario' => $request->email,
            ])->first();


            if ($bot) {

                if ($request->token_bot) {
                    $bot->update([
                        'nome' => $request->nome_bot,
                        'descricao' => $request->des_bot,
                        'token_telegram' => $request->token_bot
                    ]);
                } else {
                    $bot->update([
                        'nome' => $request->nome_bot,
                        'descricao' => $request->des_bot
                    ]);
                }


                $hash_bot = $bot->has_bot;
                $urltelgram = env('APP_URL_WB');
                $urltelgram_final = "$urltelgram/api/telegram?bot=$hash_bot";

                $response = Http::get("https://api.telegram.org/bot" . $request->token_bot . "/setWebhook", [
                    'url' => $urltelgram_final,
                    'allowed_updates' => json_encode(['message', 'callback_query', 'inline_query']),
                ]);

                $body = $response->body();
            }

            return redirect()->route('lista-bot')->with('success', 'Sucesso!');
        } catch (\Throwable $th) {

            file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/create_update_bot.txt", $th->getMessage() . "\n", FILE_APPEND);

            return redirect()->route('lista-bot')->with('error', $th->getMessage());
        }
    }

    public function validarTokenTelegram($token_telegram)
    {
        $padraoRegex = '/^\d+:[\w-]+$/i';
        return preg_match($padraoRegex, $token_telegram) === 1;
    }

    public function sendMessageText($botApiToken, $channelId, $text)
    {

        $url = "https://api.telegram.org/bot{$botApiToken}/sendMessage";

        $response = Http::post($url, [
            'chat_id' => $channelId,
            'text' => $text,
        ]);

        $statusCode = $response->status();
        $content = $response->body();

        return response($content, $statusCode);

        //return true;
    }
}
