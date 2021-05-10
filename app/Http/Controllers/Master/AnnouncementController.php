<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class AnnouncementController extends Controller
{
    public function getPengumuman()
    {

        $data = Announcement::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action = \Form::open(['url' => route('pengumuman.destroy', ['id' => $data->id]),  'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action .= \Form::close();
                $action .= '<a href=' . route('pengumuman.edit', ['id' => $data->id]) . ' class="btn btn-sm btn-primary" ><i class="fa fa-edit"></i></a> ';
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
            'title' => 'Master Data Pengumuman'
        ];
        return view('pengumuman.super_admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pengumuman',
            'data'  => null
        ];
        return view('pengumuman.super_admin.form', $data);
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
                'judul_pengumuman'      => 'required',
                'content_pengumuman'    => 'required',
                'tanggal_pengumuman'    => 'required',
            ],
            [
                'judul_pengumuman.required'      => 'Judul Pengumuman Tidak Boleh Kosong',
                'content_pengumuman.required'    => 'Isi Pengumuman Tidak Boleh Kosong',
                'tanggal_pengumuman.required'    => 'Tanggal Pengumuman Tidak Boleh Kosong',
            ]
        );

        $pengumuman = new Announcement;
        $pengumuman->judul_pengumuman   = $request->judul_pengumuman;
        $pengumuman->content_pengumuman = $request->content_pengumuman;
        $pengumuman->tanggal_pengumuman = $request->tanggal_pengumuman;
        $pengumuman->user_id            = Auth::User()->uuid;
        $pengumuman->prodi_uuid         = Auth::User()->prodi_uuid;
        $pengumuman->jurusan_uuid       = Auth::user()->jurusan_uuid;
        $pengumuman->save();

        return redirect(route('pengumuman.index'))->with('success', 'Data Berhasil Dibuat');
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
            'title' => 'Ubah Data Pengumuman',
            'data'  => Announcement::findOrFail($id)
        ];
        return view('pengumuman.super_admin.form', $data);
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
                'judul_pengumuman'      => 'required',
                'content_pengumuman'    => 'required',
                'tanggal_pengumuman'    => 'required',
            ],
            [
                'judul_pengumuman.required'      => 'Judul Pengumuman Tidak Boleh Kosong',
                'content_pengumuman.required'    => 'Isi Pengumuman Tidak Boleh Kosong',
                'tanggal_pengumuman.required'    => 'Tanggal Pengumuman Tidak Boleh Kosong',
            ]
        );

        $pengumuman = Announcement::findOrFail($id);
        $pengumuman->judul_pengumuman   = $request->judul_pengumuman;
        $pengumuman->content_pengumuman = $request->content_pengumuman;
        $pengumuman->tanggal_pengumuman = $request->tanggal_pengumuman;
        $pengumuman->user_id            = Auth::User()->uuid;
        $pengumuman->prodi_uuid         = Auth::User()->prodi_uuid;
        $pengumuman->jurusan_uuid       = Auth::user()->jurusan_uuid;
        $pengumuman->save();

        return redirect(route('pengumuman.index'))->with('update', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengumuman = Announcement::findOrFail($id);
        $pengumuman->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
