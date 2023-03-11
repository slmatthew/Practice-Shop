<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{

    public function rules()
    {
        return [
            'image' => ['file', 'mimes:jpeg,jpg,png', 'max:5000']
        ];
    }
}
