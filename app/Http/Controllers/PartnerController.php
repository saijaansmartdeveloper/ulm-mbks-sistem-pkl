<?php

namespace App\Http\Controllers;

use App\DataTables\StudentDataTable;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:partner');
    }

    public function index(StudentDataTable $dataTable)
    {
        $user   = Auth::guard('partner')->user();

        $data = [
            'title' => 'Selamat Datang, ' . $user->pamong_mitra,
            'guard' => $user->guardName,
            'data'  => [
                'jumlah_bimbingan'  => $user->activities()->first() == null ? 0 : ($user->activities()->first()->student()->count() ?? 0),
                'jumlah_jurnal'     => $user->activities()->first() == null ? 0 : ($user->activities()->first()->journals()->count() ?? 0),
                'jumlah_monev'      => 0,
                'persentase_jurnal' => "0 %",
                'persentase_monev'  => "0 %",
                'journals' => [] ,
                'monev' => [],
            ],
            'user'  => $user
        ];

        return $dataTable->render("public.partner.index", $data);
    }

    public function show($id)
    {
        if (! (Auth::guard('student')->check() || Auth::guard('lecturer')->check() || Auth::guard('partner')->check()))
        {
            abort(403);
        }

        $user   = Auth::guard('partner')->user() ?? Partner::findOrFail($id);

        $data = [
            'title'     => 'Profile ' . $user->pamong_mitra,
            'guard'     => $user->guardName,
            'data'      => $user,
            'user'      => $user
        ];

        return view('public.partner.show', $data);
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

        return redirect()->route('public.partner.index')->with('update', 'Data Berhasil Diubah');
    }

    public function guidance()
    {

    }
}
