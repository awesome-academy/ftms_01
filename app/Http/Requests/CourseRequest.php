<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'date_start' => 'before:date_end',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5024',
            'name' => 'unique:courses'
        ];
    }

    public function messages()
    {
        return [
            'date_start.before' => trans('message.error_date'),
            'image.image' => trans('validation.file'),
            'image.mimes' => trans('validation.exists'),
            'image.max' => trans('validation.max'),
            'name.unique' => trans('validation.unique')
        ];
    }
}
