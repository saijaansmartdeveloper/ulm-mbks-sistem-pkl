<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Major;
use App\Models\Announcement;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\AnnouncementDataTable;
use App\DataTables\Scopes\AnnouncementDataTableScope;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AnnouncementDataTable $datatable)
    {
        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Kelola Pengumuman',
            'user' => $user
        ];
        return $datatable->addScope(new AnnouncementDataTableScope($user))->render('pengumuman.index', $data);

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
            'title' => 'Buat Pengumuman',
            'data'  => null,
            'jurusan'   => Major::pluck('nama_jurusan', 'uuid'),
            'prodi'     => StudyProgram::pluck('nama_prodi', 'uuid'),
            'user'      => $user
        ];
        return view('pengumuman.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::User();

        $request->validate(
            [
                'judul_pengumuman'      => 'required',
                'content_pengumuman'    => 'required',
                'tanggal_pengumuman'    => 'required',
                'jenis_pengumuman'      => 'required',

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
        $pengumuman->jenis_pengumuman   = $request->jenis_pengumuman;
        $pengumuman->tanggal_pengumuman = $request->tanggal_pengumuman;
        $pengumuman->status_pengumuman  = $request->status_pengumuman ?? 1;
        $pengumuman->user_uuid          = $user->uuid;

        if ($user->role_pengguna == 'super_admin') {
            $pengumuman->prodi_uuid         = $request->prodi_uuid;
            $pengumuman->jurusan_uuid       = $request->jurusan_uuid;
        } else {
            $pengumuman->prodi_uuid         = $user->prodi_uuid;
            $pengumuman->jurusan_uuid       = $user->jurusan_uuid;
        }

        $pengumuman->save();

        return redirect(route('pengumuman'))->with('success', 'Data Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
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
        $announcement = Announcement::findOrFail($id);

        if ($user->uuid != $announcement->user_uuid) {
            return redirect()->back()->with('delete', 'Anda Dilarang Untuk Mengubah Pengumuman Ini');
        }

        $data = [
            'title'     => 'Ubah Pengumuman',
            'data'      => $announcement,
            'jurusan'   => Major::pluck('nama_jurusan', 'uuid'),
            'prodi'     => StudyProgram::pluck('nama_prodi', 'uuid'),
            'user'  => $user
        ];

        return view('pengumuman.form', $data);
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
        $user = Auth::guard('web')->user();

        $request->validate(
            [
                'judul_pengumuman'      => 'required',
                'content_pengumuman'    => 'required',
                'tanggal_pengumuman'    => 'required',
                'jenis_pengumuman'      => 'required',

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
        $pengumuman->jenis_pengumuman   = $request->jenis_pengumuman;
        $pengumuman->tanggal_pengumuman = $request->tanggal_pengumuman;
        $pengumuman->status_pengumuman  = $request->status_pengumuman ?? 1;
        $pengumuman->user_uuid          = $user->uuid;

        if ($user->role_pengguna == 'super_admin') {
            $pengumuman->prodi_uuid         = $request->prodi_uuid;
            $pengumuman->jurusan_uuid       = $request->jurusan_uuid;
        } else {
            $pengumuman->prodi_uuid         = $user->prodi_uuid;
            $pengumuman->jurusan_uuid       = $user->jurusan_uuid;
        }

        $pengumuman->save();

        return redirect(route('pengumuman'))->with('update', 'Data Berhasil Diubah');
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
