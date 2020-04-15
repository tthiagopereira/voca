<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalledNumber;
use App\Models\Color;
use App\Models\Number;
use Request;

class PisCallsController extends Controller
{
    // abre a página de gerenciamento de números
    public function index()
    {
        abort_unless(\Gate::allows('Pode acessar gerenciamento de chamadas (PIS)'), 403);

        $numbers = Number::where('status_pa', 1)->where('pis', 0)->get();

        // sugere o próximo número

        $sugested_number = Number::where('status_pa', 1)->where('pis', 0)->min('number');

        $sugested_number_object = Number::where('number', $sugested_number)->get();

        $numbers_in = Number::where('pis', 1)->where('status_pis', null)->orderBy('number', 'desc')->get();

        return view('admin.pisCalls.index', compact('numbers', 'sugested_number_object', 'numbers_in'));
    }

    // chama um número
    public function call($id)
    {

        abort_unless(\Gate::allows('Pode chamar número PIS'), 403);

        $number = Number::find($id);

        // já foi chamado... não pode chamar
        if ($number->pis == 1) {

            return ['error_called_number', 'error_called_number'];

        } // aqui pode chamar
        else {

            $number->update(['pis' => 1]);

            // novo numero para entrar no numero sugerido
            $sugested_number = Number::where('status_pa',1)->where('pis', 0)->min('number');
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
            $pis_color_line = $color->color_pis;
            $pis_name_color_line = $color->name_color_pis;

            CalledNumber::create([
                'number' => $number->number,
                'where' => 'Inspeção',
                'color_line' => $pis_color_line,
                'name_color_line' => $pis_name_color_line,
            ]);

            return [$sugested_number_transform, $called_number];

        }

    }

    // rechama um número
    public function recall($id)
    {

        abort_unless(\Gate::allows('Pode chamar número PIS'), 403);

        $number = Number::find($id);

        $color = Color::first();
        $pis_color_line = $color->color_pis;
        $pis_name_color_line = $color->name_color_pis;

        CalledNumber::create([
            'number' => $number->number,
            'where' => 'Inspeção',
            'color_line' => $pis_color_line,
            'name_color_line' =>  $pis_name_color_line,
        ]);

        return 'success';

    }

    // aprova de número
    public function approve($id)
    {

        abort_unless(\Gate::allows('Pode aprovar / reprovar números PIS'), 403);

        $number_approved = Number::find($id);

        $number_approved->update(['status_pis' => 'Aprovado']);

        Request::session()->flash('acao', 'Número aprovado pelo PIS com Sucesso!.');

        return back();


    }

    // reprova de número
    public function reprove($id)
    {

        abort_unless(\Gate::allows('Pode aprovar / reprovar números PIS'), 403);

        $number_reproved = Number::find($id);

        $number_reproved->update(['status_pis' => 'Reprovado']);

        Request::session()->flash('acao', 'Número reprovado pelo PIS com Sucesso!.');

        return back();


    }

    // exclui um número
    public function destroy(Number $number)
    {
        abort_unless(\Gate::allows('Pode excluir números PIS'), 403);

        $number->delete();
    }

    // retorna qual é o próximo numero a ser chamado
    public function suggested()
    {

        abort_unless(\Gate::allows('Pode chamar número PIS'), 403);


        $sugested_number = Number::where('pis', 0)->min('number');
        $sugested_number_object = Number::where('number', $sugested_number)->first();


        return $sugested_number_object;


    }

}
