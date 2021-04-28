<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class MahasiswaController extends Controller
{
    public function __construct()
    {

        // $this->middleware('guest')->except('register_store');
    }

    public function getMahasiswa(Request $request)
    {
        $user = Auth::User()->prodi_uuid;
        $data = Mahasiswa::where('prodi_uuid', $user)->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action   = '<a href=' . route('mahasiswa.show', ['id' => $data->uuid]) . ' class="btn btn-sm btn-info" >Show</a>';
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
        return view('mahasiswa.create');
    }

    public function register()
    {
        $data['jurusan']    = Jurusan::pluck('nama_jurusan', 'uuid');
        $data['prodi']    = Prodi::pluck('nama_prodi', 'uuid');
        $data['title'] = 'Register Mahasiswa';
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
        $prodi  = Prodi::findOrFail($request->prodi_uuid);

        if (request()->file('foto_mahasiswa')) {
            $foto_mahasiswa = request()->file('foto_mahasiswa');
            $fotoUrl        = $foto_mahasiswa->storeAs('file/foto_mahasiswa', "{$request->nim_mahasiswa}.{$foto_mahasiswa->extension()}", "public");
        } else {
            $fotoUrl = null;
        }

        $mahasiswa = new Mahasiswa;
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

        return redirect()->back()->with('success', 'Registrasi Mahasiswa Berhasil, Tunggu Penetapan Magang Selanjutnya');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim_mahasiswa'     => 'required',
            'nama_mahasiswa'    => 'required',
            'email'             => 'required',
            'password'          => 'required',
            'phone'             => 'required',
        ]);

        $uuid = Uuid::uuid4()->getHex();

        $mahasiswa = new Mahasiswa;
        $mahasiswa->uuid            = $uuid;
        $mahasiswa->nim_mahasiswa   = $request->nim_mahasiswa;
        $mahasiswa->nama_mahasiswa  = $request->nama_mahasiswa;
        $mahasiswa->email           = $request->email;
        $mahasiswa->password        = bcrypt($request->password);
        $mahasiswa->phone           = $request->phone;
        $mahasiswa->phone           = $request->phone;
        $mahasiswa->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $mahasiswa->prodi_uuid      = Auth::User()->prodi_uuid;
        $mahasiswa->save();

        return redirect('/mahasiswa')->with('success', 'Data Berhasi Dibuat');
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
            'data'  => Mahasiswa::findOrFail($id),
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
        $data['mahasiswa'] = Mahasiswa::findOrFail($id);

        return view('mahasiswa.edit', $data);
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
        $request->validate([
            'nim_mahasiswa'     => 'required',
            'nama_mahasiswa'    => 'required',
            'email'             => 'required',
            'password'          => 'required',
            'phone'             => 'required',
        ]);


        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->nim_mahasiswa   = $request->nim_mahasiswa;
        $mahasiswa->nama_mahasiswa  = $request->nama_mahasiswa;
        $mahasiswa->email           = $request->email;
        $mahasiswa->password        = bcrypt($request->password);
        $mahasiswa->phone           = $request->phone;
        $mahasiswa->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $mahasiswa->prodi_uuid      = Auth::User()->prodi_uuid;
        $mahasiswa->save();

        return redirect('/mahasiswa')->with('update', 'Data Berhasi Dibuat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect('/mahasiswa')->with('delete', 'Data Berhasil Dihapus');
    }
}
