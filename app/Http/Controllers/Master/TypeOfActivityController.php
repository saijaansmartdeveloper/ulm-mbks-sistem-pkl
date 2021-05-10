<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\TypeOfActivity;
use Illuminate\Http\Request;
use DataTables;
use Ramsey\Uuid\Uuid;

class TypeOfActivityController extends Controller
{
    public function getJenisKegiatan(Request $request)
    {

        $data = TypeOfActivity::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action   = \Form::open(['url' => route('jenis_kegiatan.destroy', ['id' => $data->uuid]),  'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action  .= \Form::close();
                $action  .= '<a href=' . route('jenis_kegiatan.edit', ['id' => $data->uuid]) . ' class="btn btn-sm btn-primary" ><i class="fa fa-edit"></i></a> ';
                $action  .= '<button onclick="deleteRow(' . $data->id . ')" class = "btn btn-danger btn-sm" ><i class="fa fa-trash"></i></button>';

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
            'title' => 'Master Data Jenis Kegiatan',
        ];
        return view('jenis_kegiatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Jenis Kegiatan',
            'data'  => null,
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
                'kode_jenis_kegiatan' => 'required',
                'nama_jenis_kegiatan' => 'required',
            ],
            [
                'kode_jenis_kegiatan.required' => 'Kode Jenis Kegiatan Tidak Boleh Kosong',
                'nama_jenis_kegiatan.required' => 'Nama Jenis Kegiatan Tidak Boleh Kosong',
            ]
        );

        $uuid = Uuid::uuid4()->getHex();

        $jenis_kegiatan = new TypeOfActivity;
        $jenis_kegiatan->uuid                   = $uuid;
        $jenis_kegiatan->kode_jenis_kegiatan    = $request->kode_jenis_kegiatan;
        $jenis_kegiatan->nama_jenis_kegiatan    = $request->nama_jenis_kegiatan;
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
        $data = [
            'title' => 'Ubah Data Jenis Kegiatan',
            'data'  => TypeOfActivity::findOrFail($id),
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
                'kode_jenis_kegiatan' => 'required',
                'nama_jenis_kegiatan' => 'required',
            ],
            [
                'kode_jenis_kegiatan.required' => 'Kode Jenis Kegiatan Tidak Boleh Kosong',
                'nama_jenis_kegiatan.required' => 'Nama Jenis Kegiatan Tidak Boleh Kosong',
            ]
        );

        $jenis_kegiatan = TypeOfActivity::findOrFail($id);
        $jenis_kegiatan->kode_jenis_kegiatan    = $request->kode_jenis_kegiatan;
        $jenis_kegiatan->nama_jenis_kegiatan    = $request->nama_jenis_kegiatan;
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
