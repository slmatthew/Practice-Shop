<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPromocodeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'promocode' => ['required', 'string', 'min:2', 'max:30', 'unique:promocodes,promocode'],
            'discount' => ['required', 'integer', 'between:1,99'],
            'activation_limit' => ['nullable', 'integer', 'min:0', 'max:100000'],
            'expires_at' => ['nullable', 'date', 'after:today', 'before:+1 week']
        ];
    }

    public function getData()
    {
        $data = $this->only(['promocode', 'discount', 'activation_limit', 'expires_at']);

        $data['discount'] = (int)$data['discount'];
        $data['activation_limit'] = (int)$data['activation_limit'];

        return $data;
    }
}
