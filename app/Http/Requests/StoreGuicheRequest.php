<?php

namespace App\Http\Requests;

use App\Models\Number;
use Illuminate\Foundation\Http\FormRequest;

class StoreGuicheRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('Pode criar guichê');
    }

    public function rules()
    {
        return [
            'identification' => ['required'],
            'ip' => [
                'required', 'ip'
            ]
        ];
    }
}
