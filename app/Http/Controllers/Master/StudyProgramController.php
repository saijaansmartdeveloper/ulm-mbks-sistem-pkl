<?php

namespace App\Http\Controllers\Master;

use DataTables;
use App\Models\Major;
use Ramsey\Uuid\Uuid;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\DataTables\StudyProgramDataTable;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StudyProgramDataTable $datatable)
    {
        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Master Data Program Studi',
            'user'  => $user
        ];
        return $datatable->render('prodi.index', $data);
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
            'title'     => 'Tambah Data Program Studi',
            'jurusan'   => Major::pluck('nama_jurusan', 'uuid'),
            'data'      => null,
            'user'      => $user
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
        $user = Auth::guard('web')->user();

        $data = [
            'title'     => 'Tambah Data Program Studi',
            'jurusan'   => Major::pluck('nama_jurusan', 'uuid'),
            'data'      => StudyProgram::findOrFail($id),
            'user'      => $user
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
