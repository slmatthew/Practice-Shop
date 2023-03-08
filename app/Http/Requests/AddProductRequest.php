<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'decimal:0,2'],
            'image_url' => ['url'],
            'category_id' => ['exists:categories,id'],
            'hidden' => ['boolean'],
            'available' => ['boolean']
        ];
    }

    public function getData(): array
    {
        return [
            'name' => $this->get('name') ?? 'unknown',
            'description' => $this->get('description') ?? '',
            'price' => $this->get('price') ?? 0,
            'image_url' => $this->get('description') ?? 'https://vk.com/images/camera_200.png',
            'category_id' => $this->get('category_id'),
            'hidden' => $this->get('hidden') ?? 0,
            'available' => $this->get('available') ?? 0
        ];
    }
}
