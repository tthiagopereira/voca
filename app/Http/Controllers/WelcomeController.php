<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use Auth;

class WelcomeController extends Controller
{
    public function welcome()
    {
        if (Auth::user()) {


            return redirect()->action('HomeController@index');

        } else {


            /*
             * aqui eu tenho que verificar o ip da maquina, caso ela seja painel, redirecionar direto para painel section
            */

            $panels = Panel::all();

            $how_ip = pegaip();

            foreach ($panels as $panel) {

                if ($panel->ip == $how_ip) {
                    // vai pro painel
                    return redirect()->action('Panel\PanelViewController@specific');

                }
            }

            // caso contrário abre login.
            return view('auth.login');

        }


    }

}
