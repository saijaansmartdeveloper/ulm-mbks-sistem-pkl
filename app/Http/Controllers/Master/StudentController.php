<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Scopes\StudentDataTableScope;
use App\DataTables\StudentDataTable;
use App\Http\Controllers\Controller;
use App\Mail\NewUserNotification;
use App\Models\Student;
use App\Models\Major;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class StudentController extends Controller
{

    public function register()
    {
        $data = [
            'title'     => 'Registrasi Mahasiswa',
            'jurusan'   => Major::pluck('nama_jurusan', 'uuid'),
            'prodi'     => StudyProgram::pluck('nama_prodi', 'uuid'),
        ];

        return view('mahasiswa.register.create', $data);
    }

    public function register_store(Request $request)
    {
        $request->validate(
            [
                'nim_mahasiswa'     => 'required|unique:mahasiswa',
                'nama_mahasiswa'    => 'required',
                'email'             => 'required|email|unique:mahasiswa',
                'password'          => 'required',
                'phone'             => 'required',
                'foto_mahasiswa'    => 'image|mimes:jpeg,png,jpg|max:512',
            ],
            [
                'nim_mahasiswa.required'     => 'NIM Mahasiswa Tidak Boleh Kosong',
                'nama_mahasiswa.required'    => 'Nama Mahasiswa Tidak Boleh Kosong',
                'email.required'             => 'Email Tidak Boleh Kosong',
                'password.required'          => 'Password Tidak Boleh Kosong',
                'phone.required'             => 'No. Telepon Tidak Boleh Kosong',
                'foto_mahasiswa.max'         => 'File Foto Maksimal 512KB',
                'email.email'                => 'Inputan Harus berupa email',
                'email.unique'               => 'Email Telah Terdaftar'
            ]
        );

        $uuid   = Uuid::uuid4();

        $prodi  = StudyProgram::find($request->prodi_uuid);

        if (request()->file('foto_mahasiswa')) {
            $foto_mahasiswa = request()->file('foto_mahasiswa');
            $fotoUrl        = $foto_mahasiswa->storeAs('file/foto_mahasiswa', "{$request->nim_mahasiswa}.{$foto_mahasiswa->extension()}", "public");
        } else {
            $fotoUrl = null;
        }

        $mahasiswa = new Student;
        $mahasiswa->uuid            = $uuid;
        $mahasiswa->nim_mahasiswa   = $request->nim_mahasiswa;
        $mahasiswa->nama_mahasiswa  = $request->nama_mahasiswa;
        $mahasiswa->email           = $request->email;
        $mahasiswa->password        = bcrypt($request->password);
        $mahasiswa->phone           = $request->phone;
        $mahasiswa->foto_mahasiswa  = $fotoUrl;
        $mahasiswa->jurusan_uuid    = $prodi->jurusan_uuid;
        $mahasiswa->prodi_uuid      = $request->prodi_uuid;
        $mahasiswa->save();
        $mahasiswa->assignRole('student');

        Mail::to($mahasiswa->email)->queue(new NewUserNotification($mahasiswa));

        return redirect()->back()->with('success', 'Registrasi Student Berhasil, Tunggu Penetapan Program Kegiatan Selanjutnya');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StudentDataTable $datatable)
    {
        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Kelola Data Mahasiswa',
            'guard' => 'web',
            'user'  => $user
        ];

        return $datatable->addScope(new StudentDataTableScope($user))->render('public.student.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Tambah Mahasiswa',
            'guard' => 'web',
            'data'  => null,
            'user'  => $user
        ];

        return view('public.student.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nim_mahasiswa'     => 'required|unique:mahasiswa',
                'nama_mahasiswa'    => 'required',
                'email'             => 'required|email|unique:mahasiswa',
                'password'          => 'required',
                'phone'             => 'required',
                'foto_mahasiswa'    => 'max:512'
            ],
            [
                'nim_mahasiswa.required'     => 'NIM Mahasiswa Tidak Boleh Kosong',
                'nama_mahasiswa.required'    => 'Nama Mahasiswa Tidak Boleh Kosong',
                'email.required'             => 'Email Tidak Boleh Kosong',
                'password.required'          => 'Password Tidak Boleh Kosong',
                'phone.required'             => 'No. Telepon Tidak Boleh Kosong',
                'foto_mahasiswa.max'         => 'File Foto Maksimal 512KB',
                'email.email'                => 'Inputan Harus berupa email',
                'email.unique'               => 'Email Telah Terdaftar'
            ]
        );

        if (request()->file('foto_mahasiswa')) {
            $foto_mahasiswa = request()->file('foto_mahasiswa');
            $fotoUrl        = $foto_mahasiswa->storeAs('file/foto_mahasiswa', "{$request->nim_mahasiswa}.{$foto_mahasiswa->extension()}", "public");
        }

        $mahasiswa = new Student;
        $mahasiswa->uuid            = Uuid::uuid4();
        $mahasiswa->nim_mahasiswa   = $request->nim_mahasiswa;
        $mahasiswa->nama_mahasiswa  = $request->nama_mahasiswa;
        $mahasiswa->email           = $request->email;
        $mahasiswa->password        = bcrypt($request->password);
        $mahasiswa->phone           = $request->phone;
        $mahasiswa->foto_mahasiswa  = $fotoUrl ?? null;
        $mahasiswa->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $mahasiswa->prodi_uuid      = Auth::User()->prodi_uuid;
        $mahasiswa->save();
        $mahasiswa->assignRole('student');

        Mail::to($mahasiswa->email)->send(new NewUserNotification($mahasiswa));

        return redirect()->route('mahasiswa.show', ['id' => $mahasiswa->uuid])->with('success', 'Data Berhasi Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Detail Mahasiswa',
            'data'  => Student::findOrFail($id),
            'guard' => 'web',
            'user'  => $user
        ];

        return view('public.student.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Ubah Data Mahasiswa',
            'data'  =>  Student::findOrFail($id),
            'guard' => 'web',
            'user'  => $user
        ];

        return view('public.student.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nim_mahasiswa'     => 'required|unique:mahasiswa',
                'nama_mahasiswa'    => 'required',
                'email'             => 'required|email',
                'phone'             => 'required',
                'foto_mahasiswa'    => 'max:512'
            ],
            [
                'nim_mahasiswa.required'     => 'NIM Mahasiswa Tidak Boleh Kosong',
                'nama_mahasiswa.required'    => 'Nama Mahasiswa Tidak Boleh Kosong',
                'email.required'             => 'Email Tidak Boleh Kosong',
                'phone.required'             => 'No. Telepon Tidak Boleh Kosong',
                'foto_mahasiswa.max'         => 'File Foto Maksimal 512KB',
                'email.unique'               => 'Email Telah Terdaftar'
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
        $mahasiswa->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $mahasiswa->prodi_uuid      = Auth::User()->prodi_uuid;
        $mahasiswa->save();

        return redirect()->route('mahasiswa.show', ['id' => $id])->with('update', 'Data Berhasi Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mahasiswa = Student::findOrFail($id);
        Storage::delete($mahasiswa->foto_mahasiswa);
        $mahasiswa->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
