<?php

namespace App\Http\Controllers;

use App\DataTables\StudentDataTable;
use App\Models\Jurnal;
use App\Models\Magang;
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
        $user   = Auth::guard('lecturer')->user();

        $data = [
            'title' => 'Welcome, ' . $user->nama_dosen,
            'guard' => 'lecturer',
            'data'  => [
                'magang' => Magang::where('dosen_uuid', $user->uuid)->get()
            ]
        ];

        return view("public.lecturer.index", $data);
    }

    public function guidance(StudentDataTable $dataTable)
    {
//        $user   = Auth::guard('lecturer')->user();
//
//        $data = [
//            'title' => 'Welcome, ' . $user->nama_dosen,
//            'guard' => 'lecturer',
//            'data'  => null
//        ];
//
//        return $dataTable->render('public.student.list', $data);

        $data = [
            'title' => 'Daftar Mahasiswa',
        ];

        return view('public.lecturer.journal.index', $data);
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
        $jurnal = Jurnal::find($id);

        if ($request->komentar_jurnal != null) {
            $jurnal->komentar_jurnal    = $request->komentar_jurnal;
        }
        $jurnal->status_jurnal      = $request->status_jurnal;
        $jurnal->save();

        return redirect()->back()->with('info', 'Jurnal Berhasil Diterima');

//        return redirect()->route('public.lecturer.student_guidance.show', ['id' => $jurnal->magang()->first()->mahasiswa_uuid])->with('update', 'Komentar Berhasil Ditambahkan');
    }

    public function update_status_all(Request $request)
    {
        $jurnal = Jurnal::whereIn('uuid', $request->ids)->update(['status_jurnal' => 'accepted']);
        return redirect()->back()->with('info', 'Jurnal Berhasil Diterima');
    }

}
