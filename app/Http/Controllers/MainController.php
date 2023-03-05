<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main(): \Illuminate\Contracts\View\View
    {
        return view('welcome');
    }

    public function categories(): \Illuminate\Contracts\View\View
    {
        return view('categories');
    }

    public function product($product = 'test'): \Illuminate\Contracts\View\View
    {
        return view('product', ['product' => $product]);
    }
}
