<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalledNumber;
use App\Models\Color;
use App\Models\Guiche;
use App\Models\Number;
use Request;

class PeCallsController extends Controller
{
    // abre a página de gerenciamento de números
    public function index()
    {
        abort_unless(\Gate::allows('Pode acessar gerenciamento de chamadas (PE)'), 403);

        $ip_maq = pegaip();


        $qual_guiche = Guiche::where('ip', $ip_maq)->first();


        if ($qual_guiche != NULL) {

            $numbers = Number::where('status_pis', 'Aprovado')->where('pe', '0')->get();

            // sugere o próximo número

            $sugested_number = Number::where('status_pis', 'Aprovado')->where('pe', '0')->min('number');

            $sugested_number_object = Number::where('number', $sugested_number)->get();

            $numbers_in = Number::where('pe', 1)->where('status_pe', null)->orderBy('number', 'desc')->get();

            return view('admin.peCalls.index', compact('numbers', 'sugested_number_object', 'numbers_in', 'qual_guiche'));

        } else {

            return view('home');

        }


    }

    // chama um número
    public function call($id)
    {

        abort_unless(\Gate::allows('Pode chamar número PE'), 403);

        $number = Number::find($id);

        // já foi chamado... não pode chamar
        if ($number->pe == 1){

            // deve retornar qual guichê chamou

            $qual_guiche_id = $number->guiche_id;

            $qual_guiche = Guiche::find($qual_guiche_id);

            return ['error_called_number',$qual_guiche->identification];

        }
        // aqui pode chamar
        else {

            // pego o IP da maquina que chamou o numero
            $ip_maq = pegaip();

            $qual_guiche = Guiche::where('ip', $ip_maq)->first();

            $number->update(['pe' => 1, 'guiche_id' => $qual_guiche->id]);

            // novo numero para entrar no numero sugerido
            $sugested_number = Number::where('status_pis', 'Aprovado')->where('pe', 0)->min('number');

            $sugested_number_object = Number::where('number', $sugested_number)->first();

            // pode ser que não existam números sugeridos
            if ($sugested_number_object == null){
                $sugested_id = null;
                $sugested_new_number = null;
            } else {
                $sugested_id = $sugested_number_object->id;
                $sugested_new_number = $sugested_number_object->number;
            }

            // transformo para facilitar na view
            $sugested_number_transform =  $sugested_id. '_' . $sugested_new_number;

            // aqui eu crio a estrutura que será adicionada na tela (numeros em atendimento)

            $called_number = $number->id . '_' . $number->number;

            // inserir o numero chamado na estrutura criada para o painel

            $color = Color::first();
            $pe_color_line = $color->color_pe;
            $pe_name_color_line = $color->color_name_pe;
            // pego o IP da maquina que chamou o numero
            $ip_maq = pegaip();

            $qual_guiche = Guiche::where('ip', $ip_maq)->first();

            CalledNumber::create([
                'number'=>$number->number,
                'where'=>'Entrevista',
                'color_line' => $pe_color_line,
                'name_color_line' =>  $pe_name_color_line,
                'guiche' => $qual_guiche->identification
            ]);

            return [$sugested_number_transform, $called_number];

        }

    }

    // rechama um número
    public function recall($id)
    {

        abort_unless(\Gate::allows('Pode chamar número PE'), 403);

        $number = Number::find($id);

        $ip_maq = pegaip();

        $qual_guiche = Guiche::where('ip', $ip_maq)->first();

        $color = Color::first();
        $pe_color_line = $color->color_pe;
        $pe_name_color_line = $color->name_color_pe;

        CalledNumber::create([
            'number' => $number->number,
            'where' => 'Entrevista',
            'guiche'=> $qual_guiche->identification,
            'color_line' => $pe_color_line,
            'name_color_line' => $pe_name_color_line,
        ]);

        return 'success';

    }

    // aprova de número
    public function approve($id)
    {

        abort_unless(\Gate::allows('Pode aprovar / reprovar números PE'), 403);

        $number_approved = Number::find($id);

        $number_approved->update(['status_pe' => 'Aprovado']);

        Request::session()->flash('acao', 'Número aprovado pelo PE com Sucesso!.');

        return back();


    }

    // reprova de número
    public function reprove($id)
    {

        abort_unless(\Gate::allows('Pode aprovar / reprovar números PE'), 403);

        $number_reproved = Number::find($id);

        $number_reproved->update(['status_pe' => 'Reprovado']);

        Request::session()->flash('acao', 'Número reprovado pelo PE com Sucesso!.');

        return back();


    }

    // retorna qual é o próximo numero a ser chamado
    public function suggested()
    {

        abort_unless(\Gate::allows('Pode chamar número PE'), 403);


        $sugested_number = Number::where('status_pis', 'Aprovado')->where('pe', 0)->min('number');
        $sugested_number_object = Number::where('number', $sugested_number)->first();


        return $sugested_number_object;


    }

}
