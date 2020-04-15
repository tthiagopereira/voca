<?php

namespace App\Http\Requests;

use App\Models\Number;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGuicheRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('Pode alterar guichê');
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
