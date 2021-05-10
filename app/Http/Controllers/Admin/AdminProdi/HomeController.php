<?php

namespace App\Http\Controllers\Admin\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Lecturer;
use App\Models\Partner;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $prodi = Auth::user()->prodi_uuid;
        $data = [
            'title' => 'Dashboard',
            'data'  => [
                'jumlah_dosen'              => Lecturer::where('prodi_uuid', $prodi)->count(),
                'jumlah_mahasiswa'          => Student::where('prodi_uuid', $prodi)->count(),
                'jumlah_mitra'              => Partner::count(),
                'jumlah_mahasiswa_kegiatan' => Activity::where('prodi_uuid', $prodi)->count(),
            ],
        ];

        return view('admin.admin_prodi.home', $data);
    }
}
