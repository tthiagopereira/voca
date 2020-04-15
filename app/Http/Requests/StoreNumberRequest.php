<?php

namespace App\Http\Requests;

use App\Models\Number;
use Illuminate\Foundation\Http\FormRequest;

class StoreNumberRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('Pode criar número');
    }

    public function rules()
    {
        return [
            'number' => [
                'required','numeric','min:1'
            ],
        ];
    }
}
