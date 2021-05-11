<?php

namespace App\Http\Controllers\Master;

use App\DataTables\PartnerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class PartnerController extends Controller
{
    public function index(PartnerDataTable $datatable)
    {
        $data = [
            'title' => 'Master Data Mitra',
        ];
        return $datatable->render('mitra.index', $data);
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
            ],
            [
                'nama_mitra.required'                => 'Nama Mitra Tidak Boleh Kosong',
                'divisi_mitra.required'              => 'Divisi Mitra Tidak Boleh Kosong',
                'alamat_mitra.required'              => 'Alamat Mitra Tidak Boleh Kosong',
                'penanggung_jawab_mitra.required'    => 'Penanggung Jawab Mitra Tidak Boleh Kosong',
                'pamong_mitra.required'              => 'Pamong Mitra Tidak Boleh Kosong',
                'email.required'                     => 'Email Tidak Boleh Kosong',
                'username.required'                  => 'Username Tidak Boleh Kosong',
                'password.required'                  => 'Password Tidak Boleh Kosong',
                'phone.required'                     => 'No Telpon Tidak Boleh Kosong',
            ]
        );

        $uuid = Uuid::uuid4()->getHex();

        $mitra = new Partner;
        $mitra->uuid                    = $uuid;
        $mitra->nama_mitra              = $request->nama_mitra;
        $mitra->divisi_mitra            = $request->divisi_mitra;
        $mitra->alamat_mitra            = $request->alamat_mitra;
        $mitra->penanggung_jawab_mitra  = $request->penanggung_jawab_mitra;
        $mitra->pamong_mitra            = $request->pamong_mitra;
        $mitra->email                   = $request->email;
        $mitra->username                = $request->username;
        $mitra->password                = bcrypt($request->password);
        $mitra->phone                   = $request->phone;
        $mitra->save();
        $mitra->assignRole('partner');

        return redirect()->route('mitra.index')->with('success', 'Data Berhasil Dibuat');
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Mitra',
            'data'  => Partner::findOrFail($id),
        ];

        return view('mitra.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Ubah Data Mitra',
            'data'  => Partner::findOrFail($id),
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
                'phone'                     => 'required',
            ],
            [
                'nama_mitra.required'                => 'Nama Mitra Tidak Boleh Kosong',
                'divisi_mitra.required'              => 'Divisi Mitra Tidak Boleh Kosong',
                'alamat_mitra.required'              => 'Alamat Mitra Tidak Boleh Kosong',
                'penanggung_jawab_mitra.required'    => 'Penanggung Jawab Mitra Tidak Boleh Kosong',
                'pamong_mitra.required'              => 'Pamong Mitra Tidak Boleh Kosong',
                'email.required'                     => 'Email Tidak Boleh Kosong',
                'username.required'                  => 'Username Tidak Boleh Kosong',
                'phone.required'                     => 'No Telpon Tidak Boleh Kosong',
            ]
        );


        $mitra = Partner::findOrFail($id);
        if ($request->password == null) {
            $password = $mitra->password;
        } else {
            $password = bcrypt($request->password);
        }

        $mitra->nama_mitra              = $request->nama_mitra;
        $mitra->divisi_mitra            = $request->divisi_mitra;
        $mitra->alamat_mitra            = $request->alamat_mitra;
        $mitra->penanggung_jawab_mitra  = $request->penanggung_jawab_mitra;
        $mitra->pamong_mitra            = $request->pamong_mitra;
        $mitra->email                   = $request->email;
        $mitra->username                = $request->username;
        $mitra->password                = $password;
        $mitra->phone                   = $request->phone;
        $mitra->save();

        return redirect()->route('mitra.index')->with('update', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $mitra = Partner::findOrFail($id);
        $mitra->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
