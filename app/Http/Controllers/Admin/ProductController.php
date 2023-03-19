<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function getProducts(): \Illuminate\Contracts\View\View
    {
        $products = Product::sortable()->orderBy('category_id')->paginate(8);

        foreach($products as $i => &$val) {
            $val->category = is_null($val->category_id) ? [false] : [true, Category::find($val->category_id)];
            $val->brand = is_null($val->brand_id) ? [false] : [true, Brand::find($val->brand_id)];
        }

        $deleteResult = [];

        if(
            !is_null(request()->get('deleteAction')) &&
            !is_null(request()->get('delSuccess')) &&
            !is_null(request()->get('delId')) &&
            !is_null(request()->get('delName'))
        ) {
            $deleteResult = [
                (bool)(int)request()->get('delSuccess'),
                (int)request()->get('delId'),
                request()->get('delName')
            ];
        }

        return view('admin.products.all', ['products' => $products, 'deleteResult' => $deleteResult]);
    }

    public function updateProduct($product_id)
    {
        $product_id = (int)$product_id;
        $product = Product::find($product_id);

        if(is_null($product)) {
            abort(404);
        }

        $nextPrev = [];

        $nextPrev['next'] = Product::where('id', '>', $product_id)->orderBy('id')->first()->id ?? 0;
        $nextPrev['prev'] = Product::where('id', '<', $product_id)->orderBy('id', 'desc')->first()->id ?? 0;

        return view('admin.products.update', ['product' => $product->toArray(), 'categories' => Category::get()->toArray(), 'brands' => Brand::get(), 'nextPrev' => $nextPrev]);
    }

    public function updateProductAction(UpdateProductRequest $request): \Illuminate\Contracts\View\View
    {
        $success = false;

        $product = Product::find(request()->get('id'));

        if(!is_null($product)) {
            $product->name          = request()->get('name');
            $product->description   = request()->get('description');
            $product->price         = (float)request()->get('price');
            $product->category_id   = (int)request()->get('category_id') == 0 ? null : request()->get('category_id');
            $product->brand_id      = (int)request()->get('brand_id') == 0 ? null : request()->get('brand_id');
            $product->hidden        = (int)request()->get('hidden') ?? 0;
            $product->available     = (int)request()->get('available') ?? 0;

            $product->image_url = $product->image_url ?? '/img/camera_200.png';

            if(!is_null($request->get('delete_image')) && str_starts_with($product->image_url, '/storage/')) {
                Storage::disk('public')->delete(mb_substr($product->image_url, 9));
                $product->image_url = '/img/camera_200.png';
            }

            $file = $request->file('image');
            if($file) {
                if(str_starts_with($product->image_url, '/storage/')) {
                    Storage::disk('public')->delete(mb_substr($product->image_url, 9));
                }

                $product->image_url = ImageSaver::upload($file, 'products', width: 1500);
            }

            $success = $product->save();
        }

        return view('admin.products.updateResult', ['product' => (int)request()->get('id'), 'success' => $success]);
    }

    public function deleteProductAction()
    {
        $product = Product::find(request()->get('id'));

        if(is_null($product)) {
            return redirect()->route('admin.products.main');
        }

        $product_data = $product->toArray();

        if(str_starts_with($product_data['image_url'], '/storage/')) {
            Storage::disk('public')->delete(mb_substr($product_data['image_url'], 9));
        }

        return redirect()->route('admin.products.main', [
            'deleteAction' => 1,
            'delSuccess' => $product->delete(),
            'delId' => $product_data['id'],
            'delName' => $product_data['name']
        ]);
    }

    public function addProduct(): \Illuminate\Contracts\View\View
    {
        return view('admin.products.add', ['categories' => Category::get()->toArray(), 'brands' => Brand::get()]);
    }

    public function addProductAction(AddProductRequest $request)
    {
        $data = $request->getData();

        $file = $request->file('image');
        if($file) {
            $url = ImageSaver::upload($file, 'products', width: 1500);
        }

        $data['image_url'] = $url ?? '/img/camera_200.png';

        Product::create($data);

        return redirect()->route('admin.products.main');
    }
}
