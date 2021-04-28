<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class DosenController extends Controller
{
    public function getDosen(Request $request)
    {
        $user = Auth::User()->prodi_uuid;
        $data = Dosen::where('prodi_uuid', $user)->with('prodi', 'jurusan')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action   = '<a href=' . route('dosen.edit', ['id' => $data->uuid]) . ' class="btn btn-sm btn-primary" >Ubah</a>';
                $action  .= '<a href=' . route('dosen.show', ['id' => $data->uuid]) . ' class="btn btn-sm btn-info" >Show</a>';
                $action  .= \Form::open(['url' => route('dosen.destroy', ['id' => $data->uuid]), 'method' => 'delete', 'style' => 'float:right']);
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
        $data = [
            'title' => 'Master Data Dosen',
        ];
        return view('dosen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Dosen',
            'data'  => null,
        ];

        return view('dosen.form', $data);
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
                'nip_dosen'         => 'required',
                'nama_dosen'        => 'required',
                'email'             => 'required',
                'password'          => 'required',
                'foto_dosen'        => 'image|mimes:jpeg,png,jpg|max:512'
            ],
            [
                'nip_dosen.required'     => 'NIP Dosen Tidak Boleh Kosong',
                'nama_dosen.required'    => 'Nama Dosen Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
                'password.required'      => 'Password Tidak Boleh Kosong',
                'foto_dosen.max'         => 'File Foto Maksimal 512KB'
            ]
        );

        if (request()->file('foto_dosen')) {
            $foto_dosen = request()->file('foto_dosen');
            $fotoUrl        = $foto_dosen->storeAs('file/foto_dosen', "{$request->nip_dosen}.{$foto_dosen->extension()}", "public");
        } else {
            $fotoUrl = null;
        }

        $dosen = new Dosen;
        $dosen->uuid            = Uuid::uuid4()->getHex();
        $dosen->nip_dosen       = $request->nip_dosen;
        $dosen->nama_dosen      = $request->nama_dosen;
        $dosen->email           = $request->email;
        $dosen->password        = bcrypt($request->password);
        $dosen->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $dosen->prodi_uuid      = Auth::User()->prodi_uuid;
        $dosen->foto_dosen      = $fotoUrl;
        $dosen->save();
        $dosen->assignRole('lecturer');

        return redirect()->route('dosen.index')->with('success', 'Data Berhasil Dibuat');
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
            'title' => 'Detail Dosen',
            'data'  => Dosen::findOrFail($id),
        ];

        return view('dosen.show', $data);
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
            'title' => 'Ubah Data Dosen',
            'data'  => Dosen::findOrFail($id),
        ];

        return view('dosen.form', $data);
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
                'nip_dosen'         => 'required',
                'nama_dosen'        => 'required',
                'email'             => 'required',
                'password'          => 'required',
                'foto_dosen'        => 'image|mimes:jpeg,png,jpg|max:512'
            ],
            [
                'nip_dosen.required'     => 'NIP Dosen Tidak Boleh Kosong',
                'nama_dosen.required'    => 'Nama Dosen Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
                'password.required'      => 'Password Tidak Boleh Kosong',
                'foto_dosen.max'         => 'File Foto Maksimal 512KB'
            ]
        );

        $dosen = Dosen::findOrFail($id);

        if ($request->password == null) {
            $password = $dosen->password;
        } else {
            $password = bcrypt($request->password);
        }

        if (request()->file('foto_dosen')) {
            Storage::delete($dosen->foto_dosen);
            $foto_dosen = request()->file('foto_dosen');
            $fotoUrl    = $foto_dosen->storeAs('file/foto_dosen', "{$request->nip_dosen}.{$foto_dosen->extension()}", "public");
        } else {
            $fotoUrl = $dosen->foto_dosen;
        }

        $dosen->nip_dosen       = $request->nip_dosen;
        $dosen->nama_dosen      = $request->nama_dosen;
        $dosen->email           = $request->email;
        $dosen->password        = $password;
        $dosen->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $dosen->prodi_uuid      = Auth::User()->prodi_uuid;
        $dosen->foto_dosen      = $fotoUrl;
        $dosen->save();

        return redirect()->route('dosen.index')->with('update', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        Storage::delete($dosen->foto_dosen);
        $dosen->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
