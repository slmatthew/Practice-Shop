<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SimpleOrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'order_id' => ['required', 'exists:orders,id']
        ];
    }
}
