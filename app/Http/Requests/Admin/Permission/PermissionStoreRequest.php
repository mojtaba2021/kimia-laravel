<?php

namespace App\Http\Requests\Admin\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:permissions,name,NULL,id|string|max:255',
            'display_name' => 'required|unique:permissions,display_name,NULL,id|string|max:255',
        ];
    }
}
