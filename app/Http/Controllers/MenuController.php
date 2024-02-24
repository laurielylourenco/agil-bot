<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth')->except('login');
    }

    public function menu()
    {

        $user = auth()->user();

        $prencher_welcome =  Menu::where([
            'usuario' => $user->email,
            'option' => "0"
        ])->first();

        $prencher_first =  Menu::where([
            'usuario' => $user->email,
            'option' => "1"
        ])->first();

            
        $wel = (is_null($prencher_welcome) ? "Seja bem vindo AgilBot!" : $prencher_welcome->resposta); 
        //cvxc dfgdfg
        return view('home.menu', ['welcome_msg' => $wel]);
    }

    public function createWelcome(Request $request)
    {

        try {
            $request->validate([
                'msg_welcome' => 'required|string|min:5',
                'option_welcome' => 'required|string|max:2',
                'email_welcome' => 'required|email'
            ]);

            $menu =  Menu::where([
                'option' => $request->option_welcome,
                'usuario' => $request->email_welcome, // 
            ])->get();


            if (count($menu) == 0) {

                Menu::create([
                    'usuario' => $request->email_welcome,
                    'option' => $request->option_welcome,
                    'menu' => "",
                    'resposta' => $request->msg_welcome
                ]);
            } else {

                $menu->toQuery()->update([
                    'resposta' => $request->msg_welcome
                ]);
            }

            $prencher =  Menu::where([
                'option' => $request->option_welcome,
                'usuario' => $request->email_welcome, // 
            ])->first();


            return redirect()->route('menu')->with('success', 'Operação realizada com sucesso!')->with('welcome_msg', $prencher->resposta);
        } catch (\Exception $e) {
            // Captura e trata outros erros
            //var_export($e);
            return redirect()->route('menu')->with('error', "Erro ao criar saudação")->with('welcome_msg', "errrrrroiu");
        }
    }


    public function createOptionMenu(Request $request)
    {

        try {
            $request->validate([
                'menu' => 'required|string|max:50',
                'resposta' => 'required|string',
                'option' => 'required|string|max:2',
                'email' => 'required|email'
            ]);

            $menu =  Menu::where([
                'option' => $request->option,
                'usuario' => $request->email, // 
            ])->get();


            if (count($menu) == 0) {


                Menu::create([
                    'usuario' => $request->email,
                    'option' => $request->option,
                    'menu' => $request->menu,
                    'resposta' => $request->resposta
                ]);
            } else {

                $menu->toQuery()->update([
                    'menu' => $request->menu,
                    'resposta' => $request->resposta
                ]);
            }
            return redirect()->route('menu')->with('success', 'Operação realizada com sucesso!')->with('welcome_msg', "errrrrroiu");;
        } catch (\Exception $e) {
            // Captura e trata outros erros
            return redirect()->route('menu')->with('error', "Erro ao criar menu")->with('welcome_msg', "errrrrroiu");;
        }
    }

    public function checkOption(Request $request)
    {
        $optionData = Menu::where([
            'option' => $request->option,
            'usuario' => $request->email,
        ])->first();

        if ($optionData) {
            return response()->json(['hasData' => true, 'menu' => $optionData->menu, 'resposta' => $optionData->resposta]);
        } else {
            return response()->json(['hasData' => false]);
        }
    }
}
