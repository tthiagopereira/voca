<?php

namespace App\Http\Requests;

use App\Models\Number;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNumberRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('Pode editar números');
    }

    public function rules()
    {
        return [
            'number_edit' => [
                'required','numeric','min:1'
            ],
        ];
    }
}
