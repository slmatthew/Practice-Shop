<?php

namespace App\Http\Controllers;

use App\Http\Requests\Basket\CheckoutRequest;
use App\Http\Requests\Basket\ExistingProductRequest;
use App\Http\Requests\Basket\ProductRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Promocode;
use App\Models\User;
use App\Models\UserPromocode;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    private function findOrCreate(): Order
    {
        $query = Auth::user()->orders()->where('checkout', 0)->orderBy('id', 'desc');
        $order = $query->first();

        if(!$order) {
            Auth::user()->orders()->save(new Order());
            return $query->first();
        }

        return $order;
    }

    private function getProducts(Order $order): \Illuminate\Database\Eloquent\Collection
    {
        $order->items()->orderBy('updated_at', 'desc')->each(function ($item, $_) {
            $product = Product::find($item->product_id);

            if($product->hidden || !$product->available) {
                $item->delete();
            }
        });

        $orderItems = $order->items()->orderBy('updated_at', 'desc')->get();
        if(count($orderItems) > 0) {
            foreach($orderItems as $n => &$item) {
                $item->product = Product::find($item->product_id);
            }
        }

        return $orderItems;
    }

    private function hasProduct(Order $order, $product_id): bool
    {
        return $order->items()
                ->where('product_id', '=', $product_id)
                ->get()
                ->count() > 0;
    }

    private function getBasket(): array
    {
        $basket = $this->findOrCreate();
        return [
            'basket' => $basket,
            'basketItems' => $this->getProducts($basket)
        ];
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        return view('basket.index', $this->getBasket());
    }

    public function checkout(): \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $basket = $this->getBasket();
        if(!$basket['basketItems']->count()) return to_route('basket.index');

        return view('basket.checkout', $basket);
    }

    public function doCheckout(CheckoutRequest $request): \Illuminate\Http\RedirectResponse
    {
        $basket = $this->getBasket();
        if(!$basket['basketItems']->count()) return to_route('basket.index');

        $order = Order::find($this->findOrCreate()->id);

        $final_price = 0;

        foreach($basket['basketItems'] as &$basketItem) {
            $final_price += $basketItem->product->getPrice();
        }

        if(!is_null($request->get('promocode'))) {
            try {
                $promocode = Promocode::where('promocode', $request->get('promocode'))->firstOrFail();

                if(
                    !$promocode->expired &&
                    !$promocode->limit_exceeded &&
                    !Auth::user()->usedPromocode($promocode)
                ) {
                    $order->discounted = 1;
                    $final_price = $final_price - ($final_price * ($promocode->discount / 100));
                    Auth::user()->usersPromocodes()->save(new UserPromocode(['promocode_id' => $promocode->id]));
                }
            } catch(ModelNotFoundException $e) {}
        }

        if($request->has('saveData')) {
            $user = User::find(Auth::user()->id);

            $user->name = $request->get('name');
            $user->surname = $request->get('surname');
            $user->phone = $request->get('phone');

            $user->save();
        }

        $order->checkout = 1;
        $order->name = $request->get('name');
        $order->surname = $request->get('surname');
        $order->phone = $request->get('phone');
        $order->submitted_at = \Carbon\Carbon::now('Europe/Moscow')->toDateTimeString();
        $order->final_price = (float)$final_price;

        $order->save();

        Auth::user()->orders()->save(new Order());

        return redirect()->to(route('basket.index', ['checkout' => $order->id]));
    }

    public function clear(): \Illuminate\Http\RedirectResponse
    {
        $basket = $this->findOrCreate();

        foreach(OrderItem::where('order_id', '=', $basket->id)->get() as $item) {
            $item->delete();
        }

        return redirect()->to(route('basket.index'));
    }

    public function addProduct(ProductRequest $request): \Illuminate\Http\RedirectResponse
    {
        $product = Product::find($request->product_id);
        $basket = $this->findOrCreate();

        if($this->hasProduct($basket, $product->id)) {
            $basketItem = $basket->items()->where('product_id', '=', $product->id)->get();

            foreach($basketItem as &$item) {
                if($product->getPrice() == $item->price) {
                    if ($item->quantity < 10) {
                        $item->quantity++;
                    }

                    $item->price = $product->getPrice();

                    $item->save();

                    return to_route('basket.index');
                }
            }
        }

        $data = $request->safe()->toArray();

        $data['order_id'] = $basket->id;
        $data['price'] = $product->getPrice();

        $basket->items()->save(new OrderItem($data));

        return to_route('basket.index');
    }

    public function editProduct(ExistingProductRequest $request): \Illuminate\Http\RedirectResponse
    {
        $product = Product::findOrFail($request->product_id);
        $basket = $this->findOrCreate();

        if($this->hasProduct($basket, $product->id)) {
            $basketItem = OrderItem::findOrFail($request->id);
            if($basketItem->order_id != $basket->id || $basketItem->product_id != $product->id) abort(403);

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
            }
        }

        return to_route('basket.index');
    }

    public function deleteProduct(ExistingProductRequest $request): \Illuminate\Http\RedirectResponse
    {
        $basket = $this->findOrCreate();
        $basket->items()->find($request->id)->delete();

        return to_route('basket.index');
    }

    public function checkPromocode(string $promocode)
    {
        try {

            $promocode = Promocode::where('promocode', $promocode)->firstOrFail();

            if($promocode->expired) {
                return response()->json(['ok' => false, 'reason' => 'Срок активации завершен']);
            }

            if($promocode->limit_exceeded) {
                return response()->json(['ok' => false, 'reason' => 'Активации кончились']);
            }

            if(Auth::user()->usedPromocode($promocode)) {
                return response()->json(['ok' => false, 'reason' => 'Вы уже применяли этот промокод']);
            }

            return response()->json(['ok' => true, 'discount' => $promocode->discount]);

        } catch(ModelNotFoundException $e) {
            return response()->json(['ok' => false, 'reason' => 'Такого промокода не существует']);
        }
    }
}
