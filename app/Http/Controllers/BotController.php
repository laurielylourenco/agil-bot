<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class BotController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware('auth')->except('login');
    }


    public function config()
    {


        return view('home.config');
    }

    public function configBot() {

        return view('home.bot');
    }
}
