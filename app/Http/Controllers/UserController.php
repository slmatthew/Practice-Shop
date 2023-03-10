<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user($user_id): \Illuminate\Contracts\View\View
    {
        $user = User::find($user_id);

        if(is_null($user)) abort(404);

        return view('user.user', ['user' => $user->toArray()]);
    }

    public function userMe(): \Illuminate\Contracts\View\View
    {
        return view('user.user', ['user' => auth()->user()->toArray()]);
    }
}
