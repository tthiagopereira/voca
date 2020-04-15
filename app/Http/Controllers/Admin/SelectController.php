<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Number;
use Request;

class SelectController extends Controller
{
    // abre a página de informação de números selecionados
    // aprovados tanto no PIS como no PE
    public function index()
    {
        abort_unless(\Gate::allows('Pode acessar selecionados'), 403);

        $numbers = Number::where('status_pis','Aprovado')->where('status_pe','Aprovado')->get();

        return view('admin.selecionados.index', compact('numbers'));
    }

}
