<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandsController extends Controller
{
    public function main()
    {
        return view('admin.brands.main', ['brands' => Brand::get()]);
    }
}
