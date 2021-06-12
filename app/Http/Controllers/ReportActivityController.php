<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\ReportActivity;
use Illuminate\Support\Facades\Auth;
use App\DataTables\ActivityReportDataTable;

class ReportActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:lecturer');
    }

    public function index (ActivityReportDataTable $datatable)
    {
        $user = Auth::guard('lecturer')->user();

        $data = [
            'title' => 'Daftar Laporan Kegiatan',
            'guard' => $user->guard_name,
            'data' => null,
            'user' => $user
        ];

        return $datatable->render('public.laporan-kegiatan.index', $data);
    }


    public function create ()
    {
        $user = Auth::guard('lecturer')->user();

        foreach ($user->activities()->get() as $value) {
            $activity[$value->uuid] = $value->partner()->first()->nama_mitra . " - " . $value->student()->first()->nama_mahasiswa . " - " . $value->typeofactivity()->first()->nama_jenis_kegiatan;
        }

        $data = [
            'title'     => 'Buat Laporan Kegiatan',
            'guard'     => $user->guard_name,
            'data'      => null,
            'kegiatan'  => $activity ?? [],
            'user'      => $user
        ];

        return view('public.laporan-kegiatan.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'judul_laporan_activity'   => 'required',
                'catatan_laporan_activity' => 'required',
                'tanggal_laporan_activity' => 'required',
                'kegiatan_uuid'         => 'required',
                'jenis_laporan'         => 'required',
                'file_laporan_activity'    => 'max:1024',
            ],
            [
                'catatan_laporan_activity.required'    => 'Catatan Tidak Boleh Kosong',
                'tanggal_laporan_activity.required'    => 'Tanggal Tidak Boleh Kosong',
                'magang_uuid.required'              => 'Kegiatan Tidak Boleh Kosong',
                'jenis_laporan.required'            => 'Jenis Laporan Tidak Boleh Kosong',
                'file_laporan_activity.max'            => 'File Monitor Evaluasi Maksimal 1MB',
            ]
        );

        $user = Auth::guard('lecturer')->user();

        $uuid = Uuid::uuid4();

        if (request()->file('file_laporan_activity')) {
            $file_laporan_activity = request()->file('file_laporan_activity');
            $fileUrl            = $file_laporan_activity->storeAs('file/file_laporan_activity', "{$uuid}.{$file_laporan_activity->extension()}", "public");
        } else {
            $fileUrl = null;
        }

        $activity = new ReportActivity();
        $activity->uuid                    = $uuid;
        $activity->judul_laporan_activity     = $request->judul_laporan_activity;
        $activity->catatan_laporan_activity   = $request->catatan_laporan_activity;
        $activity->tanggal_laporan_activity   = $request->tanggal_laporan_activity;
        $activity->jenis_laporan           = $request->jenis_laporan;
        $activity->file_laporan_activity      = $fileUrl;
        $activity->kegiatan_uuid           = $request->kegiatan_uuid;
        $activity->dosen_uuid              = $user->uuid;
        $activity->prodi_uuid              = $user->prodi_uuid;
        $activity->jurusan_uuid            = $user->jurusan_uuid;
        $activity->save();

        return redirect(route('public.laporan-kegiatan.index'))->with('success', 'Data Berhasil Dibuat');
    }

    public function show($id)
    {
        $user = Auth::guard('lecturer')->user();
        $data = [
            'title' => 'Detail Laporan Kegiatan',
            'guard' => $user->guard_name,
            'data'  => ReportActivity::findOrFail($id),
            'user'  => $user
        ];

        return view('public.laporan-kegiatan.show', $data);
    }
}
