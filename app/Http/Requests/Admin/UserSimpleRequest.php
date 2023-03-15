<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserSimpleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => ['required', 'exists:users,id']
        ];
    }
}
