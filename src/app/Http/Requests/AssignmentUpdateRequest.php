<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentUpdateRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            'author_name'=>'required'

        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required'=>'This is a required field.',
            'author_name.required'=>'This is a required field.'

        ];
    }
}
