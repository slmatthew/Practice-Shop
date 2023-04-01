<?php

namespace App\Http\Controllers;

use App\Http\Requests\Basket\CheckoutRequest;
use App\Http\Requests\Basket\ExistingProductRequest;
use App\Http\Requests\Basket\ProductRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
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
            ]);
        }

        return $order[0];
    }

    private function getProducts($order) {
        $orderItems = OrderItem::where('order_id', '=', $order->id)->orderBy('updated_at', 'desc')->get();
        if(count($orderItems) > 0) {
            foreach($orderItems as $n => $item) {
                $orderItems[$n]->product = Product::find($item->product_id);
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

    public function checkout() {
        return view('basket.checkout', $this->getBasket());
    }

    public function doCheckout(CheckoutRequest $request) {
        if($request->has('saveData')) {
            $user = User::find(Auth::user()->id);

            $user->name = $request->get('name');
            $user->surname = $request->get('surname');
            $user->phone = $request->get('phone');

            $user->save();
        }

        $order = Order::find($this->findOrCreate()->id);

        $order->checkout = 1;
        $order->name = $request->get('name');
        $order->surname = $request->get('surname');
        $order->phone = $request->get('phone');
        $order->submitted_at = \Carbon\Carbon::now('Europe/Moscow')->toDateTimeString();

        $order->save();

        Order::create([
            'user_id' => Auth::user()->id,
            'checkout' => 0
        ]);

        return redirect()->to(route('basket.index', ['checkout' => $order->id]));
    }

    public function clear() {
        $basket = $this->findOrCreate();

        foreach(OrderItem::where('order_id', '=', $basket->id)->get() as $item) {
            $item->delete();
        }

        return redirect()->to(route('basket.index'));
    }

    public function addProduct(ProductRequest $request) {
        $product = Product::find($request->product_id);
        $basket = $this->findOrCreate();

        if($this->hasProduct($basket, $request->product_id)) {
            $basketItem = OrderItem::where('order_id', '=', $basket->id)->where('product_id', '=', $request->product_id)->get();

            foreach($basketItem as &$item) {
                if($product->getPrice() == $item->price) {
                    if ($item->quantity < 10) {
                        $item->quantity++;
                    }

                    $item->price = $product->getPrice();

                    $item->save();

                    return redirect()->to(route('basket.index'));
                }
            }
        }

        $data = $request->safe()->toArray();

        $data['order_id'] = $basket->id;
        $data['price'] = $product->getPrice();

        OrderItem::create($data);

        return redirect()->to(route('basket.index'));
    }

    public function editProduct(ExistingProductRequest $request) {
        $product = Product::findOrFail($request->product_id);
        $basket = $this->findOrCreate();

        if($this->hasProduct($basket, $request->product_id)) {
            $basketItem = OrderItem::findOrFail($request->id);
            if($basketItem->order_id != $basket->id || $basketItem->product_id != $request->product_id) abort(403);

            $basketItem->quantity = $request->quantity;
            $basketItem->price = $product->getPrice();

            $basketItem->save();

            $query = $basket->items()->where('product_id', $product->id)->where('price', $product->getPrice());

            if($query->get()->count() > 1) {
                $quantity = $query->sum('quantity');
                $quantity = min($quantity, 10);

                $query->get()->each(function ($item, $_) use(&$basketItem) {
                    if($item->id != $basketItem->id) $item->delete();
                });

                $basketItem->quantity = $quantity;

                $basketItem->save();

//                $query->get()->each(fn($item, $_) => $item->delete());
//
//                $basket->items()->save(new OrderItem([
//                    'product_id' => $product->id,
//                    'price' => $product->getPrice(),
//                    'quantity' => $quantity
//                ]));
            }
        }

        return redirect()->to(route('basket.index'));
    }

    public function deleteProduct(ExistingProductRequest $request) {
        $basket = $this->findOrCreate();
        $basket->items()->find($request->id)->delete();

        return redirect()->to(route('basket.index'));
    }
}
