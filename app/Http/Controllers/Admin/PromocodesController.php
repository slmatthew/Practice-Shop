<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPromocodeRequest;
use App\Models\Promocode;
use App\Models\UserPromocode;

class PromocodesController extends Controller
{
    public function main()
    {
        return view('admin.promocodes.main', ['promocodes' => Promocode::orderBy('updated_at', 'desc')->get()]);
    }

    public function create(AddPromocodeRequest $request)
    {
        Promocode::create($request->getData());

        return to_route('admin.promocodes.main');
    }
}
