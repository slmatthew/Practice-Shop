<?php

namespace App\Http\Requests\Basket;

use Illuminate\Foundation\Http\FormRequest;

class ExistingProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => ['required', 'numeric', 'exists:orders_items,id'],
            'product_id' => ['required', 'numeric', 'exists:products,id'],
            'quantity' => ['numeric', 'min:1', 'max:10']
        ];
    }
}
