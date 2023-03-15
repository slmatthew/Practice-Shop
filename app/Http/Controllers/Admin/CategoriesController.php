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
        return view('admin.categories.main', ['categories' => Category::get()->toArray()]);
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

        $data['image_url'] = $url ?? 'https://vk.com/images/camera_200.png';

        Category::create($data);

        return view('admin.categories.main', ['categories' => Category::get()->toArray()]);
    }

    public function update(UpdateCategoriesRequest $request)
    {
        $category = Category::find($request->getData()['id']);
        $category->name = $request->getData()['name'];

        if(is_null($category->image_url)) {
            $category->image_url = 'https://vk.com/images/camera_200.png';
        }

        $file = $request->file('image');
        if($file) {
            if(str_starts_with($category->image_url, '/storage/')) {
                Storage::disk('public')->delete(mb_substr($category->image_url, 9));
            }

            $category->image_url = ImageSaver::upload($file, 'categories', false, 1920, 1200);
        }

        $category->save();

        return view('admin.categories.main', ['categories' => Category::get()->toArray()]);
    }

    public function delete(DeleteCategoriesRequest $request)
    {
        $category = Category::find($request->getId());
        $category->delete();

        return view('admin.categories.main', ['categories' => Category::get()->toArray()]);
    }
}
