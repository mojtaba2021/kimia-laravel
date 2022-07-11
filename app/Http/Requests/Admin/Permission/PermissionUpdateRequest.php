<?php

namespace App\Http\Requests\Admin\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

// TODO you should make unique field
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
        ];
    }
}
