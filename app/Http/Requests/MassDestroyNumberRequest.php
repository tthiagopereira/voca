<?php

namespace App\Http\Requests;

use App\Models\Number;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyNumberRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('Pode excluir números'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:numbers,id',
        ];
    }
}
