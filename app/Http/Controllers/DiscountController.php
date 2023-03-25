<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddDiscountRequest;
use App\Http\Requests\DeleteDiscountRequest;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function add(AddDiscountRequest $request, Product $product)
    {
        $product->discounts()->save(new Discount($request->getData()));

        return to_route('admin.product', $product);
    }

    public function delete(DeleteDiscountRequest $request, Product $product, Discount $discount)
    {
        $discount->delete();

        return to_route('admin.product', $product);
    }
}
