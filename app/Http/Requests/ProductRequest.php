<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
    public function rules() {
        $rules = [
            'name' => 'required|max:250',
            'publish_date' => 'required|date',
            'text' => 'required|max:8000'
        ];
        #somente obrigatório quando for um novo
        if ($this->method() == "POST"){
            $rules['image'] = 'image|max:1024';
        } else
        if ($this->method() == "PUT"){
            $rules['image'] = 'image|max:1024';
        }

        return $rules;
    }
}