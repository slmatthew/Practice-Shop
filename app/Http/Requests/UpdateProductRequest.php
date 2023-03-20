<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => ['required', 'exists:products,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['string', 'required', 'min:1', function ($attr, $val, $fail) {
                $brand = Product::where($attr, '=', $val)->limit(1)->get();
                if($brand->count() > 0) {
                    if($brand[0]->id != $this->get('id')) {
                        $fail(__('validation.unique', ['attribute' => $attr]));
                    }
                }
            }],
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
