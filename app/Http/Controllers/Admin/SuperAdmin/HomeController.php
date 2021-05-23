<?php

namespace App\Http\Controllers\Admin\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'data'  => [
                'jumlah_pengguna'   => User::count(),
                'jumlah_jurusan'    => Major::count(),
                'jumlah_prodi'      => StudyProgram::count(),
            ],
            'user' => Auth::user()
        ];

        return view('admin.super_admin.home', $data);
    }
}
