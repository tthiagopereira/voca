<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreColorRequest;
use App\Models\Color;
use Request;

class ColorsController extends Controller
{
    // abre a página de gerenciamento de cores
    public function index()
    {
        abort_unless(\Gate::allows('Acesso a administração do sistema'), 403);

        $color = Color::first();


        return view('admin.colors.index', compact('color'));
    }

    // armazena as cores
    public function store(StoreColorRequest $request)
    {
        abort_unless(\Gate::allows('Acesso a administração do sistema'), 403);

        $how_many = Color::count();

        $color_pa = $request['color_pa'];
        $name_color_pa = $request['name_color_pa'];
        $blank_pa = $request['blank_pa'];
        $color_pis = $request['color_pis'];
        $name_color_pis = $request['name_color_pis'];
        $blank_pis = $request['blank_pis'];
        $color_pe = $request['color_pe'];
        $name_color_pe = $request['name_color_pe'];
        $blank_pe = $request['blank_pe'];

        if ($blank_pa == 1){
            $ajusted_pa = null;
            $ajusted_name_pa = null;
        } else {
            $ajusted_pa = $color_pa;
            $ajusted_name_pa = $name_color_pa;
        }
        if ($blank_pis == 1){
            $ajusted_pis = null;
            $ajusted_name_pis = null;
        } else {
            $ajusted_pis = $color_pis;
            $ajusted_name_pis = $name_color_pis;
        }
        if ($blank_pe == 1){
            $ajusted_pe = null;
            $ajusted_name_pe = null;
        } else {
            $ajusted_pe = $color_pe;
            $ajusted_name_pe = $name_color_pe;
        }

        if ($how_many == 0) {

            Color::create([
                'color_pa' => $ajusted_pa,
                'name_color_pa' => $ajusted_name_pa,
                'blank_pa' => $blank_pa,
                'color_pis' => $ajusted_pis,
                'name_color_pis' => $ajusted_name_pis,
                'blank_pis' => $blank_pis,
                'color_pe' => $ajusted_pe,
                'name_color_pe' => $ajusted_name_pe,
                'blank_pe' => $blank_pe,
            ]);
        } else {

            $color = Color::first();
            $color->update(
                [
                    'color_pa' => $ajusted_pa,
                    'name_color_pa' => $ajusted_name_pa,
                    'blank_pa' => $blank_pa,
                    'color_pis' => $ajusted_pis,
                    'name_color_pis' => $ajusted_name_pis,
                    'blank_pis' => $blank_pis,
                    'color_pe' => $ajusted_pe,
                    'name_color_pe' => $ajusted_name_pe,
                    'blank_pe' => $blank_pe,
                ]
            );

        }

            Request::session()->flash('acao', 'Cores ajustadas com Sucesso!.');

            return redirect()->route('admin.colors.index');


    }

}
