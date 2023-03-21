<?php

namespace App\Http\Controllers;

use App\Helpers\ImageSaver;
use App\Http\Requests\UserEditRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function user(User $user): \Illuminate\Contracts\View\View
    {
        $orders_count = Order::select('id')->where('user_id', '=', $user->id)->where('checkout', '>', 0)->count();
        $orders_items = [];
        $orders_prices = [];

        if(Auth::check() && Auth::user()->id == $user->id) {
            $orders_items = Order::where('checkout', '>', 0)->where('user_id', '=', $user->id)->orderBy('updated_at', 'desc')->limit(3)->get()->toArray();

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

    public function orders() {
        $orders = Order::where('checkout', '>', 0)->where('user_id', '=', Auth::user()->id)->orderBy('submitted_at', 'desc')->paginate(9);
        $prices = [];

        foreach($orders as $order) {
            $products = OrderItem::select('product_id', 'quantity')->where('order_id', '=', $order->id)->orderBy('updated_at', 'desc')->get()->toArray();
            foreach($products as $product) {
                $product_db = Product::find($product['product_id']);

                isset($prices[$order->id]) ? $prices[$order->id] += $product_db->price * $product['quantity'] : $prices[$order->id] = $product_db->price * $product['quantity'];
            }
        }

        return view('user.orders', ['orders' => $orders, 'prices' => $prices]);
    }

    public function order(Order $order) {
        if($order->user_id != Auth::user()->id) abort(404);

        $orderItems = OrderItem::where('order_id', '=', $order->id)->orderBy('updated_at', 'desc')->get();
        if(count($orderItems) > 0) {
            foreach($orderItems as $n => $item) {
                $orderItems[$n]['product'] = Product::find($item['product_id']);
            }
        }

        return view('user.order', ['order' => $order, 'orderItems' => $orderItems]);
    }

    /**
     * @todo дальняя перспектива: редактирование цвета обложки
     */
    public function edit() {
        return view('user.edit')
            ->with('user', Auth::user())
            ->with('orders_count', Order::select('id')->where('user_id', '=', Auth::user()->id)->where('checkout', '>', 0)->count());
    }

    public function doEdit(UserEditRequest $request) {
        if(!Auth::check() || $request->get('_user_id') != Auth::user()->id) abort(403);

        $user = User::find(Auth::user()->id);

        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->phone = $request->get('phone');

        if($request->has('username') && $request->get('username') != $user->username) {
            $user->username = $request->get('username');
        }

        $file = $request->file('image');
        if($file) {
            if(str_starts_with($user->image, env('APP_URL', 'https://shop.slmatthew.ru').'/storage/')) {
                Storage::disk('public')->delete(mb_substr($user->image, 9));
            }

            $user->image = ImageSaver::upload($file, 'users', true, 300, 300);
        }

        if($request->has('new_password') && $request->has('new_password_confirmation')) {
            $user->setPasswordAttribute($request->get('new_password'));
        }

        $user->save();

        return to_route('user.edit');
    }
}
