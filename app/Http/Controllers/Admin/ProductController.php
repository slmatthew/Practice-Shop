<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProducts(): \Illuminate\Contracts\View\View
    {
        $products = Product::get();
        $products_result = [];

        foreach($products as $product) {
            $products_result[] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'hidden' => (bool)$product['hidden'],
                'available' => (bool)$product['available'],
                'category' => is_null($product['category_id']) ? [false] : [true, Category::find($product['category_id'])]
            ];
        }

        return view('admin.products.all', ['products' => $products_result]);
    }

    public function updateProduct($product_id)
    {
        $product_id = (int)$product_id;
        $product = Product::find($product_id);

        if(is_null($product)) {
            abort(404);
        }

        return view('admin.products.update', ['product' => $product->toArray()]);
    }

    public function updateProductAction($product_id): \Illuminate\Contracts\View\View
    {
        return view('admin.home');
    }

    public function deleteProductAction($product_id): \Illuminate\Contracts\View\View
    {
        return view('admin.home');
    }

    public function addProduct(): \Illuminate\Contracts\View\View
    {
        return view('admin.home');
    }

    public function addProductAction(): \Illuminate\Contracts\View\View
    {
        return view('admin.home');
    }
}
