<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;

class RolesController extends Controller
{
    // abre a pagina para gerenciamento de funcões
    public function index()
    {
        abort_unless(\Gate::allows('Pode acessar funções'), 403);

        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    // abre a página para criar funções (pode ser modal)
    public function create()
    {
        abort_unless(\Gate::allows('Pode criar funções'), 403);

        $permissions = Permission::all()->pluck('title', 'id');

        return view('admin.roles.create', compact('permissions'));
    }

    // armazena uma função
    public function store(StoreRoleRequest $request)
    {
        abort_unless(\Gate::allows('Pode criar funções'), 403);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');
    }

    // abre página de edição de funções
    public function edit(Role $role)
    {
        abort_unless(\Gate::allows('Pode editar funções'), 403);

        $permissions = Permission::all()->pluck('title', 'id');

        $role->load('permissions');

        return view('admin.roles.edit', compact('permissions', 'role'));
    }

    // update uma função
    public function update(UpdateRoleRequest $request, Role $role)
    {
        abort_unless(\Gate::allows('Pode editar funções'), 403);

        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');
    }

    // abre página para mostrar detalhes de uma função (pode ser modal)
    public function show(Role $role)
    {
        abort_unless(\Gate::allows('Pode ver funções'), 403);

        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }

    // remove uma função
    public function destroy(Role $role)
    {
        abort_unless(\Gate::allows('Pode excluir funções'), 403);

        $role->delete();

        return back();
    }

    // remoção em massa
    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }

}
