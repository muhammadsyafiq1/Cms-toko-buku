<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
            'title' => 'required|max:100',
            'cover' => 'required|image',
            'publisher' => 'required',
            'author' => 'required',
            'stock' => 'required|digits_between:0,10',
            'price' => 'required|digits_between:0,10',
            'description' => 'required'
        ];
    }
}
