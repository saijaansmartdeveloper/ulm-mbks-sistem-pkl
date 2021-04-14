<?php

namespace App\Http\Controllers\Auth\AnotherUser;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
//    public function __construct()
//    {
//        $this->middleware('guest:lecturer')->except('logout')->except('showLoginForm');
//    }

    public function showLoginForm($string = 'lecturer')
    {
        if (Auth::guard($string)->check())
        {
            return redirect()->route($string . '.home');
        }

        return view('auth.another_user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|string',
            'type'      => 'required|string'
        ], [
           'email.required'     => 'Email Tidak Boleh Kosong',
           'email.email'        => 'Kolom harus berupa email',
           'password.required'  => 'Password Tidak Boleh Kosong',
           'type.required'      => 'User Role Tidak Dipilih'
        ]);

        if (Auth::guard($request->type)->attempt($request->only('email', 'password')))
        {
            redirect()->route('public.lecturer.index');
            exit();
        }
        else
        {
            redirect()->route('public.user.form_login');
            exit();
        }

    }

    public function logout()
    {

    }
}
