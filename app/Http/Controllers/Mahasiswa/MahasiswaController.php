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

        $this->middleware('guest')->except('register_store');

    }

    public function getMahasiswa(Request $request)
    {

        $data = Mahasiswa::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action   = '<a href="/mahasiswa/' . $data->uuid . '/edit" class="btn btn-sm btn-primary" >Ubah</a>';
                $action  .= \Form::open(['url' => '/mahasiswa/' . $data->uuid, 'method' => 'delete', 'style' => 'float:right']);
                $action  .= "<button type='submit' class = 'btn btn-danger btn-sm' >Hapus</button>";
                $action  .= \Form::close();

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
        return view('mahasiswa.view');
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
        $request->validate([
            'nim_mahasiswa'     => 'required',
            'nama_mahasiswa'    => 'required',
            'email'             => 'required|email',
            'password'          => 'required',
            'phone'             => 'required',
            'foto_mahasiswa'    => 'image|mimes:jpeg,png,jpg|max:1024'
        ]);

        $uuid   = Uuid::uuid4()->getHex();
        $prodi  = Prodi::findOrFail($request->prodi_uuid);

        $foto_mahasiswa = request()->file('foto_mahasiswa');
        $fotoUrl        = $foto_mahasiswa->storeAs('file/foto_mahasiswa', "{$request->nim_mahasiswa}.{$foto_mahasiswa->extension()}", "public");

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
        $mahasiswa->assignRoles('student');
        
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
        //
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
