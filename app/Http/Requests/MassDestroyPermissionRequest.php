<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyPermissionRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('Pode excluir permissões'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:permissions,id',
        ];
    }
}
