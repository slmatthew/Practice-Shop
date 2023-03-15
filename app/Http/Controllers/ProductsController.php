<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function allCategories() {
        $categories = Category::get()->toArray();

        foreach($categories as $i => &$ctg) {
            $products = Product::select('image_url')->
                where('category_id', '=', $ctg['id'])->
                where('hidden', '=', 0)->
                limit(3)->
                get()->
                toArray();

            if(empty($products)) {
                unset($categories[$i]);
                continue;
            }

            $min_price = Product::select('price')->
                where('category_id', '=', $ctg['id'])->
                where('hidden', '=', 0)->
                orderBy('price', 'asc')->
                limit(1)->
                get()->
                toArray();

            $ctg['products'] = $products;
            $ctg['min_price'] = $min_price[0]['price'] ?? $min_price['price'] ?? 0;
        }

        return view('products.allCategories', ['categories' => $categories]);
    }

    public function byCategory($category_id) {
        $ctgName = '';

        $products = Product::sortable()->orderBy('category_id')->where('hidden', '=', 0);

        if($category_id != 'all') {
            $category = Category::find($category_id);

            if(is_null($category)) abort(404);

            $products = $products->where('category_id', '=', $category_id);
            $ctgName = $category->name;
        }

        $paginator = $products->paginate(6);
        $products = $products->get();

        return view('products.list', [
            'ctgName' => $ctgName,
            'all' => $category_id == 'all',
            'products' => $products
        ])->with('paginator', $paginator);
    }

    public function product($product_id) {
        $product = Product::find($product_id);

        if(is_null($product)) abort(404);

        $category = null;
        if(!is_null($product->category_id)) {
            $category = Category::find($product->category_id);
        }

        return view('products.item', ['product' => $product, 'category' => $category]);
    }
}
