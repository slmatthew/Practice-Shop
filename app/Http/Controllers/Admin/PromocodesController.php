<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPromocodeRequest;
use App\Models\Promocode;
use App\Models\UserPromocode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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

    public function clear()
    {
        UserPromocode::truncate();
        Promocode::truncate();

        return to_route('admin.promocodes.main');
    }

    public function delete(Request $request, Promocode $promocode)
    {
        if(!$request->has('id') || $request->get('id') != $promocode->id) abort(404);

        $promocode->delete();

        return to_route('admin.promocodes.main');
    }
}
