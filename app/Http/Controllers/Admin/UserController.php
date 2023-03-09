<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function main(): \Illuminate\Contracts\View\View
    {
        return view('admin.users.main', ['users' => User::get()->toArray()]);
    }
}
