<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:roles,name,NULL,id|string|max:255',
            'display_name' => 'required|unique:roles,display_name,NULL,id|string|max:255',
        ];
    }
}
