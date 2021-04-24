<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\Monev;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use DataTables;
use Illuminate\Support\Facades\Auth;

class MonevController extends Controller
{
    public function getMonev()
    {

        $data = Monev::all();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action   = '<a href="/monev/' . $data->uuid . '/edit" class="btn btn-sm btn-primary" >Ubah</a>';
                $action  .= \Form::open(['url' => '/monev/' . $data->uuid, 'method' => 'delete', 'style' => 'float:right']);
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
            'title' => 'Master Data Monev',
        ];

        return view('public.monev.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Monev',
            'magang'    => Magang::pluck('uuid', 'uuid'),
            'data'  => null,
        ];

        return view('public.monev.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'catatan_monev' => 'required',
            'tanggal_monev' => 'required',
            'file_monev'    => 'required',
        ]);

        $monev = new Monev;
        $monev->uuid        = Uuid::uuid4();
        $monev->catatan_monev   = $request->catatan_monev;
        $monev->tanggal_monev   = $request->tanggal_monev;
        $monev->file_monev      = $request->file_monev;
        $monev->magang_uuid     = $request->magang_uuid;
        $monev->prodi_uuid      = Auth::guard('lecturer')->User()->prodi_uuid;
        $monev->jurusan_uuid    = Auth::guard('lecturer')->User()->jurusan_uuid;
        $monev->save();

        return redirect(route('public.monev.index'))->with('success', 'Data Berhasil Dibuat');
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
            'title' => 'Ubah Data Monev',
            'magang'    => Magang::pluck('uuid', 'uuid'),
            'data'  => Monev::findOrFail($id),
        ];

        return view('public.monev.form', $data);
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
        $request->validate([
            'catatan_monev' => 'required',
            'tanggal_monev' => 'required',
            'file_monev'    => 'required',
        ]);

        $monev =  Monev::findOrFail($id);
        $monev->catatan_monev   = $request->catatan_monev;
        $monev->tanggal_monev   = $request->tanggal_monev;
        $monev->file_monev      = $request->file_monev;
        $monev->magang_uuid     = $request->magang_uuid;
        $monev->prodi_uuid      = Auth::guard('lecturer')->User()->prodi_uuid;
        $monev->jurusan_uuid    = Auth::guard('lecturer')->User()->jurusan_uuid;
        $monev->save();

        return redirect(route('public.monev.index'))->with('update', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $monev = Monev::findOrFail($id);
        $monev->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
