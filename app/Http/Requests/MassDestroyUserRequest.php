<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyUserRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('Pode excluir usuário'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:users,id',
        ];
    }
}
