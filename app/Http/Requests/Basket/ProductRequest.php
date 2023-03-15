<?php

namespace App\Http\Requests\Basket;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => ['required', 'numeric', 'exists:products,id'],
            'quantity' => ['numeric', 'min:1', 'max:10']
        ];
    }
}
