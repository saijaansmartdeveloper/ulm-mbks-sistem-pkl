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
        $type = $request->type;
        if (Auth::guard( $type)->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('public/' .$type  .'/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

//    public function login(Request $request)
//    {
//        $request->validate([
//            'email'     => 'required|email',
//            'password'  => 'required|string',
//            'type'      => 'required|string'
//        ], [
//           'email.required'     => 'Email Tidak Boleh Kosong',
//           'email.email'        => 'Kolom harus berupa email',
//           'password.required'  => 'Password Tidak Boleh Kosong',
//           'type.required'      => 'User Role Tidak Dipilih'
//        ]);
//
//        dd(Auth::guard('lecturer')->getName);
////
////        if (Auth::guard('lecturer')->attempt($request->only('email', 'password')))
////        {
////            return redirect()->route('public.lecturer.index');
////        }
////        else
////        {
////            return back()->withInput($request->only('email'));
////         }
//
//    }


}
