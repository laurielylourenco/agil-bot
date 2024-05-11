<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware('auth')->except('login');
    }


    public function history()
    {

        $user = auth()->user();

      /*   $contas = Bot::where([
            'usuario' => $user->email
        ])->get(); */


        return view('home.history');
    }
}
