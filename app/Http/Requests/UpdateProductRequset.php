<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequset extends FormRequest
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
            'barcode' => 'required|string',
            'category' => 'required|integer|exists:categories,id',
            'description' => 'required|string|min:3|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'keywords' => 'required|string|min:1|max:60',
            'price' => 'required|string',
            'coin' => 'required|integer|exists:coins,id',
            'active' => 'required|boolean'
        ];
    }
}