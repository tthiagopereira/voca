<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;

class PermissionsController extends Controller
{
    // chama a pagina de acesso a permissões
    public function index()
    {
        abort_unless(\Gate::allows('Pode acessar permissões'), 403);

        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    // chama a página de criar permissões (pode ser via modal)
    public function create()
    {
        abort_unless(\Gate::allows('Pode criar permissões'), 403);

        return view('admin.permissions.create');
    }

    // armazena uma permissão
    public function store(StorePermissionRequest $request)
    {
        abort_unless(\Gate::allows('Pode criar permissões'), 403);

        $permission = Permission::create($request->all());

        return redirect()->route('admin.permissions.index');
    }

    // chama a página de editar uma permissão (pode ser via modal)
    public function edit(Permission $permission)
    {
        abort_unless(\Gate::allows('Pode editar permissões'), 403);

        return view('admin.permissions.edit', compact('permission'));
    }

    // update uma permissão
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        abort_unless(\Gate::allows('Pode editar permissões'), 403);

        $permission->update($request->all());

        return redirect()->route('admin.permissions.index');
    }

    // mostra detralhes de uma permissão (Chamando uma página... pode ser via modal)
    public function show(Permission $permission)
    {
        abort_unless(\Gate::allows('Pode ver permissões'), 403);

        return view('admin.permissions.show', compact('permission'));
    }

    // exclui uma permissão
    public function destroy(Permission $permission)
    {
        abort_unless(\Gate::allows('Pode excluir permissões'), 403);

        $permission->delete();

        return back();
    }

    // destruição em masssa de permissões
    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }

}
