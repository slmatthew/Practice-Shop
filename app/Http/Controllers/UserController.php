<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function user($user_id): \Illuminate\Contracts\View\View
    {
        $user = User::find($user_id);

        if(is_null($user)) abort(404);

        $orders_count = Order::select('id')->where('user_id', '=', $user->id)->where('checkout', '>', 0)->count();
        $orders_items = [];
        $orders_prices = [];

        if(Auth::check() && Auth::user()->id == $user->id) {
            $orders_items = Order::where('checkout', '>', 0)->orderBy('updated_at', 'desc')->limit(5)->get()->toArray();

            foreach($orders_items as $order) {
                $products = OrderItem::select('product_id', 'quantity')->where('order_id', '=', $order['id'])->orderBy('updated_at', 'desc')->get()->toArray();
                foreach($products as $product) {
                    $product_db = Product::find($product['product_id']);

                    isset($orders_prices[$order['id']]) ? $orders_prices[$order['id']] += $product_db->price * $product['quantity'] : $orders_prices[$order['id']] = $product_db->price * $product['quantity'];
                }
            }
        }

        return view('user.user', [
            'user' => $user->toArray(),
            'orders' => [
                'items' => $orders_items,
                'prices' => $orders_prices,
                'count' => $orders_count
            ]]);
    }
}
