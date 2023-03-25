<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function allCategories() {
        $categories = Category::get();

        foreach($categories as $i => &$ctg) {
            $products = Product::select('image_url')->
                where('category_id', '=', $ctg->id)->
                where('hidden', '=', 0)->
                limit(3)->
                get()->
                toArray();

            if(empty($products)) {
                unset($categories[$i]);
                continue;
            }

            $min_price = Product::select('price')->
                where('category_id', '=', $ctg->id)->
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

    public function byCategory(Category $category, ?Brand $brand = null) {
        $ctgName = '';

        $products = Product::sortable()->orderBy('category_id')->where('hidden', '=', 0);

        if($category->slug != 'all') {
            $products = $products->where('category_id', '=', $category->id);
            $ctgName = $category->name;
        }

        if(!is_null($brand)) {
            $products = $products->where('brand_id', '=', $brand->id);
        }

        $paginator = $products->paginate(6);
        $products = $products->get();

        $brands = [];
        foreach($products as $product) {
            if($product->brand_id != null) {
                $brands[$product->brand_id] = Brand::find($product->brand_id);
            }
        }

        return view('products.list', [
            'ctgName' => $ctgName,
            'all' => $category->slug == 'all',
            'products' => $products
        ])->with('paginator', $paginator)->with('brand', $brand)->with('brands', $brands);
    }

    public function product(Product $product) {
        $category = null;
        if(!is_null($product->category_id)) {
            $category = Category::find($product->category_id);
        }

        $brand = null;
        if(!is_null($product->brand_id)) {
            $brand = Brand::find($product->brand_id);
        }

        return view('products.item', ['product' => $product, 'category' => $category, 'brand' => $brand]);
    }

    public function brand(Brand $brand)
    {
        $categories = Category::whereIn('id', function ($query) use($brand) {
            $query->select('category_id')->from('products')->where('brand_id', '=', $brand->id);
        })->get();

        foreach($categories as $i => &$ctg) {
            if(Product::where('category_id', '=', $ctg->id)->where('brand_id', '=', $brand->id)->where('hidden', '<>', 1)->count() == 0) {
                unset($categories[$i]);
                continue;
            }


            $ctg->min_price = Product::select('price')->where('category_id', '=', $ctg->id)->where('brand_id', '=', $brand->id)->where('hidden', '<>', 1)->min('price');
        }

        return view('products.brand', compact('brand', 'categories'));
    }
}
