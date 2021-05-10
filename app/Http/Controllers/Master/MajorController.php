<?php

namespace App\Http\Controllers\Master;

use App\DataTables\MajorDataTable;
use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use DataTables;
use Ramsey\Uuid\Uuid;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MajorDataTable $datatable)
    {
        $data = [
            'title' => 'Master Data Jurusan',

        ];
        return $datatable->render('jurusan.index', $data);
        // return view('jurusan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Jurusan',
            'data'  => null,
        ];
        return view('jurusan.form', $data);
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
                'kode_jurusan'  => 'required',
                'nama_jurusan'  => 'required',
            ],
            [
                'kode_jurusan.required'  => 'Kode Jurusan Tidak Boleh Kosong',
                'nama_jurusan.required'  => 'Nama Jurusan Tidak Boleh Kosong',
            ]
        );

        $uuid_jurusan   =  Uuid::uuid4()->getHex();

        $jurusan = new Major;
        $jurusan->uuid   = $uuid_jurusan;
        $jurusan->kode_jurusan  = $request->kode_jurusan;
        $jurusan->nama_jurusan  = $request->nama_jurusan;
        $jurusan->save();

        return redirect()->route('jurusan.index')->with('success', 'Data Berhasil Dibuat');
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
            'title' => 'Ubah Data Jurusan',
            'data'  =>  Major::findOrFail($id),
        ];
        return view('jurusan.form', $data);
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
                'kode_jurusan'  => 'required',
                'nama_jurusan'  => 'required',
            ],
            [
                'kode_jurusan.required'  => 'Kode Jurusan Tidak Boleh Kosong',
                'nama_jurusan.required'  => 'Nama Jurusan Tidak Boleh Kosong',
            ]
        );

        $jurusan = Major::findOrFail($id);
        $jurusan->kode_jurusan  = $request->kode_jurusan;
        $jurusan->nama_jurusan  = $request->nama_jurusan;
        $jurusan->save();

        return redirect()->route('jurusan.index')->with('update', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurusan = Major::findOrFail($id);
        $jurusan->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
