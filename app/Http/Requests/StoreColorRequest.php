<?php

namespace App\Http\Requests;

use App\Models\Number;
use Illuminate\Foundation\Http\FormRequest;

class StoreColorRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('Acesso a administração do sistema');
    }

    public function rules()
    {
        return [


        ];
    }
}
