<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'decimal:0,2'],
            'category_id' => ['exists:categories,id'],
            'hidden' => ['boolean'],
            'available' => ['boolean'],
            'image' => ['file', 'mimes:jpeg,jpg,png', 'max:5000']
        ];
    }

    public function getData(): array
    {
        return [
            'name' => $this->get('name') ?? 'unknown',
            'description' => $this->get('description') ?? '',
            'price' => $this->get('price') ?? 0,
            'category_id' => $this->get('category_id'),
            'hidden' => $this->get('hidden') ?? 0,
            'available' => $this->get('available') ?? 0
        ];
    }
}
