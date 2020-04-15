<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('Pode criar permissões');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
            ],
        ];
    }
}
