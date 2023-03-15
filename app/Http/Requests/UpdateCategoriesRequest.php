<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Contracts\Validation\InvokableRule;
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
            'name' => ['string', 'required', function ($attr, $val, $fail) {
                $category = Category::where($attr, '=', $val)->limit(1)->get();
                if($category->count() > 0) {
                    if($category[0]->id != $this->get('id')) {
                        $fail(__('validation.unique', ['attribute' => $attr]));
                    }
                }
            }],
            'image' => ['file', 'mimes:jpeg,jpg,png', 'max:5000']
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
