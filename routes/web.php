<?php

use App\Http\Controllers\AuthLoginRegisterController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SequencialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  

    return view('welcome');
});

Route::get('/teste', function () {

   /// Alert::info('Success Title', 'Success Message');

    return view('home.teste');
});


Route::controller(AuthLoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});



Route::controller(MenuController::class)->group(function () {
 

    Route::get('/menu', 'menu')->name('menu');
    Route::post('/createWelcome', 'createWelcome')->name('createWelcome');
    Route::post('/createOption', 'createOptionMenu')->name('createOption');
    Route::post('/check-option', 'checkOption')->name('checkOption');

});

Route::controller(SequencialController::class)->group(function() {

    Route::get('/sequencial', 'sequencial')->name('menu-sequencial');
    Route::post('/createMensagem', 'createMensagem')->name('create-sequencial');
    Route::post('/check-ordem', 'checkOrdem')->name('checkOrdem');
});

Route::controller(BotController::class)->group(function(){

    Route::get('/config', 'config')->name('config');
    Route::get('/config/bot', 'configBot')->name('configBot');

});