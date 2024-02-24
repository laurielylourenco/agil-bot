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

            if (!$this->validarTokenTelegram($request->token_bot)) {
                return redirect()->route('configBot')->with('info', 'Token Invalido');
            }

            $bot = Bot::where([
                'token' => $request->token_bot,
                'usuario' => $request->email,
            ])->first();

            if (is_null($bot)) {

                $name_bot = date('dmys') . '' . $request->email;

                $name_bot = hash('sha256', $name_bot);
                Bot::create([
                    'token' => $request->token_bot,
                    'usuario' => $request->email,
                    'tipo_bot' => $request->tipo_bot,
                    'name_bot' =>  $name_bot
                ]);

                $urltelgram = env('APP_URL_WB');
                $urltelgram_final = "$urltelgram/api/telegram?bot=$name_bot";

                $response = Http::get("https://api.telegram.org/bot" . $request->token_bot . "/setWebhook", [
                    'url' => $urltelgram_final,
                    'allowed_updates' => json_encode(['message', 'callback_query', 'inline_query']),
                ]);

                $body = $response->body();

            } else {

                $bot->update([
                    'tipo_bot' => $request->tipo_bot,
                    'token' => $request->token_bot
                ]);

                $name_bot = $bot->name_bot;

                $urltelgram = env('APP_URL_WB');
                $urltelgram_final = "$urltelgram/api/telegram?bot=$name_bot";

                $response = Http::get("https://api.telegram.org/bot" . $request->token_bot . "/setWebhook", [
                    'url' => $urltelgram_final,
                    'allowed_updates' => json_encode(['message', 'callback_query', 'inline_query']),
                ]);

                $body = $response->body();
            }

            return redirect()->route('configBot')->with('success', 'Sucesso!')->with('token', $request->token);
        } catch (\Throwable $th) {

            file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/create_update_bot.txt", $th->getMessage() . "\n", FILE_APPEND);

            return redirect()->route('configBot')->with('error', $th->getMessage())->with('token', $request->token);
        }
    }

    public function validarTokenTelegram($token)
    {
        $padraoRegex = '/^\d+:[\w-]+$/i';
        return preg_match($padraoRegex, $token) === 1;
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
