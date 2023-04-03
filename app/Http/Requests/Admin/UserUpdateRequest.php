<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string', 'min:1', 'max:45'],
            'surname' => ['required', 'string', 'min:1', 'max:45'],
            'phone' => ['nullable', 'regex:/[0-9]{10}/'],
            'role' => ['in:user,admin'],
            'deleteImage' => ['boolean']
        ];
    }
}
