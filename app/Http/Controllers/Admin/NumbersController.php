<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNumberRequest;
use App\Http\Requests\StoreNumberRequest;
use App\Http\Requests\UpdateNumberRequest;
use App\Models\CalledNumber;
use App\Models\Color;
use App\Models\Guiche;
use App\Models\Number;
use Request;

class NumbersController extends Controller
{
    // abre a página de gerenciamento de números
    public function index()
    {
        abort_unless(\Gate::allows('Pode acessar números'), 403);

        $numbers = Number::orderBy('number','desc')->get();

        // sugere o próximo número

        $bigger_number = Number::max('number');
        $sugested_number = $bigger_number +1;

        return view('admin.numbers.index', compact('numbers','sugested_number'));
    }

    // armazena um número
    public function store(StoreNumberRequest $request)
    {
        abort_unless(\Gate::allows('Pode criar número'), 403);

        $new_number = $request['number'];

        // verifica se o numero cadastrado já existe
        $count_existent_number = Number::where('number',$new_number)->count();

        // você não pode criar um número que já foi criado
        if ($count_existent_number === 1){
            // erro

            Request::session()->flash('error', 'Você não pode cadastrar um número já existente!.');

            return redirect()->route('admin.numbers.index');
        }else{

            $number = Number::create($request->all());

            Request::session()->flash('acao', 'Número Cadastrado com Sucesso!.');

            return redirect()->route('admin.numbers.index');
        }



    }

    // update de número
    public function update(UpdateNumberRequest $request, Number $number)
    {

        abort_unless(\Gate::allows('Pode editar números'), 403);

        $new_number = $request['number_edit'];

        // verifica se o numero cadastrado já existe
        $count_existent_number = Number::where('number',$new_number)->count();

        // você não pode criar um número que já foi criado
        if ($count_existent_number === 1){
            // erro

            Request::session()->flash('error', 'Você não pode cadastrar um número já existente!.');

            return redirect()->route('admin.numbers.index');
        }else{

            Request::session()->flash('acao', 'Número Alterado com Sucesso!.');

            $number->update(['number' => $new_number]);

            return redirect()->route('admin.numbers.index');
        }



    }

    // mostra detalhes de um número
    public function show(Number $number)
    {
        abort_unless(\Gate::allows('Pode ver detalhes de um número'), 403);

        return $number;
    }

    // exclui um número
    public function destroy(Number $number)
    {
        abort_unless(\Gate::allows('Pode excluir números'), 403);

        $number->delete();

        return back();
    }

    // exclui em massa números
    public function massDestroy(MassDestroyNumberRequest $request)
    {

        abort_unless(\Gate::allows('Pode excluir números'), 403);

        Number::whereIn('id', request('ids'))->delete();

        return response(null, 204);

        //return $request;
    }

    // exclui todos os numeros
    public function allDestroy()
    {
        abort_unless(\Gate::allows('Pode excluir números'), 403);

        $numbers = Number::all();

        foreach ($numbers as $number){
            $number->delete();
        }


        return response(null, 204);

        //return $request;
    }

    // exclui todos os numeros dos painéis
    public function panelDestroy()
    {
        abort_unless(\Gate::allows('Pode excluir números'), 403);

        $numbers = CalledNumber::all();

        foreach ($numbers as $number){
            $number->delete();
        }


        return response(null, 204);

        //return $request;
    }

    // aprova de número (confere dados do PA)
    public function confirme($id)
    {

        abort_unless(\Gate::allows('Pode confirmar um número'), 403);

        $number_confirmed = Number::find($id);

        // o número ja foi confirmado
        if ($number_confirmed->status_pa == 1){

           $retorno = 'error';

        }
        else{
            $number_confirmed->update(['status_pa' => true]);

            $retorno = 'success';
        }

        return $retorno;

    }

    // chama um número
    public function call($id)
    {

        abort_unless(\Gate::allows('Pode confirmar um número'), 403);

        $number = Number::find($id);

        // já foi chamado... não pode chamar
        if ($number->pis == 1){

            return 'error';

        }
        // aqui pode chamar
        else {

            $color = Color::first();
            $pa_color_line = $color->color_pa;
            $pa_name_color_line = $color->name_color_pa;

            CalledNumber::create([
                'number'=>$number->number,
                'where'=>'Atendimento',
                'color_line' =>  $pa_color_line,
                'name_color_line' =>  $pa_name_color_line,
            ]);

            return 'success';

        }

    }

}
