<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function home(): \Illuminate\Contracts\View\View
    {
        $orders = [0, 0, 0, 0];

        $orders[0] = Order::where('checkout', '>', 0)->count();

        if($orders[0] != 0) {
            $orders[1] = Order::where('checkout', '=', 1)->count() / $orders[0] * 100;
            $orders[2] = Order::where('checkout', '=', 2)->count() / $orders[0] * 100;
            $orders[3] = Order::where('checkout', '=', 3)->count() / $orders[0] * 100;
        }

        $users = User::count();

        $products = [0, 0, 0];

        $products[0] = Product::count();

        if($products[0] != 0) {
            $products[1] = Product::where('hidden', '=', 1)->count() / $products[0] * 100;
            $products[2] = Product::where('hidden', '=', 0)->where('available', '=', 0)->count() / $products[0] * 100;
        }

        return view('admin.home', [
            'orders' => $orders,
            'users' => $users,
            'products' => $products
        ]);
    }
}
