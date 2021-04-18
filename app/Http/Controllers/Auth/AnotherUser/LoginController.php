<?php

namespace App\Http\Controllers\Auth\AnotherUser;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.another_user.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $guard       = $request->type;

        if (Auth::guard($guard)->attempt($credentials, false)) {
            $request->session()->regenerate();
            return redirect()->intended('public/' . $guard . '/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }



}
