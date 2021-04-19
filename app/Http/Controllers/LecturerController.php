<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerController extends Controller
{
    public function __construct()
    {
//        $this->middleware
    }

    public function index()
    {
        $data = [
            'title' => 'Dosen',
            'guard' => 'lecturer',
            'data'  => null
        ];

        return view("public.lecturer.index", $data);
    }
}
