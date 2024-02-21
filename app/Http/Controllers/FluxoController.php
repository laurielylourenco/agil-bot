<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Client;
use Illuminate\Http\Request;

class FluxoController extends Controller
{


    public function telegramWebhook(Request $request)
    {

        try {

            $req_id_client = $request->message['from']['id'];
            file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/teste.json", json_encode($request->all()) . ",", FILE_APPEND);

            $bot = new Bot();
            $bot_tipo = $bot->getTypeBot($request->bot);

            if ($bot_tipo == 2) {

                $cliente = new Client();

                $is_client = $cliente->getClient($req_id_client);

                if (is_null($is_client)) {

                    $newcliente =  $cliente->createClient([
                        'usuario' => $bot->getManagerBot($request->bot),
                        'client' => $req_id_client,
                        'sequencia' => 0
                    ]);

                    file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/newcliente.json", json_encode($newcliente) . ",", FILE_APPEND);
                } else {



                    
                    file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/cliente.json", json_encode($is_client) . ",", FILE_APPEND);
                }
            } else {

                file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/bot_tipo.json", json_encode($bot_tipo) . ",", FILE_APPEND);
            }
        } catch (\Throwable $th) {

            file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/getMessage.txt", $th->getMessage() . ",", FILE_APPEND);

            //throw $th;
        }

        //file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/bot.json", json_encode($bot) . ",", FILE_APPEND);
        /* Aqui tenho que analisar qual tipo fluxo aquele bot tem configurado */

        /* Controlar fluxo do bot */


        // return response()->json($request);
    }
}
