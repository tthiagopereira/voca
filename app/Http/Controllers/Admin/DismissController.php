<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Number;
use Request;

class DismissController extends Controller
{
    // abre a página de listagem de números dispensados
    // tanto faz se é no pis ou PE
    public function index()
    {
        abort_unless(\Gate::allows('Pode acessar dispensados'), 403);

        $numbers = Number::where(function($q) {
                $q->where('status_pis', 'Reprovado')
                    ->orWhere('status_pe', 'Reprovado');
            })
            ->get();

        return view('admin.dispensados.index', compact('numbers'));
    }

}
