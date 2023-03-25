<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class AddDiscountRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:price,percent'],
            'amount' => ['required', 'decimal:0,2', function ($attr, $val, $fail) {
                $type = $this->request->get('type');

                if($type == 'price') {
                    $product = Product::findOrFail($this->request->get('product_id'));

                    if($val >= $product->price) {
                        $fail(__('validation.max.numeric', ['attribute' => 'новая цена', 'max' => $product->price-1]));
                    } elseif($val < 1) {
                        $fail(__('validation.min.numeric', ['attribute' => 'новая цена', 'min' => 1]));
                    }
                } else {
                    if($val > 99) {
                        $fail(__('validation.max.numeric', ['attribute' => 'новая цена', 'max' => 99]));
                    } elseif($val < 1) {
                        $fail(__('validation.min.numeric', ['attribute' => 'новая цена', 'min' => 1]));
                    }
                }
            }],
            /*'end_date' => ['nullable', 'date', function ($attribute, $value, $fail) {
                $maxDate = Carbon::now()->addMonth();
                if (Carbon::parse($value)->gt($maxDate)) {
                    $fail(__('validation.before', ['attribute' => $attribute, 'date' => $maxDate]));
                }
            }]*/
        ];
    }

    public function getData()
    {
        return $this->only(['product_id', 'type', 'amount']);
    }
}
