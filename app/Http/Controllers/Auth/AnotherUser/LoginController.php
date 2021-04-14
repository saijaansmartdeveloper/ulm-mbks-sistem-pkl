<?php

namespace App\Http\Controllers\Auth\AnotherUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showFormLogin($string = 'mahasiswa')
    {
        return view('auth.another_user.login');
    }

    public function doLogin()
    {

    }

    public function logout()
    {

    }
}
