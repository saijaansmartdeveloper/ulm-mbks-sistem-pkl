<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Magang;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class LecturerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:lecturer');
    }

    public function index()
    {
        $data = [
            'title' => 'Dosen',
            'guard' => 'lecturer',
            'data'  => null
        ];

        return view("public.lecturer.index", $data);
    }

    public function getListMahasiswaBimbingan()
    {
        $user = Auth::guard('lecturer')->user();
        $data = Magang::where('dosen_uuid', $user->uuid)->with('student', 'partner')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action = '<a href="mahasiswa_bimbingan/' . $data->mahasiswa_uuid . '" class="btn btn-sm btn-info" >Show</a>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index_journal()
    {
        $data = [
            'title' => 'List Mahasiswa Bimbingan',
        ];

        return view('public.lecturer.journal.index', $data);
    }

    public function show_student_detail($id)
    {
        $data = [
            'title' => 'Jurnal Mahasiswa',
            'data'  => Magang::where('mahasiswa_uuid', $id)->first(),
        ];

        return view('public.lecturer.journal.show', $data);
    }

    public function show_student_journal($id)
    {
        $data = [
            'title' => 'Detail Jurnal',
            'data'  => Jurnal::where('uuid', $id)->first(),
        ];


        return view('public.lecturer.journal.form', $data);
    }

    public function update_journal(Request $request, $id)
    {
        $jurnal = Jurnal::where('uuid', $id)->first();
        $jurnal->komentar_jurnal = $request->komentar_jurnal;
        $jurnal->save();

        
        return redirect()->route('public.lecturer.student_guidance.show', ['id' => $jurnal->magang()->first()->mahasiswa_uuid])->with('update', 'Komentar Berhasil Ditambahkan');
    }
}
