<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\CalledNumber;
use App\Models\Panel;
use Request;

class PanelViewController extends Controller
{
    // abre a página de gerenciamento de painéis
    public function index()
    {

        return view('panels.index');
    }

    public function specific()
    {


        // se o usuário não for painel, NÃO TEM PQ ESTAR AQUI.
        $how_ip = pegaip();

        $panelaa = Panel::where('ip', $how_ip)->get();


        // se o numero é um, é pq o IP pertence a painel, e deve ir para a tela
        if ($panelaa->count() == 1){

            // vai pro painel
            return view('panels.specific');

        }


        // caso contrário abre login.
        return view('auth.login');


    }

    public function geralPanel()
    {

        // encontra os 4 ultimos numeros
        $numbers = CalledNumber::orderBy('updated_at','desc')->limit('4')->get();

        return $numbers;

    }

    public function specificPanel()
    {


        // se o usuário não for painel, NÃO TEM PQ ESTAR AQUI.
        $how_ip = pegaip();

        $panelaa = Panel::where('ip', $how_ip)->get();

        //se a contagem for 0, significa que o computador não é painel e deve ser ejetado
        if ($panelaa->count() == 0){

            // vai pro login
            return view('auth.login');

        }

        // caso a contagem seja 1 , prossegue

        // pega a informação e verifica o que precisa por na tela

        $panel = Panel::where('ip',$how_ip)->first();

        // aqui tenho que verificar se o painel chama o PA, PIS e PE
        // admite SIm e Null
        $chama_pa = $panel->chama_pa;
        $chama_pis = $panel->chama_pis;
        $chama_pe = $panel->chama_pe;

        /*
         * PA
         * PA - PIS
         * PA - PE
         * PA - PIS - PE
         *
         * PIS
         * PIS - PE
         *
         * PE
         */

        // PA
        if ($chama_pa == 'Sim' && $chama_pis == null && $chama_pe == null){

            $numbers = CalledNumber::where('where','Atendimento')->orderBy('updated_at','desc')->limit('4')->get();

        }
        // PA - PIS
        elseif ($chama_pa == 'Sim' && $chama_pis == 'Sim' && $chama_pe == null){

            $numbers = CalledNumber::where('where','Atendimento')->where('where','Inspeção')->orderBy('updated_at','desc')->limit('4')->get();

        }
        // PA - PE
        elseif ($chama_pa == 'Sim' && $chama_pis == null && $chama_pe == 'Sim'){

            $numbers = CalledNumber::where('where','Atendimento')->where('where','Entrevista')->orderBy('updated_at','desc')->limit('4')->get();

        }
        // PA - PIS - PE
        elseif ($chama_pa == 'Sim' && $chama_pis == 'Sim' && $chama_pe == 'Sim'){

            $numbers = CalledNumber::orderBy('updated_at','desc')->limit('4')->get();
        }
        // PIS
        elseif ($chama_pa == null && $chama_pis == 'Sim' && $chama_pe == null){

            $numbers = CalledNumber::where('where','Inspeção')->orderBy('updated_at','desc')->limit('4')->get();

        }
        // PIS - PE
        elseif ($chama_pa == null && $chama_pis == 'Sim' && $chama_pe == 'Sim'){

            $numbers = CalledNumber::where('where','Inspeção')->where('where','Entrevista')->orderBy('updated_at','desc')->limit('4')->get();

        }
        // PE
        elseif ($chama_pa == null && $chama_pis == null && $chama_pe == 'Sim'){

            $numbers = CalledNumber::where('where','Entrevista')->orderBy('updated_at','desc')->limit('4')->get();

        }
        // Nenhum
        elseif ($chama_pa == null && $chama_pis == null && $chama_pe == null){

            $numbers = 'Null panel info';

        }

        return $numbers;

    }
}
