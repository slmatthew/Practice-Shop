<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Renderable;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        $user = User::where('username', $credentials['username'])->first();

        if(is_null($user) || !Hash::check($credentials['password'], $user->password)) {
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        }

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    public function loginVk(Request $request) {
        if($request->has('vk_data')) {
            $vk_data = $request->get('vk_data');
            $vk_data = @json_decode($vk_data, true);

            if(!is_null($vk_data)) return json_encode($vk_data);
        }

        return 'not ok';
    }

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     */
    protected function authenticated(Request $request, $user)
    {
        return to_route('main');
    }
}
