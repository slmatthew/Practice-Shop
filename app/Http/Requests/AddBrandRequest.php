<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBrandRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'unique:brands,name'],
            'slug' => ['string', 'required', 'min:1', 'unique:brands,slug'],
            'description' => ['string', 'max:1024'],
            'image' => ['required', 'file', 'mimes:jpeg,jpg,png', 'max:5000']
        ];
    }

    public function getData(): array
    {
        return $this->only(['name', 'slug', 'description', 'image']);
    }
}
