<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function home(): \Illuminate\Contracts\View\View
    {
        return view('admin.home');
    }

    /* категории */
    public function categories(): \Illuminate\Contracts\View\View
    {
        return view('admin.home');
    }

    public function category($category_id): \Illuminate\Contracts\View\View
    {
        return view('admin.home');
    }

    /* пользователи */
    public function users(): \Illuminate\Contracts\View\View
    {
        return view('admin.home');
    }

    public function user($user_id): \Illuminate\Contracts\View\View
    {
        return view('admin.home');
    }

    /* заказы */
    public function orders(): \Illuminate\Contracts\View\View
    {
        return view('admin.home');
    }

    public function order($order_id): \Illuminate\Contracts\View\View
    {
        return view('admin.home');
    }
}
