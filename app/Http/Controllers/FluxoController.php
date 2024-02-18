<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FluxoController extends Controller
{


    public function telegramWebhook(Request $request)
    {


        file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/teste.json", json_encode($request->all()) . ",", FILE_APPEND);
        ///file_put_contents("/var/www/html/learn-laravel/agil-bot/storage/logs/telegram/qes.json", json_encode($request->url()) . ",", FILE_APPEND);
      
      
      
        // return response()->json($request);
    }
}
