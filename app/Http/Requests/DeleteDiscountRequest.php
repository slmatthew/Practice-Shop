<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteDiscountRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => ['required', 'exists:products,id']
        ];
    }
}
