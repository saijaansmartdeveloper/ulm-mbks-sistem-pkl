<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Activity;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LecturerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:lecturer')->except('show');
    }

    public function index()
    {
        $user   = Auth::guard('lecturer')->user();
        $announcement = new Announcement();

        $data = [
            'title' => 'Selamat Datang, ' . $user->nama_dosen,
            'guard' => $user->guardname,
            'data'  => [
                'jumlah_bimbingan'  => $user->activities()->first() == null ? 0 : ($user->activities()->first()->student()->count() ?? 0),
                'jumlah_jurnal'     => $user->activities()->first() == null ? 0 : ($user->activities()->first()->journals()->count() ?? 0),
                'jumlah_monev'      => $user->report_activity()->count() ?? 0
            ],
            'user'  => $user,
            'announcement' => $announcement->show_announcement($user->jurusan_uuid, $user->prodi_uuid)

        ];

        return view("public.lecturer.index", $data);
    }

    public function show($id)
    {
        // if (! (Auth::guard('student')->check() || Auth::guard('lecturer')->check() || Auth::guard('partner')->check()))
        // {
        //     abort(403);
        // }

        $user   = Auth::guard('lecturer')->user() ?? Lecturer::findOrFail($id);

        $activity   = Activity::select('jenis_kegiatan_uuid')->orderBy('jenis_kegiatan_uuid', 'asc')->distinct()->get();

        foreach ($activity as $key => $value) {
            $activity[$key]->list_guidance = Activity::where('jenis_kegiatan_uuid', $value->jenis_kegiatan_uuid)->where('dosen_uuid', $user->id)->orderBy('mitra_uuid', 'asc')->paginate(5);
        }

        $data = [
            'title'     => 'Profile ' . $user->nama_dosen,
            'guard'     => $user == null ? 'student' : $user->guard_name,
            'data'      => Lecturer::findOrFail($id),
            'user'      => $user,
            'guidance' => $activity ?? null
        ];

        return view('public.lecturer.show', $data);
    }

    public function edit($id){

        $user   = Auth::guard('lecturer')->user();

        $data = [
            'title'     => 'Ubah Data Lecturer',
            'guard'     => $user->guardname,
            'data'      => Lecturer::findOrFail($id),
            'user'      => $user
        ];

        return view('public.lecturer.form', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nip_dosen'         => 'required',
                'nama_dosen'        => 'required',
                'email'             => 'required|email',
                'foto_dosen'        => 'image|mimes:jpeg,png,jpg|max:1024'
            ],
            [
                'nip_dosen.required'     => 'NIP Lecturer Tidak Boleh Kosong',
                'nama_dosen.required'    => 'Nama Lecturer Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
                'foto_dosen.max'         => 'File Foto Maksimal 512KB'
            ]
        );

        $dosen = Lecturer::findOrFail($id);

        if (request()->file('foto_dosen')) {
            Storage::delete($dosen->foto_dosen);
            $foto_dosen           = request()->file('foto_dosen');
            $dosen->foto_dosen    = $foto_dosen->storeAs('file/foto_dosen', "{$request->nip_dosen}.{$foto_dosen->extension()}", "public");
        }
        $dosen->nip_dosen       = $request->nip_dosen;
        $dosen->nama_dosen      = $request->nama_dosen;
        $dosen->email           = $request->email;
        if ($request->password != null) {
            $dosen->password = bcrypt($request->password);
        }
        $dosen->save();

        return redirect()->route('public.lecturer.edit', ['id' => $id])->with('update', 'Data Berhasil Diubah');

    }

    // public function guidance ()
    // {

    // }

//     public function guidance(StudentDataTable $dataTable)
//     {
// //        $user   = Auth::guard('lecturer')->user();
// //
// //        $data = [
// //            'title' => 'Welcome, ' . $user->nama_dosen,
// //            'guard' => 'lecturer',
// //            'data'  => null
// //        ];
// //
// //        return $dataTable->render('public.student.list', $data);

//         $data = [
//             'title' => 'Daftar Student',
//         ];

//         return view('public.lecturer.journal.index', $data);
//     }

//     public function getListMahasiswaBimbingan()
//     {
//         $user = Auth::guard('lecturer')->user();
//         $data = Activity::where('dosen_uuid', $user->uuid)->with('student', 'partner')->get();
//         return Datatables::of($data)
//             ->addIndexColumn()
//             ->addColumn('action', function ($data) {
//                 $action = '<a href="mahasiswa_bimbingan/' . $data->mahasiswa_uuid . '" class="btn btn-sm btn-info" >Show</a>';
//                 return $action;
//             })
//             ->rawColumns(['action'])
//             ->make(true);
//     }

//     public function index_journal()
//     {
//         $data = [
//             'title' => 'List Student Bimbingan',
//         ];

//         return view('public.lecturer.journal.index', $data);
//     }

//     public function show_student_detail($id)
//     {
//         $data = [
//             'title' => 'Journal Student',
//             'data'  => Activity::where('mahasiswa_uuid', $id)->first(),
//         ];

//         return view('public.lecturer.journal.show', $data);
//     }

//     public function show_student_journal($id)
//     {
//         $data = [
//             'title' => 'Detail Journal',
//             'data'  => Journal::where('uuid', $id)->first(),
//         ];


//         return view('public.lecturer.journal.form', $data);
//     }

//     public function update_journal(Request $request, $id)
//     {
//         $user = Auth::guard('lecturer')->user();

//         $jurnal = Journal::find($id);

//         if ($request->komentar_jurnal != null) {
//             $jurnal->komentar_jurnal    = $request->komentar_jurnal;
//         }
//         $jurnal->status_jurnal      = $request->status_jurnal;
//         $jurnal->save();

//         Mail::to($jurnal->activity()->first()->student()->email)->send(new UpdatedJournalNotification($user->nama_dosen . ' baru saja mengubah status jurnal kegiatan!', $jurnal, 'student'));

//         return redirect()->back()->with('info', 'Journal Berhasil Diterima');

// //        return redirect()->route('public.lecturer.student_guidance.show', ['id' => $jurnal->magang()->first()->mahasiswa_uuid])->with('update', 'Komentar Berhasil Ditambahkan');
//     }

//     public function update_status_all(Request $request)
//     {
//         $jurnal = Journal::whereIn('uuid', $request->ids)->update(['status_jurnal' => 'accepted']);
//         return redirect()->back()->with('info', 'Journal Berhasil Diterima');
//     }

}
