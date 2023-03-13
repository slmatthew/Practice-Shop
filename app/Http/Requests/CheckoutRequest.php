<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:45'],
            'surname' => ['required', 'string', 'min:1', 'max:45'],
            'phone' => ['required', 'regex:/[0-9]{10}/'],
            'saveData' => ['boolean']
        ];
    }
}
