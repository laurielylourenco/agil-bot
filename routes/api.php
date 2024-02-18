<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\FluxoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
//Route::post("login",[UserController::class,'index']);

Route::post("telegram",[FluxoController::class,'telegramWebhook']);


Route::get("/eu",function (Request $request){

    return response()->json(['mensagem' => 'Isso é uma resposta da API']);
});
