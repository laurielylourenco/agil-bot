<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Client;
use App\Models\Fluxo;
use Illuminate\Http\Request;

class FluxoController extends Controller
{

    public function telegramWebhook(Request $request)
    {
        try {
            
            $cliente = new Client();
            $fluxo = new Fluxo();
            $msgs_fila = "Houve problema ao buscar as informações desse bot!";
            $msgs = [];
            $req_id_client = $request->message['from']['id'];
            $req_username = $request->message['from']['username'];
            $req_first_name = $request->message['from']['first_name'];
            $client_mensagem = $request->message['text'];

            $botModel = new Bot();
            $botController = new BotController();
            $bot_tipo = $botModel->getTypeBot($request->bot);



            if ($bot_tipo == 1) {

                $is_client = $cliente->getClient($req_id_client);

                if (is_null($is_client)) {

                    $newcliente =  $cliente->createClient([
                        'usuario' => $botModel->getManagerBot($request->bot),
                        'client' => $req_id_client,
                        'username' => $req_username,
                        'name' => $req_first_name,
                        'sequencia' => 1
                    ]);

                    /* Se for numerico responda de acordo com resposta se nao menu */
                }


                if (is_numeric($client_mensagem)) {

                    $is_resposta = $fluxo->getResposta($client_mensagem);

                    if ($is_resposta) {

                        $msgs_fila = $is_resposta->resposta . "\n\n";

                        $msgs_fila .=  "# - Voltar ao menu";
                    } else {

                        $msgs_fila = "A opção digitada não possui resposta!";
                    }
                } else {

                    $menus = $fluxo->getMenu();

                    if (count($menus) > 0) {

                        $options = "";
                        foreach ($menus as $m) {

                            if ($m->option == '0') {

                                $options .= $m->resposta . "\n\n"; // colocar timeout de um dia para aparecer saudação ao usuario

                            } else {
                                $options .= $m->menu . "\n";
                            }
                        }

                        $msgs_fila = $options;
                    }
                }

                $bot_token = $botModel->getBotToken($request->bot);
                $botController->sendMessageText($bot_token, $req_id_client, $msgs_fila);
            }


            if ($bot_tipo == 2) {

                $is_client = $cliente->getClient($req_id_client);

                if (is_null($is_client)) {

                    $newcliente =  $cliente->createClient([
                        'usuario' => $botModel->getManagerBot($request->bot),
                        'client' => $req_id_client,
                        'username' => $req_username,
                        'name' => $req_first_name,
                        'sequencia' => 1
                    ]);

                    $msgs = $fluxo->nextMessageSequencial(1);
                } else {

                    $msgs = $fluxo->nextMessageSequencial($is_client->sequencia);
                }

                if (count($msgs) > 0) {

                    $msgs_fila = "";
                    foreach ($msgs as $m) {
                        $msgs_fila .= $m->mensagem . "\n";
                    }
                }

                $bot_token = $botModel->getBotToken($request->bot);

                $botController->sendMessageText($bot_token, $req_id_client, $msgs_fila);
                $last_ordem = $fluxo->lastOrdemSequencial();

                $cliente->updateSequencia($req_id_client, $last_ordem);
            }
        } catch (\Throwable $th) {

            file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/getMessage.txt", $th->getMessage() . ",", FILE_APPEND);
        }
    }
}
