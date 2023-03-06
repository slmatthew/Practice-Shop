<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

    public function products(): \Illuminate\Contracts\View\View
    {
        $products = Product::get();
        return view('products', ['products' => $products]);
    }

    public function product($id = 0): \Illuminate\Contracts\View\View
    {
        $product = Product::where('id', $id)->first();

        return view('product', ['product' => $product]);
    }
}
