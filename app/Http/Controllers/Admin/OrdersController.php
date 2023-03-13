<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SimpleOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    private function getValidOrder(SimpleOrderRequest $request) {
        $order = Order::find($request->get('order_id'));
        if(!$order->exists() || $order->user_id != Auth::user()->id) abort(403);

        return $order;
    }

    public function index() {
        $orders = Order::where('checkout', '>', 0)->orderBy('submitted_at', 'desc')->paginate(15);
        $prices = [];

        foreach($orders as $order) {
            $products = OrderItem::select('product_id', 'quantity')->where('order_id', '=', $order->id)->orderBy('updated_at', 'desc')->get()->toArray();
            foreach($products as $product) {
                $product_db = Product::find($product['product_id']);

                isset($prices[$order->id]) ? $prices[$order->id] += $product_db->price * $product['quantity'] : $prices[$order->id] = $product_db->price * $product['quantity'];
            }
        }

        return view('admin.orders.index', ['orders' => $orders, 'prices' => $prices]);
    }

    public function item(Order $order) {
        $orderItems = OrderItem::where('order_id', '=', $order->id)->orderBy('updated_at', 'desc')->get()->toArray();
        if(count($orderItems) > 0) {
            foreach($orderItems as $n => $item) {
                $orderItems[$n]['product'] = Product::find($item['product_id'])->toArray();
            }
        }

        return view('admin.orders.item', ['order' => $order, 'orderItems' => $orderItems]);
    }

    public function confirm(SimpleOrderRequest $request) {
        $order = $this->getValidOrder($request);

        $order->checkout = 2;
        $order->save();

        return redirect()->to(route('admin.orders.main'));
    }

    public function cancel(SimpleOrderRequest $request) {
        $order = $this->getValidOrder($request);

        $order->checkout = 3;
        $order->save();

        return redirect()->to(route('admin.orders.main'));
    }

    public function delete(SimpleOrderRequest $request) {
        $order = $this->getValidOrder($request);
        OrderItem::where('order_id', '=', $order->id)->each(function ($product, $_) {
            $product->delete();
        });

        $order->delete();

        return redirect()->to(route('admin.orders.main'));
    }
}
