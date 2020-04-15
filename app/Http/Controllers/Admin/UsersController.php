<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;

class UsersController extends Controller
{
    // abre página de gerenciamento de usuários
    public function index()
    {
        abort_unless(\Gate::allows('Pode acessar usuários'), 403);

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    // abre a página de criação de usuários
    public function create()
    {
        abort_unless(\Gate::allows('Pode criar usuário'), 403);

        $roles = Role::all()->pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    // armazena um usuário
    public function store(StoreUserRequest $request)
    {
        abort_unless(\Gate::allows('Pode criar usuário'), 403);

        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    // chama pagina para editar um usuário
    public function edit(User $user)
    {
        abort_unless(\Gate::allows('Pode editar usuário'), 403);

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    // update no usuário
    public function update(UpdateUserRequest $request, User $user)
    {
        abort_unless(\Gate::allows('Pode editar usuário'), 403);

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    // abre página com dados do usuário (pode ser modal)
    public function show(User $user)
    {
        abort_unless(\Gate::allows('Pode ver usuários'), 403);

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    // remove um usuário
    public function destroy(User $user)
    {
        abort_unless(\Gate::allows('Pode excluir usuário'), 403);

        $user->delete();

        return back();
    }

    // remove em massa
    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }

}
