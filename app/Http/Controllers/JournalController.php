<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class JournalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function index()
    {
        $user   = Auth::guard('student')->user();

        $data = [
            'title'     => $user->nama_mahasiswa,
            'guard'     => 'student',
            'data'      => Magang::where('mahasiswa_uuid', $user->uuid)->first()
        ];

        return view("public.jurnal.index", $data);
    }

    public function create()
    {
        $user   = Auth::guard('student')->user();

        $data = [
            'title'     => $user->nama_mahasiswa,
            'guard'     => 'student',
            'data'      => null
        ];

        return view("public.jurnal.form", $data);
    }


    public function store(Request $request)
    {
        $user   = Auth::guard('student')->user();

        $request->validate([
            'catatan_jurnal'            => 'required',
            'tanggal_jurnal'            => 'required',
        ]);

        $file_image     = request()->file('file_image_jurnal');
        $fileNameImg    = $user->nim_mahasiswa . '_' . time() . '.' . $file_image->extension();
        $fileImage      = $file_image->storeAs('file/file_image_jurnal', $fileNameImg, "public");

        $file_doc       = request()->file('file_dokumen_jurnal');
        $fileNameDoc    = $user->nim_mahasiswa . '_' . time() . '.' . $file_doc->extension();
        $fileDoc        = $file_image->storeAs('file/file_dokumen_jurnal', $fileNameDoc, "public");

        Jurnal::create([
            'catatan_jurnal'    => $request->catatan_jurnal,
            'tanggal_jurnal'    => $request->tanggal_jurnal,
            'uuid'              => Uuid::uuid4(),
            'magang_uuid'       => $user->kegiatan()->first()->uuid,
            'file_image_jurnal' => $fileImage,
            'file_dokumen_jurnal' => $fileDoc
        ]);

        return redirect()->route('public.journal.index')->with('success', 'Jurnal berhasil Dibuat');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verify($id)
    {

    }
}
