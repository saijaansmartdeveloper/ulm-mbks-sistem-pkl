<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\TypeOfActivity;
use App\Models\Activity;
use App\Models\Student;
use App\Models\Partner;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class MagangController extends Controller
{
    public function getMagang(Request $request)
    {

        $data = Activity::with('jenis_kegiatan', 'student')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action = \Form::open(['url' => route('magang.destroy', ['id' => $data->uuid]),  'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action .= \Form::close();
                $action .= '<a href=' . route('magang.show', ['id' => $data->uuid]) . ' class="btn btn-info btn-sm"><i class="fa fa-search"></i></a> ';
                $action .= '<button onclick="deleteRow(' . $data->id . ')" class = "btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        $data = [
            'title' => 'Master Data Activity'
        ];

        return view('magang.index', $data);
    }

    public function create()
    {
        $prodi_uuid = Auth::User()->prodi_uuid;
        $data = [
            'title'             => 'Tambah Data Activity',
            'dosen'             => Lecturer::where('prodi_uuid', $prodi_uuid)->pluck('nama_dosen', 'uuid'),
            'mitra'             => Partner::pluck('nama_mitra', 'uuid'),
            'mahasiswa'         => Student::where('prodi_uuid', $prodi_uuid)->pluck('nama_mahasiswa', 'uuid'),
            'jenis_kegiatan'    => TypeOfActivity::pluck('nama_jenis_kegiatan', 'uuid'),
            'data'              => null,
        ];

        return view('magang.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'mulai_magang'          => 'required|date',
                'lama_magang'           => 'required|numeric',
                'akhir_magang'          => 'required|date',
                'status_magang'         => 'required',
                'dosen_uuid'            => 'required',
                'mahasiswa_uuid'        => 'required',
                'mitra_uuid'            => 'required',
                'jenis_kegiatan_uuid'   => 'required',
            ],
            [
                'mulai_magang.required'          => 'Tanggal Mulai Activity Tidak Boleh Kosong',
                'lama_magang.required'           => 'Lama Activity Tidak Boleh Kosong',
                'akhir_magang.required'          => 'Tangal Akhir Activity Tidak Boleh Kosong',
                'status_magang.required'         => 'Status Activity Tidak Boleh Kosong',
                'dosen_uuid.required'            => 'Lecturer Tidak Boleh Kosong',
                'mahasiswa_uuid.required'        => 'Student Tidak Boleh Kosong',
                'mitra_uuid.required'            => 'Partner Tidak Boleh Kosong',
                'jenis_kegiatan_uuid.required'   => 'Jenis Activity Tidak Boleh Kosong',
            ]
        );

        foreach (request('mahasiswa_uuid') as $mahasiswa) {
            $magang = Activity::create([
                'uuid'                  => Uuid::uuid4()->getHex(),
                'mulai_kegiatan'          => request('mulai_magang'),
                'akhir_kegiatan'          => request('akhir_magang'),
                'lama_kegiatan'           => request('lama_magang'),
                'file_sk_kegiatan'        => request('file_sk_magang'),
                'status_kegiatan'         => request('status_magang'),
                'dosen_uuid'            => request('dosen_uuid'),
                'mahasiswa_uuid'        => $mahasiswa,
                'mitra_uuid'            => request('mitra_uuid'),
                'jenis_kegiatan_uuid'   => request('jenis_kegiatan_uuid'),
                'user_uuid'             => Auth::User()->uuid,
                'prodi_uuid'            => Auth::User()->prodi_uuid,
                'jurusan_uuid'          => Auth::User()->jurusan_uuid,
            ]);
        }

        return redirect()->route('magang.index')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $prodi_uuid = Auth::User()->prodi_uuid;
        $data = [
            'title'             => 'Ubah Data Activity',
            'dosen'             => Lecturer::where('prodi_uuid', $prodi_uuid)->pluck('nama_dosen', 'uuid'),
            'mitra'             => Partner::pluck('nama_mitra', 'uuid'),
            'mahasiswa'         => Student::where('prodi_uuid', $prodi_uuid)->pluck('nama_mahasiswa', 'uuid'),
            'jenis_kegiatan'    => TypeOfActivity::pluck('nama_jenis_kegiatan', 'uuid'),
            'data'              => Activity::findOrFail($id),
        ];

        return view('magang.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'mulai_magang'          => 'required',
                'lama_magang'           => 'required',
                'akhir_magang'          => 'required',
                'file_sk_magang'        => 'required',
                'status_magang'         => 'required',
                'dosen_uuid'            => 'required',
                'mahasiswa_uuid'        => 'required',
                'mitra_uuid'            => 'required',
                'jenis_kegiatan_uuid'   => 'required',
            ],
            [
                'mulai_magang.required'          => 'Tanggal Mulai Activity Tidak Boleh Kosong',
                'lama_magang.required'           => 'Lama Activity Tidak Boleh Kosong',
                'akhir_magang.required'          => 'Tangal Akhir Activity Tidak Boleh Kosong',
                'file_sk_magang.required'        => 'File SK Activity Tidak Boleh Kosong',
                'status_magang.required'         => 'Status Activity Tidak Boleh Kosong',
                'dosen_uuid.required'            => 'Lecturer Tidak Boleh Kosong',
                'mahasiswa_uuid.required'        => 'Student Tidak Boleh Kosong',
                'mitra_uuid.required'            => 'Partner Tidak Boleh Kosong',
                'jenis_kegiatan_uuid.required'   => 'Jenis Activity Tidak Boleh Kosong',
            ]
        );

        $magang = Activity::findOrFail($id);
        $magang->mulai_kegiatan           = $request->mulai_magang;
        $magang->lama_kegiatan            = $request->lama_magang;
        $magang->akhir_kegiatan           = $request->akhir_magang;
        $magang->file_sk_kegiatan         = $request->file_sk_magang;
        $magang->status_kegiatan          = $request->status_magang;
        $magang->dosen_uuid             = $request->dosen_uuid;
        $magang->mitra_uuid             = $request->mitra_uuid;
        $magang->mahasiswa_uuid         = $request->mahasiswa_uuid;
        $magang->user_uuid              = $request->user_uuid;
        $magang->jenis_kegiatan_uuid    = $request->jenis_kegiatan_uuid;
        $magang->prodi_uuid             = $request->prodi_uuid;
        $magang->jurusan_uuid           = $request->jurusan_uuid;
        $magang->save();

        return redirect()->route('magang.index')->with('success', 'Data Berhasil Ditambah');
    }

    public function destroy($id)
    {
        $magang = Activity::findOrFail($id);
        $magang->delete();

        return redirect()->back()->with('delete', 'Data Berhasi Dihapus');
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Data Activity',
            'data'  => Activity::where('uuid', $id)->first(),
        ];

        return view('magang.show', $data);
    }
}