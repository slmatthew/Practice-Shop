<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserEditRequest extends FormRequest
{
    public function rules()
    {
        return [
            '_user_id'                      => ['required', 'exists:users,id'],
            'name'                          => ['required', 'string', 'min:1', 'max:45'],
            'surname'                       => ['required', 'string', 'min:1', 'max:45'],
            'phone'                         => ['required', 'regex:/[0-9]{10}/'],
            'image'                         => ['file', 'mimes:jpeg,jpg,png', 'max:5000'],
            'username'                      => [
                'alpha:ascii',
                'min:5',
                function ($attribute, $value, $fail) {
                    $user = User::find(Auth::user()->id);

                    if(!is_null($value) && $value != $user->username) {
                        if(User::where('username', '=', $value)) {
                            $fail(__('validation.unique', ['attribute' => $attribute]));
                        }
                    }
                }
            ],
            'new_password'                  => [
                function ($attr, $val, $fail) {
                    if(mb_strlen($val) > 0 && mb_strlen($val) < 8) {
                        $fail(__('validation.min.string', ['min' => 8]));
                    }
                }
            ],
            'new_password_confirmation'     => ['same:new_password'],
        ];
    }
}
