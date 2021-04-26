<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\Request;
use DataTables;
use Ramsey\Uuid\Uuid;

class MitraController extends Controller
{
    public function getMitra(Request $request)
    {

        $data = Mitra::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action = '<a href="/mitra/' . $data->uuid . '/edit" class="btn btn-sm btn-primary" >Ubah</a>';
                $action .= \Form::open(['url' => '/mitra/' . $data->uuid, 'method' => 'delete', 'style' => 'float:right']);
                $action .= "<button type='submit' class = 'btn btn-danger btn-sm' >Hapus</button>";
                $action .= \Form::close();

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        $data = [
            'title' => 'Master Data Mitra',
        ];
        return view('mitra.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Mitra',
            'data'  => null,
        ];
        return view('mitra.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_mitra'                => 'required',
                'divisi_mitra'              => 'required',
                'alamat_mitra'              => 'required',
                'penanggung_jawab_mitra'    => 'required',
                'pamong_mitra'              => 'required',
                'email'                     => 'required',
                'username'                  => 'required',
                'password'                  => 'required',
                'phone'                     => 'required',
            ]
        );

        $uuid = Uuid::uuid4()->getHex();

        $mitra = new Mitra;
        $mitra->uuid                    = $uuid;
        $mitra->nama_mitra              = $request->nama_mitra;
        $mitra->divisi_mitra            = $request->divisi_mitra;
        $mitra->alamat_mitra            = $request->alamat_mitra;
        $mitra->penanggung_jawab_mitra  = $request->penanggung_jawab_mitra;
        $mitra->pamong_mitra            = $request->pamong_mitra;
        $mitra->email                   = $request->email;
        $mitra->username                = $request->username;
        $mitra->password                = $request->password;
        $mitra->phone                   = $request->phone;
        $mitra->save();
        $mitra->assignRole('partner');

        return redirect('/mitra')->with('success', 'Data Berhasil Dibuat');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Ubah Data Mitra',
            'data'  => Mitra::findOrFail($id),
        ];

        return view('mitra.form', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_mitra'                => 'required',
                'divisi_mitra'              => 'required',
                'alamat_mitra'              => 'required',
                'penanggung_jawab_mitra'    => 'required',
                'pamong_mitra'              => 'required',
                'email'                     => 'required',
                'username'                  => 'required',
                'password'                  => 'required',
                'phone'                     => 'required',
            ]
        );


        $mitra = Mitra::findOrFail($id);
        $mitra->nama_mitra              = $request->nama_mitra;
        $mitra->divisi_mitra            = $request->divisi_mitra;
        $mitra->alamat_mitra            = $request->alamat_mitra;
        $mitra->penanggung_jawab_mitra  = $request->penanggung_jawab_mitra;
        $mitra->pamong_mitra            = $request->pamong_mitra;
        $mitra->email                   = $request->email;
        $mitra->username                = $request->username;
        $mitra->password                = $request->password;
        $mitra->phone                   = $request->phone;
        $mitra->save();

        return redirect('/mitra')->with('update', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $mitra = Mitra::findOrFail($id);
        $mitra->delete();

        return redirect('/mitra')->with('delete', 'Data Berhasil Dihapus');
    }
}
