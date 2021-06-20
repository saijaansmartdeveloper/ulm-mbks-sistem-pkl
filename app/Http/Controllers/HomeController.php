<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Major;
use App\Models\Partner;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Activity;
use App\Models\Announcement;
use App\Models\StudyProgram;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard_supervisor()
    {
        $announcement = new Announcement();
        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Selamat Datang, ' . ucfirst($user->nama_pengguna),
            'data'  => [
                'jumlah_admin_prodi'    => User::where('role_pengguna', 'admin_prodi')->count(),
                'jumlah_super_visor'    => User::where('role_pengguna', 'supervisor')->count(),
                'jumlah_lecturer'       => Lecturer::count(),
                'jumlah_student'        => Student::count(),
                'jumlah_partner'        => Partner::count(),
                'jumlah_jurusan'        => Major::count(),
                'jumlah_prodi'          => StudyProgram::count(),
            ],
            'user' => $user,
            'announcement' => $announcement->show_announcement($user->jurusan_uuid, $user->prodi_uuid)

        ];

        return view('admin.supervisor.home', $data);
    }

    public function dashboard_superuser()
    {
        $announcement = new Announcement();
        $user = Auth::guard('web')->user();
        $data = [
            'title' => 'Selamat Datang, ' . ucfirst($user->nama_pengguna),
            'data'  => [
                'jumlah_admin_prodi'    => User::where('role_pengguna', 'admin_prodi')->count(),
                'jumlah_super_visor'    => User::where('role_pengguna', 'supervisor')->count(),
                'jumlah_lecturer'       => Lecturer::count(),
                'jumlah_student'        => Student::count(),
                'jumlah_partner'        => Partner::count(),
                'jumlah_jurusan'        => Major::count(),
                'jumlah_prodi'          => StudyProgram::count(),
            ],
            'user' => $user,
            'announcement' => $announcement->show_announcement($user->jurusan_uuid, $user->prodi_uuid)
        ];

        return view('admin.super_admin.home', $data);

    }

    public function dashboard_adminprodi()
    {
        $announcement = new Announcement();
        $user = Auth::guard('web')->user();
        $prodi = $user->prodi_uuid;
        $data = [
            'title' => 'Dashboard',
            'data'  => [
                'jumlah_dosen'              => Lecturer::where('prodi_uuid', $prodi)->count(),
                'jumlah_mahasiswa'          => Student::where('prodi_uuid', $prodi)->count(),
                'jumlah_mitra'              => Partner::count(),
                'jumlah_mahasiswa_kegiatan' => Activity::where('prodi_uuid', $prodi)->count(),
            ],
            'user' => $user,
            'announcement' => $announcement->show_announcement($user->jurusan_uuid, $prodi)
        ];

        return view('admin.admin_prodi.home', $data);
    }
}
