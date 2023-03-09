<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(): \Illuminate\Contracts\View\View
    {
        return view('user.me', ['user' => auth()->user()->toArray()]);
    }
}
