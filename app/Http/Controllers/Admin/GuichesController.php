<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuicheRequest;
use App\Http\Requests\UpdateGuicheRequest;
use App\Models\Guiche;
use Request;

class GuichesController extends Controller
{
    // abre a página de gerenciamento de números
    public function index()
    {
        abort_unless(\Gate::allows('Pode acessar Administração de guichês'), 403);

        $guiches = Guiche::all();


        return view('admin.guiches.index', compact('guiches'));
    }

    // armazena um guichê
    public function store(StoreGuicheRequest $request)
    {
        abort_unless(\Gate::allows('Pode criar guichê'), 403);

        $new_guiche_ip = $request['ip'];

        // verifica se o guiche cadastrado já existe
        $count_existent_guiche = Guiche::where('ip', $new_guiche_ip)->count();

        // você não pode criar um número que já foi criado
        if ($count_existent_guiche === 1) {
            // erro

            Request::session()->flash('error', 'Você não pode cadastrar um Guichê com um IP já cadastrado!.');

            return redirect()->route('admin.guiches.index');
        } else {

            $guiche = Guiche::create($request->all());

            Request::session()->flash('acao', 'Guichê Cadastrado com Sucesso!.');

            return redirect()->route('admin.guiches.index');
        }

    }

    // update de guiche
    public function update(UpdateGuicheRequest $request, Guiche $guiche)
    {

        abort_unless(\Gate::allows('Pode alterar guichê'), 403);

        $new_guiche_ip = $request['ip_edit'];
        $new_guiche_identification = $request['identification_edit'];
        $guiche_id = $request['guiche_edit_id'];

        $the_guiche = Guiche::find($guiche_id);

        // verifica se o ip já existe no cadastro
        $count_existent_ip = Guiche::where('ip', $new_guiche_ip)->count();

        $my_ip_is_mine = $the_guiche->ip;

        // você não pode criar um número que já foi criado
        if ($count_existent_ip === 1) {

            // se esse ip, por acaso fo o meu próprio.... posso manter....
            if ($my_ip_is_mine == $new_guiche_ip){

                Request::session()->flash('acao', 'Guichê Alterado com Sucesso!.');

                $the_guiche->update(['identification' => $new_guiche_identification]);

                return redirect()->route('admin.guiches.index');


            } else {

                // erro

                Request::session()->flash('error', 'Você não pode cadastrar um ip já existente!.');

            }

            return redirect()->route('admin.guiches.index');

        } else {

            Request::session()->flash('acao', 'Guichê Alterado com Sucesso!.');

            $the_guiche->update(['identification' => $new_guiche_identification, 'ip' => $new_guiche_ip]);

            return redirect()->route('admin.guiches.index');
        }

    }

    // mostra detalhes de um guiche
    public function show($guiche)
    {
        abort_unless(\Gate::allows('Pode alterar guichê'), 403);

        $retorno = Guiche::find($guiche);

        return $retorno;
    }

    // exclui um guiche
    public function destroy($id)
    {
        abort_unless(\Gate::allows('Pode excluir guichê'), 403);

        $guiche = Guiche::find($id);

        $guiche->delete();

        Request::session()->flash('acao', 'Guichê excluído com Sucesso!');

        return back();
    }

}
