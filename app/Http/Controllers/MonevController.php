<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Monev;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MonevController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:lecturer');
    }

    public function index ()
    {
        $user = Auth::guard('lecturer')->user();

        $data = [
            'title' => 'Daftar Laporan Kegiatan Monitoring',
            'guard' => $user->guard_name,
            'data' => null,
            'user' => $user
        ];

        return view('public.monev.index', $data);
    }


    public function create ()
    {
        $user = Auth::guard('lecturer')->user();

        $data = [
            'title' => 'Buat Laporan Kegiatan Monitoring',
            'guard' => $user->guard_name,
            'data' => null,
            'user' => $user
        ];

        return view('public.monev.form', $data);
    }
    // public function getMonev()
    // {

    //     $data = Monev::with('activity', 'activity.partner', 'activity.student', 'activity.typeofactivity')->get();
    //     return Datatables::of($data)
    //         ->addIndexColumn()
    //         ->addColumn('action', function ($data) {
    //             $action   = \Form::open(['url' => route('public.monev.destroy', ['id' => $data->uuid]), 'method' => 'delete']);
    //             $action  .= \Form::close();
    //             $action  .= '<a href="' . route('public.monev.edit', ['id' => $data->uuid]) . '" class="btn btn-sm btn-primary" ><i class="fa fa-edit"></i> </a>';
    //             $action  .= '<a href="' . route('public.monev.show', ['id' => $data->uuid]) . '" class="btn btn-sm btn-info" ><i class="fa fa-search"></i> </a>';
    //             $action  .= '<button onclick="deleteRow('.$data->id.')" class = "btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';;

    //             return $action;
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     $data = [
    //         'guard' => 'lecturer',
    //         'title' => 'Laporan Kegiatan',
    //     ];

    //     return view('public.monev.index', $data);
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {

    //     $dosen_uuid = Auth::guard('lecturer')->user()->uuid;
    //     $magang = Activity::where('dosen_uuid', $dosen_uuid)->get();

    //     foreach ($magang as $value) {
    //         $magangParsing[$value->uuid] = $value->partner()->first()->nama_mitra . " - " . $value->student()->first()->nama_mahasiswa;
    //     }

    //     $data = [
    //         'title'     => 'Tambah Data Laporan Kegiatan',
    //         'magang'    => $magangParsing ?? [],
    //         'data'      => null,
    //     ];

    //     return view('public.monev.form', $data);
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate(
    //         [
    //             'catatan_monev' => 'required',
    //             'tanggal_monev' => 'required',
    //             'magang_uuid'   => 'required',
    //             'jenis_laporan' => 'required',
    //             'file_monev'    => 'max:1024',
    //         ],
    //         [
    //             'catatan_monev.required'    => 'Catatan Tidak Boleh Kosong',
    //             'tanggal_monev.required'    => 'Tanggal Tidak Boleh Kosong',
    //             'magang_uuid.required'      => 'Kegiatan Tidak Boleh Kosong',
    //             'jenis_laporan.required'    => 'Jenis Laporan Tidak Boleh Kosong',
    //             'file_monev.max'            => 'File Monitor Evaluasi Maksimal 1MB',
    //         ]
    //     );

    //     $uuid = Uuid::uuid4();

    //     if (request()->file('file_monev')) {
    //         $file_monev = request()->file('file_monev');
    //         $fileUrl    = $file_monev->storeAs('file/file_monev', "{$uuid}.{$file_monev->extension()}", "public");
    //     } else {
    //         $fileUrl = null;
    //     }

    //     $monev = new Monev;
    //     $monev->uuid            = $uuid;
    //     $monev->catatan_monev   = $request->catatan_monev;
    //     $monev->tanggal_monev   = $request->tanggal_monev;
    //     $monev->jenis_laporan   = $request->jenis_laporan;
    //     $monev->file_monev      = $fileUrl;
    //     $monev->komentar_monev  = null;
    //     $monev->kegiatan_uuid   = $request->magang_uuid;
    //     $monev->dosen_uuid      = Auth::guard('lecturer')->User()->uuid;
    //     $monev->prodi_uuid      = Auth::guard('lecturer')->User()->prodi_uuid;
    //     $monev->jurusan_uuid    = Auth::guard('lecturer')->User()->jurusan_uuid;
    //     $monev->save();

    //     return redirect(route('public.monev.index'))->with('success', 'Data Berhasil Dibuat');
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $data = [
    //         'title' => 'Detail Laporan Kegiatan',
    //         'data'  => Monev::findOrFail($id),
    //     ];

    //     return view('public.monev.show', $data);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $dosen_uuid = Auth::guard('lecturer')->user()->uuid;
    //     $magang = Activity::where('dosen_uuid', $dosen_uuid)->get();

    //     foreach ($magang as $value) {
    //         $magangParsing[$value->uuid] = $value->partner()->first()->nama_mitra . " - " . $value->student()->first()->nama_mahasiswa;
    //     }
    //     $data = [
    //         'title' => 'Ubah Data Laporan Kegiatan',
    //         'magang'    => $magangParsing ?? [],
    //         'data'  => Monev::findOrFail($id),
    //     ];

    //     return view('public.monev.form', $data);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     $request->validate(
    //         [
    //             'catatan_monev' => 'required',
    //             'tanggal_monev' => 'required',
    //             'magang_uuid'   => 'required',
    //             'jenis_laporan' => 'required',
    //             'file_monev'    => 'max:1024',
    //         ],
    //         [
    //             'catatan_monev.required'    => 'Catatan Tidak Boleh Kosong',
    //             'tanggal_monev.required'    => 'Tanggal Tidak Boleh Kosong',
    //             'magang_uuid.required'      => 'Kegiatan Tidak Boleh Kosong',
    //             'jenis_laporan.required'    => 'jenis_laporan Tidak Boleh Kosong',
    //             'file_monev.max'            => 'File Monitor Evaluasi Maksimal 1MB',
    //         ]
    //     );

    //     $monev =  Monev::findOrFail($id);

    //     if (request()->file('file_monev')) {
    //         Storage::delete($monev->file_monev);
    //         $file_monev = request()->file('file_monev');
    //         $fileUrl    = $file_monev->storeAs('file/file_monev', "{$id}.{$file_monev->extension()}", "public");
    //     } else {
    //         $fileUrl = $monev->file_monev;
    //     }

    //     $monev->catatan_monev   = $request->catatan_monev;
    //     $monev->tanggal_monev   = $request->tanggal_monev;
    //     $monev->jenis_laporan   = $request->jenis_laporan;
    //     $monev->file_monev      = $fileUrl;
    //     $monev->kegiatan_uuid   = $request->magang_uuid;
    //     $monev->dosen_uuid      = Auth::guard('lecturer')->User()->uuid;
    //     $monev->prodi_uuid      = Auth::guard('lecturer')->User()->prodi_uuid;
    //     $monev->jurusan_uuid    = Auth::guard('lecturer')->User()->jurusan_uuid;
    //     $monev->save();

    //     return redirect(route('public.monev.index'))->with('update', 'Data Berhasil Diubah');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $monev = Monev::findOrFail($id);
    //     Storage::delete($monev->file_monev);
    //     $monev->delete();

    //     return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    // }
}
