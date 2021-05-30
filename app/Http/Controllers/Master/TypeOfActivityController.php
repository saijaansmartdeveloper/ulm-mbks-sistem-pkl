<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\TypeOfActivity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\TypeOfActivityDataTable;

class TypeOfActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TypeOfActivityDataTable $datatable)
    {
        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Master Data Jenis Kegiatan',
            'user'  => $user
        ];
        return $datatable->render('jenis_kegiatan.index', $data);
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
            'title' => 'Tambah Data Jenis Kegiatan',
            'data'  => null,
            'user'  => $user
        ];

        return view('jenis_kegiatan.form', $data);
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
                'kode_jenis_kegiatan'       => 'required',
                'nama_jenis_kegiatan'       => 'required',
                'deskripsi_jenis_kegiatan'  => 'required',
            ],
            [
                'kode_jenis_kegiatan.required'      => 'Kode Jenis Kegiatan Tidak Boleh Kosong',
                'nama_jenis_kegiatan.required'      => 'Nama Jenis Kegiatan Tidak Boleh Kosong',
                'deskripsi_jenis_kegiatan.required' => 'Deskripsi Jenis Kegiatan Tidak Boleh Kosong',
            ]
        );

        $uuid = Uuid::uuid4()->getHex();

        $jenis_kegiatan = new TypeOfActivity;
        $jenis_kegiatan->uuid                           = $uuid;
        $jenis_kegiatan->kode_jenis_kegiatan            = $request->kode_jenis_kegiatan;
        $jenis_kegiatan->nama_jenis_kegiatan            = $request->nama_jenis_kegiatan;
        $jenis_kegiatan->deskripsi_jenis_kegiatan       = $request->deskripsi_jenis_kegiatan;
        $jenis_kegiatan->save();

        return redirect()->route('jenis_kegiatan.index')->with('success', 'Data Berhasil Ditambah');
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
        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Ubah Data Jenis Kegiatan',
            'data'  => TypeOfActivity::findOrFail($id),
            'user'  => $user
        ];

        return view('jenis_kegiatan.form', $data);
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
                'kode_jenis_kegiatan'       => 'required',
                'nama_jenis_kegiatan'       => 'required',
                'deskripsi_jenis_kegiatan'  => 'required',
            ],
            [
                'kode_jenis_kegiatan.required'      => 'Kode Jenis Kegiatan Tidak Boleh Kosong',
                'nama_jenis_kegiatan.required'      => 'Nama Jenis Kegiatan Tidak Boleh Kosong',
                'deskripsi_jenis_kegiatan.required' => 'Deskripsi Jenis Kegiatan Tidak Boleh Kosong',
            ]
        );

        $jenis_kegiatan = TypeOfActivity::findOrFail($id);
        $jenis_kegiatan->kode_jenis_kegiatan        = $request->kode_jenis_kegiatan;
        $jenis_kegiatan->nama_jenis_kegiatan        = $request->nama_jenis_kegiatan;
        $jenis_kegiatan->deskripsi_jenis_kegiatan   = $request->deskripsi_jenis_kegiatan;

        $jenis_kegiatan->save();

        return redirect()->route('jenis_kegiatan.index')->with('update', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis_kegiatan = TypeOfActivity::findOrFail($id);
        $jenis_kegiatan->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
