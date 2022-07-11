<?php

namespace App\Http\Requests\Admin\EducationalVideo;

use Illuminate\Foundation\Http\FormRequest;

class EducationalVideoUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'url' => ['required', 'string'],
            'youtube_link' => ['nullable', 'string'],
            'aparat_link' => ['nullable', 'string'],
            'is_active' => ['required'],
        ];
    }
}
