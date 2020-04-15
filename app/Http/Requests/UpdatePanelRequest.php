<?php

namespace App\Http\Requests;

use App\Models\Number;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePanelRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('Pode editar painel');
    }

    public function rules()
    {
        return [
            'identification_edit' => [
                'required'
            ],
            'ip_edit' => [
                'required','ip'
            ],
        ];
    }
}
