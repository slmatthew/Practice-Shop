<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => ['numeric', 'exists:categories,id'],
            'name' => ['string', 'required', 'unique:categories,name']
        ];
    }

    public function getData(): array
    {
        return [
            'id' => $this->get('id'),
            'name' => $this->get('name')
        ];
    }
}
