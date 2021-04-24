<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Data Jurnal',
        ];

        return view('public.jurnal.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Jurnal',
            'data'  => null,
        ];

        return view('public.jurnal.form', $data);
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
            'catatan_jurnal'            => 'required',
            'file_image_jurnal'         => 'required',
            'file_dokumen_jurnal'       => 'required',
            'tanggal_jurnal'            => 'required',
            'status_jurnal'             => 'required',
            'tanggal_verifikasi_jurnal' => 'required',
            'komentar_jurnal'           => 'required',
        ]);

        // FILE UPLOAD!!!

        $jurnal = new Jurnal;
        $jurnal->uuid                           = Uuid::uuid4();
        $jurnal->catatan_jurnal                 = $request->catatan_jurnal;
        $jurnal->file_image_jurnal              = $request->file_image_jurnal;
        $jurnal->file_dokumen_jurnal            = $request->file_dokumen_jurnal;
        $jurnal->tanggal_jurnal                 = $request->tanggal_jurnal;
        $jurnal->status_jurnal                  = $request->status_jurnal;
        $jurnal->tanggal_verifikasi_jurnal      = $request->tanggal_verifikasi_jurnal;
        $jurnal->komentar_jurnal                = $request->komentar_jurnal;
        $jurnal->magang_uuid                    = $request->magang_uuid;

        $jurnal->save();

        return redirect()->route('public.jurnal.index')->with('success', 'Data berhasil Dibuat');

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
            'title' => 'Ubah Data Jurnal',
            'data'  => Jurnal::findOrFail($id),
        ];

        return view('public.jurnal.form', $data);
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
            'catatan_jurnal'            => 'required',
            'file_image_jurnal'         => 'required',
            'file_dokumen_jurnal'       => 'required',
            'tanggal_jurnal'            => 'required',
            'status_jurnal'             => 'required',
            'tanggal_verifikasi_jurnal' => 'required',
            'komentar_jurnal'           => 'required',
        ]);

        $jurnal = Jurnal::findOrFail($id);
        $jurnal->catatan_jurnal                 = $request->catatan_jurnal;
        $jurnal->file_image_jurnal              = $request->file_image_jurnal;
        $jurnal->file_dokumen_jurnal            = $request->file_dokumen_jurnal;
        $jurnal->tanggal_jurnal                 = $request->tanggal_jurnal;
        $jurnal->status_jurnal                  = $request->status_jurnal;
        $jurnal->tanggal_verifikasi_jurnal      = $request->tanggal_verifikasi_jurnal;
        $jurnal->komentar_jurnal                = $request->komentar_jurnal;
        $jurnal->magang_uuid                    = $request->magang_uuid;

        $jurnal->save();

        return redirect()->route('public.jurnal.index')->with('update', 'Data berhasil Diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        $jurnal->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
