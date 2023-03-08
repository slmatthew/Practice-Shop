<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoriesRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'unique:categories,name']
        ];
    }

    public function getData(): array
    {
        return [
            'name' => $this->get('name') ?? 'unknown'
        ];
    }
}
