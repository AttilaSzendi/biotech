<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'src' => 'image',
            'published_from' => 'nullable|date',
            'published_until' => 'nullable|date',
            'price' => 'required|numeric'
        ];
    }
}
