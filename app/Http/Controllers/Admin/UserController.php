<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserSimpleRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private function randomPassword(): string
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = [];
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 12; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return trim(implode($pass));
    }

    public function main(): \Illuminate\Contracts\View\View
    {
        return view('admin.users.main', ['users' => User::get()]);
    }

    public function update(UserUpdateRequest $request, User $user) {
        if($request->has('deleteImage')) {
            if(str_starts_with($user->image, env('APP_URL', 'https://shop.slmatthew.ru').'/storage/')) {
                Storage::disk('public')->delete(mb_substr($user->image, mb_strlen(env('APP_URL', 'https://shop.slmatthew.ru').'/storage/')));
            }

            $user->image = '/img/camera_200.png';
        }

        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->phone = $request->get('phone');

        if($request->has('role') && $user->id != 1) {
            $user->role = $request->get('role');
        }

        $user->save();

        return to_route('admin.users.main');
    }

    public function resetPassword(UserSimpleRequest $request, User $user) {
        // сменить пароль первого пользователя можно только в dev-режиме
        // if(Auth::user()->id != 1 && $user->id == 1) abort(403);
        if(!env('APP_DEBUG', false) && $user->id == 1) abort(403);

        $password = $this->randomPassword();

        $user->password = $password;
        $user->logout = 1;

        $user->save();
        $user = $user->refresh();

        return view('admin.users.newPassword', ['user' => $user, 'password' => $password]);
    }

    public function delete(UserSimpleRequest $request, User $user) {
        // if(Auth::user()->id != 1 && $user->id == 1) abort(403);
        if($user->id == 1) abort(403);

        Order::where('user_id', '=', $user->id)->each(function ($order, $_) {
            OrderItem::where('order_id', '=', $order->id)->each(function ($orderItem, $_) {
               $orderItem->delete();
            });

            $order->delete();
        });

        if(str_starts_with($user->image, env('APP_URL', 'https://shop.slmatthew.ru').'/storage/')) {
            Storage::disk('public')->delete(mb_substr($user->image, mb_strlen(env('APP_URL', 'https://shop.slmatthew.ru').'/storage/')));
        }

        $user->delete();

        return redirect()->to(route('admin.users.main'));
    }

    public function resetIncrement() {
        if(User::get()->count() > 0) {
            $increment = User::max('id') + 1;
            DB::table('users')->statement("ALTER TABLE users AUTO_INCREMENT = {$increment}");
        }

        return redirect()->to(route('admin.users.main'));
    }
}
