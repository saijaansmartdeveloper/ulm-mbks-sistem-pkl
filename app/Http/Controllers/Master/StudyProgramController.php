<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DataTables;
use Ramsey\Uuid\Uuid;

class StudyProgramController extends Controller
{
    public function getProdi()
    {

        $data = StudyProgram::with('jurusan')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action  = \Form::open(['url' => route('prodi.destroy', ['id' => $data->uuid]),  'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action .= \Form::close();
                $action .= '<a href=' . route('prodi.edit', ['id' => $data->uuid]) . ' class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> ';
                $action .= '<button onclick="deleteRow(' . $data->id . ')" class = "btn btn-danger btn-sm" ><i class="fa fa-trash"></i></button>';
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
            'title' => 'Master Data Program Studi'
        ];
        return view('prodi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'     => 'Tambah Data Program Studi',
            'jurusan'   => Major::pluck('nama_jurusan', 'uuid'),
            'data'      => null,
        ];

        return view('prodi.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'kode_prodi'    => 'required',
                'nama_prodi'    => 'required',
                'jurusan_uuid'  => 'required',
            ],
            [
                'kode_prodi.required'    => 'Kode Program Studi Tidak Boleh Kosong',
                'nama_prodi.required'    => 'Nama Program Studi Tidak Boleh Kosong',
                'jurusan_uuid.required'  => 'Major Tidak Boleh Kosong',
            ]
        );

        $uuid = Uuid::uuid4()->getHex();

        $prodi = new StudyProgram;
        $prodi->uuid = $uuid;
        $prodi->kode_prodi = $request->kode_prodi;
        $prodi->nama_prodi = $request->nama_prodi;
        $prodi->jurusan_uuid = $request->jurusan_uuid;
        $prodi->save();

        return redirect()->route('prodi.index')->with('success', 'Data Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title'     => 'Tambah Data Program Studi',
            'jurusan'   => Major::pluck('nama_jurusan', 'uuid'),
            'data'      => StudyProgram::findOrFail($id),
        ];

        return view('prodi.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'kode_prodi' => 'required',
                'nama_prodi' => 'required',
                'jurusan_uuid' => 'required',
            ],
            [
                'kode_prodi.required'    => 'Kode Program Studi Tidak Boleh Kosong',
                'nama_prodi.required'    => 'Nama Program Studi Tidak Boleh Kosong',
                'jurusan_uuid.required'  => 'Jurusan Tidak Boleh Kosong',
            ]
        );

        $prodi = StudyProgram::findOrFail($id);
        $prodi->kode_prodi = $request->kode_prodi;
        $prodi->nama_prodi = $request->nama_prodi;
        $prodi->jurusan_uuid = $request->jurusan_uuid;
        $prodi->save();

        return redirect()->route('prodi.index')->with('update', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prodi = StudyProgram::findOrFail($id);
        $prodi->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
