<?php

namespace App\Http\Controllers\Master;

use App\DataTables\ActivityDataTable;
use App\DataTables\Scopes\ActivityDataTableScope;
use App\Http\Controllers\Controller;
use App\Mail\AssignActivityNotification;
use App\Models\Lecturer;
use App\Models\TypeOfActivity;
use App\Models\Activity;
use App\Models\Student;
use App\Models\Partner;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;

class ActivityController extends Controller
{

    public function index(ActivityDataTable $datatable)
    {
        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Master Data Kegiatan',
            'data' => null,
            'user' => $user
        ];

        return $datatable->addScope(new ActivityDataTableScope(Auth::User()))->render('public.activity.list', $data);
    }

    public function create()
    {
        $user = Auth::guard('web')->user();

        $data = [
            'title'             => 'Buat Kegiatan',
            // 'dosen'             => Lecturer::where('prodi_uuid', $user->prodi_uuid)->pluck('nama_dosen', 'uuid'),
            'dosen'             => Lecturer::pluck('nama_dosen', 'uuid'),
            'mitra'             => Partner::pluck('nama_mitra', 'uuid'),
            // 'mahasiswa'         => Student::where('prodi_uuid', $user->prodi_uuid)->pluck('nama_mahasiswa', 'uuid'),
            'mahasiswa'         => Student::pluck('nama_mahasiswa', 'uuid'),
            'jenis_kegiatan'    => TypeOfActivity::pluck('nama_jenis_kegiatan', 'uuid'),
            'data'              => null,
            'user'              => $user
        ];

        return view('public.activity.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'mulai_kegiatan'          => 'required|date',
                'lama_kegiatan'           => 'required|numeric',
                'akhir_kegiatan'          => 'required|date',
                'status_magang'         => 'required',
                'dosen_uuid'            => 'required',
                'mahasiswa_uuid'        => 'required',
                'mitra_uuid'            => 'required',
                'jenis_kegiatan_uuid'   => 'required',
            ],
            [
                'mulai_kegiatan.required'          => 'Tanggal Mulai Kegiatan Tidak Boleh Kosong',
                'lama_kegiatan.required'           => 'Lama Kegiatan Tidak Boleh Kosong',
                'akhir_kegiatan.required'          => 'Tangal Akhir Kegiatan Tidak Boleh Kosong',
                'status_magang.required'         => 'Status Kegiatan Tidak Boleh Kosong',
                'dosen_uuid.required'            => 'Lecturer Tidak Boleh Kosong',
                'mahasiswa_uuid.required'        => 'Student Tidak Boleh Kosong',
                'mitra_uuid.required'            => 'Partner Tidak Boleh Kosong',
                'jenis_kegiatan_uuid.required'   => 'Jenis Kegiatan Tidak Boleh Kosong',
            ]
        );

        foreach (request('mahasiswa_uuid') as $mahasiswa) {
            $magang = Activity::create([
                'uuid'                    => Uuid::uuid4(),
                'mulai_kegiatan'          => request('mulai_kegiatan'),
                'akhir_kegiatan'          => request('akhir_kegiatan'),
                'lama_kegiatan'           => request('lama_kegiatan'),
                'file_sk_kegiatan'        => request('file_sk_magang'),
                'link_survey'             => request('link_survey'),
                'status_kegiatan'         => request('status_magang'),
                'status_mitra'          => request('status_mitra'),
                'dosen_uuid'            => request('dosen_uuid'),
                'mahasiswa_uuid'        => $mahasiswa,
                'mitra_uuid'            => request('mitra_uuid'),
                'jenis_kegiatan_uuid'   => request('jenis_kegiatan_uuid'),
                'user_uuid'             => Auth::User()->uuid,
                'prodi_uuid'            => Auth::User()->prodi_uuid,
                'jurusan_uuid'          => Auth::User()->jurusan_uuid,
            ]);

            if ($magang) {
                $student_email  = $magang->student()->first()->email;
                // Disabled 
                // Mail::to($student_email)->queue(new AssignActivityNotification($magang, 'student'));
            }
        }

        $lecturer = Lecturer::find($request->dosen_uuid);
        $partner  = Partner::find($request->mitra_uuid);
        $students = Student::findMany($request->mahasiswa_uuid);

        $data = [
            'dosen'     => $lecturer,
            'mitra'     => $partner,
            'mahasiswa' => $students
        ];
        // Disabled 
        // Mail::to($lecturer->email)->queue(new AssignActivityNotification($data, 'lecturer'));

        return redirect()->route('magang.index')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $user = Auth::guard('web')->user();
        $data = [
            'title'             => 'Ubah Kegiatan',
            // 'dosen'             => Lecturer::where('prodi_uuid', $user->prodi_uuid)->pluck('nama_dosen', 'uuid'),
            'dosen'             => Lecturer::pluck('nama_dosen', 'uuid'),
            'mitra'             => Partner::pluck('nama_mitra', 'uuid'),
            // 'mahasiswa'         => Student::where('prodi_uuid', $user->prodi_uuid)->pluck('nama_mahasiswa', 'uuid'),
            'mahasiswa'         => Student::pluck('nama_mahasiswa', 'uuid'),
            'jenis_kegiatan'    => TypeOfActivity::pluck('nama_jenis_kegiatan', 'uuid'),
            'data'              => Activity::findOrFail($id),
            'user'              => $user
        ];

        return view('public.activity.form', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'mulai_kegiatan'          => 'required',
                'lama_kegiatan'           => 'required',
                'akhir_kegiatan'          => 'required',
                'file_sk_magang'        => 'required',
                'status_magang'         => 'required',
                'dosen_uuid'            => 'required',
                'mahasiswa_uuid'        => 'required',
                'mitra_uuid'            => 'required',
                'jenis_kegiatan_uuid'   => 'required',
            ],
            [
                'mulai_kegiatan.required'          => 'Tanggal Mulai Kegiatan Tidak Boleh Kosong',
                'lama_kegiatan.required'           => 'Lama Kegiatan Tidak Boleh Kosong',
                'akhir_kegiatan.required'          => 'Tangal Akhir Kegiatan Tidak Boleh Kosong',
                'file_sk_magang.required'        => 'File SK Kegiatan Tidak Boleh Kosong',
                'status_magang.required'         => 'Status Kegiatan Tidak Boleh Kosong',
                'dosen_uuid.required'            => 'Lecturer Tidak Boleh Kosong',
                'mahasiswa_uuid.required'        => 'Student Tidak Boleh Kosong',
                'mitra_uuid.required'            => 'Partner Tidak Boleh Kosong',
                'jenis_kegiatan_uuid.required'   => 'Jenis Kegiatan Tidak Boleh Kosong',
            ]
        );

        $magang = Activity::findOrFail($id);
        $magang->mulai_kegiatan           = $request->mulai_kegiatan;
        $magang->lama_kegiatan            = $request->lama_kegiatan;
        $magang->akhir_kegiatan           = $request->akhir_kegiatan;
        $magang->file_sk_kegiatan         = $request->file_sk_magang;
        $magang->link_survey             = $request->link_survey;
        $magang->status_kegiatan          = $request->status_magang;
        $magang->status_mitra           = $request->status_mitra;
        $magang->dosen_uuid             = $request->dosen_uuid;
        $magang->mitra_uuid             = $request->mitra_uuid;
        $magang->mahasiswa_uuid         = $request->mahasiswa_uuid[0];
        $magang->user_uuid              = $request->user_uuid;
        $magang->jenis_kegiatan_uuid    = $request->jenis_kegiatan_uuid;
        $magang->save();

        return redirect()->route('magang.show', ['id' => $id])->with('success', 'Data Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        $magang = Activity::findOrFail($id);
        $magang->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }

    public function show($id)
    {
        $user = Auth::guard('web')->user();

        $data = [
            'title'     => 'Detail Program Kegiatan',
            'data'      => Activity::findOrFail($id),
            'user'      => $user
        ];

        return view('public.activity.show', $data);
    }
}
