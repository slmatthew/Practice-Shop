<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     *
     * @todo пофиксить принуждение ко второй авторизации, если пользователь не залогинен
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->logout == 1) {

            Auth::user()->logout = 0;
            Auth::user()->save();

            Auth::logout();

            return redirect()->to(route('login.show'))->withErrors(trans('auth.after_reset'));
        }

        return $next($request);
    }
}
