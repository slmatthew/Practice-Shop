<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddBrandRequest;
use App\Http\Requests\DeleteBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class BrandsController extends Controller
{
    public function main()
    {
        return view('admin.brands.main', ['brands' => Brand::get()]);
    }

    public function add(AddBrandRequest $request)
    {
        $data = $request->getData();

        $file = $request->file('image');
        if($file) {
            $url = ImageSaver::upload($file, 'brands', false, 1920, 1200);
        }

        $data['image'] = $url ?? '/img/camera_200.png';

        Brand::create($data);

        return to_route('admin.brands.main');
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        if($brand->id != $request->getData()['id']) abort(404);

        $brand->name = $request->getData()['name'];
        $brand->slug = $request->getData()['slug'];
        $brand->description = $request->getData()['description'];

        if(is_null($brand->image)) {
            $brand->image = '/img/camera_200.png';
        }

        $file = $request->file('image');
        if($file) {
            if(str_starts_with($brand->image_url, env('APP_URL', 'https://shop.slmatthew.ru').'/storage/')) {
                Storage::disk('public')->delete(mb_substr($brand->image_url, mb_strlen(env('APP_URL', 'https://shop.slmatthew.ru').'/storage/')));
            }

            $brand->image = ImageSaver::upload($file, 'brands', false, 1920, 1200);
        }

        $brand->save();

        return to_route('admin.brands.main');
    }

    public function delete(DeleteBrandRequest $request, Brand $brand)
    {
        if($brand->id != $request->getData()['id']) abort(404);

        if(str_starts_with($brand->image_url, env('APP_URL', 'https://shop.slmatthew.ru').'/storage/')) {
            Storage::disk('public')->delete(mb_substr($brand->image_url, mb_strlen(env('APP_URL', 'https://shop.slmatthew.ru').'/storage/')));
        }

        $brand->delete();

        return to_route('admin.brands.main');
    }
}
