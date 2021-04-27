<?php

namespace App\Http\Controllers\Jurusan;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use DataTables;
use Ramsey\Uuid\Uuid;

class JurusanController extends Controller
{
    public function getJurusan(Request $request)
    {

        $data = Jurusan::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action   = '<a href=' . route('jurusan.edit', ['id' => $data->uuid]) . ' class="btn btn-sm btn-primary" >Ubah</a>';
                $action  .= \Form::open(['url' => route('jurusan.destroy', ['id' => $data->uuid]), 'method' => 'delete', 'style' => 'float:right']);
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
            'title' => 'Master Data Jurusan',

        ];
        return view('jurusan.index', $data);
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

        $jurusan = new Jurusan;
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
            'data'  =>  Jurusan::findOrFail($id),
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

        $jurusan = Jurusan::findOrFail($id);
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
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
