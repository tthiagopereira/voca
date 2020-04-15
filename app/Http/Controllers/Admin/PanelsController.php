<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePanelRequest;
use App\Http\Requests\UpdatePanelRequest;
use App\Models\Panel;
use Request;

class PanelsController extends Controller
{
    // abre a página de gerenciamento de painéis
    public function index()
    {
        abort_unless(\Gate::allows('Pode acessar Administração de guichês'), 403);

        $panels = Panel::all();

        return view('admin.panels.index', compact('panels'));
    }

    // armazena um painel
    public function store(StorePanelRequest $request)
    {
        abort_unless(\Gate::allows('Pode criar painel'), 403);

        $new_panel_ip = $request['ip'];

        // verifica se o painel cadastrado já existe
        $count_existent_panel = Panel::where('ip', $new_panel_ip)->count();

        // você não pode criar um número que já foi criado
        if ($count_existent_panel === 1) {
            // erro

            Request::session()->flash('error', 'Você não pode cadastrar um Painel com um IP já cadastrado!.');

            return redirect()->route('admin.panels.index');
        } else {

            $panel = Panel::create($request->all());

            Request::session()->flash('acao', 'Painel Cadastrado com Sucesso!.');

            return redirect()->route('admin.panels.index');
        }

    }

    // update de painel
    public function update(UpdatePanelRequest $request, Panel $panel)
    {

        abort_unless(\Gate::allows('Pode editar painel'), 403);

        $new_panel_ip = $request['ip_edit'];
        $new_panel_identification = $request['identification_edit'];
        $panel_id = $request['panel_edit_id'];
        $chama_pa = $request['chama_pa'];
        $chama_pis = $request['chama_pis'];
        $chama_pe = $request['chama_pe'];

        $the_panel = Panel::find($panel_id);

        // verifica se o ip já existe no cadastro
        $count_existent_ip = Panel::where('ip', $new_panel_ip)->count();

        $my_ip_is_mine = $the_panel->ip;

        // você não pode criar um número que já foi criado
        if ($count_existent_ip === 1) {

            // se esse ip, por acaso fo o meu próprio.... posso manter....
            if ($my_ip_is_mine == $new_panel_ip){

                Request::session()->flash('acao', 'Painel Alterado com Sucesso!.');

                $the_panel->update([
                    'identification' => $new_panel_identification,
                    'chama_pa'=> $chama_pa,
                    'chama_pis'=> $chama_pis,
                    'chama_pe'=> $chama_pe
                ]);

                // falta alterar o que o painel pode ou não chamar

                return redirect()->route('admin.panels.index');


            } else {

                // erro

                Request::session()->flash('error', 'Você não pode cadastrar um ip já existente!.');

            }

            return redirect()->route('admin.panels.index');

        } else {

            Request::session()->flash('acao', 'Painel Alterado com Sucesso!.');

            $the_panel->update([
                'identification' => $new_panel_identification,
                'ip' => $new_panel_ip,
                'chama_pa'=> $chama_pa,
                'chama_pis'=> $chama_pis,
                'chama_pe'=> $chama_pe
            ]);

            return redirect()->route('admin.panels.index');
        }

    }

    // exclui um painel
    public function destroy($id)
    {
        abort_unless(\Gate::allows('Pode excluir painel'), 403);

        $panel = Panel::find($id);

        $panel->delete();

        Request::session()->flash('acao', 'Painel excluído com Sucesso!');

        return back();
    }

    // mostra detalhes de um painel
    public function show($panel)
    {
        abort_unless(\Gate::allows('Pode editar painel'), 403);

        $retorno = Panel::find($panel);

        return $retorno;
    }

}
