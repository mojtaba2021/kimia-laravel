<?php

namespace App\Http\Requests\Admin\Course;

use Illuminate\Foundation\Http\FormRequest;

class CourseStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'image_url' => 'required',
            'url' => 'required',
            'description' => 'required',
            'actual_price' => 'required|integer|min:1000|max:50000000',
            'discount_price' => 'nullable|integer|min:1000|max:50000000',
            'course_lang' => 'required',
            'course_time' => 'required',
            'course_size' => 'required',
            'course_kind' => 'required',
        ];
    }
}
