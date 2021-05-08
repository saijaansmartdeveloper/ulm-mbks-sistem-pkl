<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student')->except('show');
    }

    public function index()
    {
        $user   = Auth::guard('student')->user();

        $data = [
            'title'     => "Hello, " . $user->nama_mahasiswa,
            'guard'     => $user->guard_name(),
            'data'      => $user->activities()->first(),
            'user'      => $user
        ];

        return view("public.student.index", $data);
    }

    public function show($id)
    {
        if (! (Auth::guard('student')->check() || Auth::guard('lecturer')->check() || Auth::guard('partner]')->check()))
        {
            abort(403);
        }

        $user   = Auth::guard('student')->user() ?? Student::findOrFail($id);

        $data = [
            'title'     => 'Profile ' . $user->nama_mahasiswa,
            'guard'     => $user->guard_name(),
            'data'      => $user,
            'user'      => $user
        ];

        return view('public.student.show', $data);
    }

    public function edit($id)
    {

        $user   = Auth::guard('student')->user();

        $data = [
            'title'     => 'Ubah Data Student',
            'guard'     => $user->guard_name(),
            'data'      => Student::findOrFail($id),
            'user'      => $user
        ];

        return view('public.student.form', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nim_mahasiswa'     => 'required',
                'nama_mahasiswa'    => 'required',
                'email'             => 'required',
                'phone'             => 'required',
                'foto_mahasiswa'    => 'image|max:512'
            ],
            [
                'nim_mahasiswa.required'     => 'NIM Student Tidak Boleh Kosong',
                'nama_mahasiswa.required'    => 'Nama Student Tidak Boleh Kosong',
                'email.required'             => 'Email Tidak Boleh Kosong',
                'phone.required'             => 'No. Telepon Tidak Boleh Kosong',
                'foto_mahasiswa.max'         => 'File Foto Maksimal 512KB'
            ]
        );

        $mahasiswa = Student::findOrFail($id);

        if (request()->file('foto_mahasiswa')) {
            Storage::delete($mahasiswa->foto_mahasiswa);
            $foto_mahasiswa = request()->file('foto_mahasiswa');
            $fotoUrl        = $foto_mahasiswa->storeAs('file/foto_mahasiswa', "{$request->nim_mahasiswa}.{$foto_mahasiswa->extension()}", "public");
        } else {
            $fotoUrl = $mahasiswa->foto_mahasiswa;
        }

        $mahasiswa->nim_mahasiswa   = $request->nim_mahasiswa;
        $mahasiswa->nama_mahasiswa  = $request->nama_mahasiswa;
        $mahasiswa->email           = $request->email;
        if ($request->password != null) {
            $mahasiswa->password = bcrypt($request->password);
        }
        $mahasiswa->phone           = $request->phone;
        $mahasiswa->foto_mahasiswa  = $fotoUrl;
        $mahasiswa->save();

        if ($request->guard == 'student')
        {
            return redirect()->route('public.student.show', ['id' => $id])->with('update', 'Data Berhasi Diubah');
        }
    }

}
