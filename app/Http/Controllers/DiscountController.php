<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddDiscountRequest;
use App\Http\Requests\DeleteDiscountRequest;
use App\Models\Discount;
use App\Models\Product;

class DiscountController extends Controller
{
    public function add(AddDiscountRequest $request, Product $product)
    {
        $product->discounts()->each(function ($item, $_) {
            $item->delete();
        });

        $product->discounts()->save(new Discount($request->getData()));

        return to_route('admin.product', $product);
    }

    public function clear(DeleteDiscountRequest $request, Product $product)
    {
        $product->discounts()->each(function ($item, $_) {
            $item->delete();
        });

        return to_route('admin.product', $product);
    }
}
