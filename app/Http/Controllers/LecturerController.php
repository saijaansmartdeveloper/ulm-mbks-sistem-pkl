<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerController extends Controller
{
    private $_guard = 'lecturer';

    public function __construct()
    {
//        $this->middleware
    }

    public function index()
    {
        $data = [
            'title' => "Selamat Datang, " . Auth::guard($this->_guard)->user()->nama_dosen,
            'guard' => $this->_guard,
            'data' => null
        ];

        return view('public.lecturer.index', $data);
    }
}
