<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['string', 'required', 'min:1', 'unique:products,slug'],
            'price' => ['required', 'decimal:0,2'],
            'category_id' => ['exists:categories,id'],
            'brand_id' => ['exists_or_null:brands,id'],
            'hidden' => ['boolean'],
            'available' => ['boolean'],
            'image' => ['file', 'mimes:jpeg,jpg,png', 'max:5000']
        ];
    }

    public function getData(): array
    {
        return $this->only(['name', 'slug', 'description', 'price', 'category_id', 'brand_id', 'hidden', 'available']);
    }
}
