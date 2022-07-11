<?php

namespace App\Http\Requests\Admin\Item;

use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        //TODO add request persian translate
        $roles = [
            'creative' => ['required'],
            'course' => ['required'],
        ];
        $creative = $this->request->get('creative');
        if ($creative == 1) {
            $roles['season'] = ['required'];
        }
        if ($creative == 2) {
            $roles['parent_id'] = ['required'];
            $roles['title'] = ['required'];
            $roles['title.*'] = ['required'];
            $roles['url'] = ['required'];
            $roles['url.*'] = ['required'];
            $roles['is_free'] = ['required'];
            $roles['is_free.*'] = ['required', 'integer'];
        }
        return $roles;
    }
}
