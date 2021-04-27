<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class DosenController extends Controller
{
    public function getDosen(Request $request)
    {

        $data = Dosen::with('prodi', 'jurusan')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action   = '<a href="/dosen/' . $data->uuid . '/edit" class="btn btn-sm btn-primary" >Ubah</a>';
                $action  .= \Form::open(['url' => '/dosen/' . $data->uuid, 'method' => 'delete', 'style' => 'float:right']);
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
                'nip_dosen'     => 'required',
                'nama_dosen'    => 'required',
                'email'         => 'required',
                'password'      => 'required',

            ],
            [
                'nip_dosen.required'     => 'NIP Dosen Tidak Boleh Kosong',
                'nama_dosen.required'    => 'Nama Dosen Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
                'password.required'      => 'Password Tidak Boleh Kosong',
            ]
        );

        $uuid   =  Uuid::uuid4()->getHex();

        $dosen = new Dosen;
        $dosen->uuid            = $uuid;
        $dosen->nip_dosen       = $request->nip_dosen;
        $dosen->nama_dosen      = $request->nama_dosen;
        $dosen->email           = $request->email;
        $dosen->password        = bcrypt($request->password);
        $dosen->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $dosen->prodi_uuid      = Auth::User()->prodi_uuid;
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
        $data = [
            'title' => 'Tambah Data Dosen',
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
                'nip_dosen'     => 'required',
                'nama_dosen'    => 'required',
                'email'         => 'required',

            ],
            [
                'nip_dosen.required'     => 'NIP Dosen Tidak Boleh Kosong',
                'nama_dosen.required'    => 'Nama Dosen Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
            ]
        );

        $dosen = Dosen::findOrFail($id);
        
        if ($request->password == null) {
            $password = $dosen->password;
        } else {
            $password = bcrypt($request->password);
        }

        $dosen->nip_dosen       = $request->nip_dosen;
        $dosen->nama_dosen      = $request->nama_dosen;
        $dosen->email           = $request->email;
        $dosen->password        = $password;
        $dosen->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $dosen->prodi_uuid      = Auth::User()->prodi_uuid;
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
        $dosen->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
