<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoriesRequest;
use App\Http\Requests\DeleteCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function main(): \Illuminate\Contracts\View\View
    {
        return view('admin.categories.main', ['categories' => Category::get()]);
    }

    /**
     * @param AddCategoriesRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function add(AddCategoriesRequest $request)
    {
        $data = $request->getData();

        $file = $request->file('image');
        if($file) {
            $url = ImageSaver::upload($file, 'categories', false, 1920, 1200);
        }

        $data['image_url'] = $url ?? '/img/camera_200.png';

        Category::create($data);

        return to_route('admin.categories.main');
    }

    public function update(UpdateCategoriesRequest $request, Category $category)
    {
        if($category->id != $request->getData()['id']) abort(404);

        $category->name = $request->getData()['name'];
        $category->slug = $request->getData()['slug'];

        if(is_null($category->image_url)) {
            $category->image_url = '/img/camera_200.png';
        }

        $file = $request->file('image');
        if($file) {
            if(str_starts_with($category->image_url, env('APP_URL', 'https://shop.slmatthew.ru').'/storage/')) {
                Storage::disk('public')->delete(mb_substr($category->image_url, 9));
            }

            $category->image_url = ImageSaver::upload($file, 'categories', false, 1920, 1200);
        }

        $category->save();

        return to_route('admin.categories.main');
    }

    public function delete(DeleteCategoriesRequest $request, Category $category)
    {
        if($category->id != $request->getId()) abort(404);

        if(str_starts_with($category->image_url, env('APP_URL', 'https://shop.slmatthew.ru').'/storage/')) {
            Storage::disk('public')->delete(mb_substr($category->image_url, 9));
        }

        $category->delete();

        return to_route('admin.categories.main');
    }
}
