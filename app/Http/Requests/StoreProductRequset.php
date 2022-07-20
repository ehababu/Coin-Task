<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequset extends FormRequest
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
            //
            'name' => 'required|string|min:3|max:60',
            'barcode' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'category_name' => 'required|string|min:3|max:60',
            'description' => 'required|string|min:3|max:150',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'keywords' => 'required|string|min:1|max:15',
            'active' => 'required|boolean'
        ];
    }
}
