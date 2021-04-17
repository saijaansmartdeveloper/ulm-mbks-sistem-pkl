<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DataTables;
use Ramsey\Uuid\Uuid;

class ProdiController extends Controller
{
    public function getProdi(Request $request)
    {

        $data = Prodi::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action = '<a href="/prodi/' . $data->uuid . '/edit" class="btn btn-sm btn-primary" >Ubah</a>';
                $action .= \Form::open(['url' => '/prodi/' . $data->uuid, 'method' => 'delete', 'style' => 'float:right']);
                $action .= "<button type='submit' class = 'btn btn-danger btn-sm' >Hapus</button>";
                $action .= \Form::close();

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
        $data['title'] = 'Master Data Prodi';
        return view('prodi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Data Prodi';
        $data['jurusan'] = Jurusan::pluck('nama_jurusan', 'uuid');
        return view('prodi.create', $data);
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
                'kode_prodi' => 'required',
                'nama_prodi' => 'required',
                'jurusan_uuid' => 'required',
            ]
        );

        $uuid = Uuid::uuid4()->getHex();

        $prodi = new Prodi;
        $prodi->uuid = $uuid;
        $prodi->kode_prodi = $request->kode_prodi;
        $prodi->nama_prodi = $request->nama_prodi;
        $prodi->jurusan_uuid = $request->jurusan_uuid;
        $prodi->save();

        return redirect('/prodi')->with('success', 'Data Berhasil Dibuat');
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
        $data['title'] = 'Ubah Data Prodi';
        $data['prodi'] = Prodi::findOrFail($id);
        $data['jurusan'] = Jurusan::pluck('nama_jurusan', 'uuid');
        return view('prodi.edit', $data);
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
            ]
        );

        $prodi = Prodi::findOrFail($id);
        $prodi->kode_prodi = $request->kode_prodi;
        $prodi->nama_prodi = $request->nama_prodi;
        $prodi->jurusan_uuid = $request->jurusan_uuid;
        $prodi->save();

        return redirect('/prodi')->with('update', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect('/prodi')->with('delete', 'Data Berhasil Dihapus');
    }
}
