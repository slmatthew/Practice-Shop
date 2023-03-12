<?php

namespace App\Http\Controllers;

use App\Http\Requests\Basket\ProductRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    private function findOrCreate() {
        $user_id = Auth::user()->id;

        $order = Order::where('user_id', '=', $user_id)->orderBy('id', 'desc')->limit(1)->get();
        if(!$order->count()) {
            return Order::create([
                'user_id' => $user_id,
                'checkout' => 0
            ])->get()[0];
        }

        return $order[0];
    }

    private function getProducts($order) {
        $orderItems = OrderItem::where('order_id', '=', $order->id)->orderBy('updated_at', 'desc')->get()->toArray();
        if(count($orderItems) > 0) {
            foreach($orderItems as $n => $item) {
                $orderItems[$n]['product'] = Product::find($item['product_id'])->toArray();
            }
        }

        return $orderItems;
    }

    private function hasProduct($order, $product_id) {
        return count(
                OrderItem::where('order_id', '=', $order->id)
                    ->where('product_id', '=', $product_id)
                    ->get()
                    ->toArray()
            ) > 0;
    }

    private function getBasket() {
        $basket = $this->findOrCreate();
        return [
            'basket' => $basket,
            'basketItems' => $this->getProducts($basket)
        ];
    }

    public function index() {
        return view('basket.index', $this->getBasket());
    }

    public function clear() {
        $basket = $this->findOrCreate();

        foreach(OrderItem::where('order_id', '=', $basket->id)->get() as $item) {
            $item->delete();
        }

        return redirect()->to(route('basket.index'));
    }

    public function addProduct(ProductRequest $request) {
        $basket = $this->findOrCreate();
        if($this->hasProduct($basket, $request->product_id)) {
            $basketItem = OrderItem::where('order_id', '=', $basket->id)->where('product_id', '=', $request->product_id)->first();
            if($basketItem->quantity < 10) {
                $basketItem->quantity++;
            }

            $basketItem->save();
        } else {
            $data = $request->safe()->toArray();
            $data['order_id'] = $basket->id;

            OrderItem::create($data);
        }

        return redirect()->to(route('basket.index'));
    }

    public function editProduct(ProductRequest $request) {
        $basket = $this->findOrCreate();
        if($this->hasProduct($basket, $request->product_id)) {
            $basketItem = OrderItem::where('order_id', '=', $basket->id)->where('product_id', '=', $request->product_id)->first();
            $basketItem->quantity = $request->quantity;

            $basketItem->save();
        }

        return redirect()->to(route('basket.index'));
    }

    public function deleteProduct(ProductRequest $request) {
        $basket = $this->findOrCreate();
        if($this->hasProduct($basket, $request->product_id)) {
            OrderItem::where('order_id', '=', $basket->id)->where('product_id', '=', $request->product_id)->first()->delete();
        }

        return redirect()->to(route('basket.index'));
    }
}
