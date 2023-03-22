<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => ['numeric', 'exists:brands,id'],
            'name' => ['string', 'required', function ($attr, $val, $fail) {
                $brand = Brand::where($attr, '=', $val)->limit(1)->get();
                if($brand->count() > 0) {
                    if($brand[0]->id != $this->get('id')) {
                        $fail(__('validation.unique', ['attribute' => $attr]));
                    }
                }
            }],
            'slug' => ['string', 'required', 'min:1', function ($attr, $val, $fail) {
                $brand = Brand::where($attr, '=', $val)->limit(1)->get();
                if($brand->count() > 0) {
                    if($brand[0]->id != $this->get('id')) {
                        $fail(__('validation.unique', ['attribute' => $attr]));
                    }
                }
            }],
            'description' => ['string', 'max:1024'],
            'image' => ['file', 'mimes:jpeg,jpg,png', 'max:5000']
        ];
    }

    public function getData(): array
    {
        return $this->only(['id', 'name', 'slug', 'description']);
    }
}
