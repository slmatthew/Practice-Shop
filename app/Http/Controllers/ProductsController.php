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
                where('hidden', '<>', 1)->
                limit(3)->
                get()->
                toArray();

            if(empty($products)) {
                unset($categories[$i]);
                continue;
            }

            $min_price = Product::select('price')->
                where('category_id', '=', $ctg['id'])->
                where('hidden', '<>', 1)->
                orderBy('price', 'asc')->
                limit(1)->
                get()->
                toArray();

            $ctg['products'] = $products;
            $ctg['min_price'] = $min_price[0]['price'];
        }

        return view('products.allCategories', ['categories' => $categories]);
    }

    public function byCategory($category_id) {
        $ctgName = '';

        if($category_id == 'all') {
            $products = Product::where('hidden', '=', 0)->get();
        } else {
            $category = Category::find($category_id);

            if(is_null($category)) abort(404);

            $products = Product::where('category_id', '=', $category_id)->where('hidden', '=', 0)->get();
            $ctgName = $category->name;
        }

        return view('products.list', [
            'ctgName' => $ctgName,
            'all' => $category_id == 'all',
            'products' => $products
        ]);
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
