<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Major;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class StudentController extends Controller
{
    public function __construct()
    {

        // $this->middleware('guest')->except('register_store');
    }

    public function getMahasiswa(Request $request)
    {
        $user = Auth::User()->prodi_uuid;
        $data = Student::where('prodi_uuid', $user)->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action   = \Form::open(['url' => route('mahasiswa.destroy', ['id' => $data->uuid]), 'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action  .= \Form::close();
                $action  .= '<a href=' . route('mahasiswa.edit', ['id' => $data->uuid]) . ' class="btn btn-sm btn-primary" ><i class="fa fa-edit"></i></a> ';
                $action  .= '<a href=' . route('mahasiswa.show', ['id' => $data->uuid]) . ' class="btn btn-sm btn-info" ><i class="fa fa-search"></i></a> ';
                $action  .= '<button onclick="deleteRow(' . $data->id . ')" class = "btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Data Mahasiswa',
        ];

        return view('mahasiswa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Mahasiswa',
            'data'  => null,
        ];

        return view('mahasiswa.form', $data);
    }

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
                'nim_mahasiswa'     => 'required',
                'nama_mahasiswa'    => 'required',
                'email'             => 'required|email',
                'password'          => 'required',
                'phone'             => 'required',
                'foto_mahasiswa'    => 'image|mimes:jpeg,png,jpg|max:512'
            ],
            [
                'nim_mahasiswa.required'     => 'NIM Mahasiswa Tidak Boleh Kosong',
                'nama_mahasiswa.required'    => 'Nama Mahasiswa Tidak Boleh Kosong',
                'email.required'             => 'Email Tidak Boleh Kosong',
                'password.required'          => 'Password Tidak Boleh Kosong',
                'phone.required'             => 'No. Telepon Tidak Boleh Kosong',
                'foto_mahasiswa.max'         => 'File Foto Maksimal 512KB'
            ]
        );

        $uuid   = Uuid::uuid4()->getHex();
        $prodi  = StudyProgram::findOrFail($request->prodi_uuid);

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

        return redirect()->back()->with('success', 'Registrasi Student Berhasil, Tunggu Penetapan Activity Selanjutnya');
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
                'nim_mahasiswa'     => 'required',
                'nama_mahasiswa'    => 'required',
                'email'             => 'required',
                'password'          => 'required',
                'phone'             => 'required',
            ],
            [
                'nim_mahasiswa.required'     => 'NIM Mahasiswa Tidak Boleh Kosong',
                'nama_mahasiswa.required'    => 'Nama Mahasiswa Tidak Boleh Kosong',
                'email.required'             => 'Email Tidak Boleh Kosong',
                'password.required'          => 'Password Tidak Boleh Kosong',
                'phone.required'             => 'No. Telepon Tidak Boleh Kosong',
                'foto_mahasiswa.max'         => 'File Foto Maksimal 512KB'
            ]
        );

        if (request()->file('foto_mahasiswa')) {
            $foto_mahasiswa = request()->file('foto_mahasiswa');
            $fotoUrl        = $foto_mahasiswa->storeAs('file/foto_mahasiswa', "{$request->nim_mahasiswa}.{$foto_mahasiswa->extension()}", "public");
        } else {
            $fotoUrl = null;
        }

        $mahasiswa = new Student;
        $mahasiswa->uuid            = Uuid::uuid4();
        $mahasiswa->nim_mahasiswa   = $request->nim_mahasiswa;
        $mahasiswa->nama_mahasiswa  = $request->nama_mahasiswa;
        $mahasiswa->email           = $request->email;
        $mahasiswa->password        = bcrypt($request->password);
        $mahasiswa->phone           = $request->phone;
        $mahasiswa->foto_mahasiswa  = $fotoUrl;
        $mahasiswa->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $mahasiswa->prodi_uuid      = Auth::User()->prodi_uuid;
        $mahasiswa->save();
        $mahasiswa->assignRole('student');


        return redirect()->route('mahasiswa.index')->with('success', 'Data Berhasi Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'title' => 'Detail Mahasiswa',
            'data'  => Student::findOrFail($id),
        ];

        return view('mahasiswa.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Ubah Data Mahasiswa',
            'data'  =>  Student::findOrFail($id)
        ];

        return view('mahasiswa.form', $data);
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
                'nim_mahasiswa'     => 'required',
                'nama_mahasiswa'    => 'required',
                'email'             => 'required',
                'phone'             => 'required',
            ],
            [
                'nim_mahasiswa.required'     => 'NIM Mahasiswa Tidak Boleh Kosong',
                'nama_mahasiswa.required'    => 'Nama Mahasiswa Tidak Boleh Kosong',
                'email.required'             => 'Email Tidak Boleh Kosong',
                'phone.required'             => 'No. Telepon Tidak Boleh Kosong',
                'foto_mahasiswa.max'         => 'File Foto Maksimal 512KB'
            ]
        );

        $mahasiswa = Student::findOrFail($id);


        if (request()->file('foto_dosen')) {
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

        return redirect()->route('mahasiswa.index')->with('update', 'Data Berhasi Diubah');
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
