<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function main(): \Illuminate\Contracts\View\View
    {
        return view('admin.categories.main', ['categories' => Category::get()->toArray()]);
    }

    public function add(AddCategoriesRequest $request)
    {
        Category::create($request->getData());
        return view('admin.categories.main', ['categories' => Category::get()->toArray()]);
    }

    public function update(UpdateCategoriesRequest $request)
    {
        $category = Category::find($request->getData()['id']);
        $category->name = $request->getData()['name'];
        $category->save();

        return view('admin.categories.main', ['categories' => Category::get()->toArray()]);
    }
}
