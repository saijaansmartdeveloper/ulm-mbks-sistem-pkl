<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\JenisKegiatan;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\Mitra;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class MagangController extends Controller
{
    public function getMagang(Request $request)
    {

        $data = Magang::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action = '<a href="/prodi/' . $data->uuid . '/edit" class="btn btn-sm btn-primary" >Ubah</a>';
                $action .= \Form::open(['url' => '/prodi/' . $data->uuid, 'method' => 'delete', 'style' => 'float:right']);
                $action .= "<button type='submit' class = 'btn btn-danger btn-sm' >Hapus</button>";
                $action .= \Form::close();

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        $data['title'] = 'Master Data Magang';
        return view('magang.index', $data);
    }

    public function create()
    {
        $data['title']              = "Tambah Data Magang";
        $data['dosen']              = Dosen::pluck('nama_dosen', 'uuid');
        $data['mitra']              = Mitra::pluck('nama_mitra', 'uuid');
        $data['mahasiswa']          = Mahasiswa::pluck('nama_mahasiswa', 'uuid');
        $data['jenis_kegiatan']     = JenisKegiatan::pluck('nama_jenis_kegiatan', 'uuid');

        return view('magang.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mulai_magang'          => 'required',
            'lama_magang'           => 'required',
            'akhir_magang'          => 'required',
            'file_laporan_magang'   => 'required',
            'file_jurnal_magang'    => 'required',
            'file_sk_magang'        => 'required',
            'status_magang'         => 'required',
        ]);
        
         
        // MAHASISWA
        // UPLOAD FILE LAPORAN MAGANG
        // $file_laporan_magang = request()->file('file_laporan_magang');
        // $slug_file_laporan_magang = \Str::slug($file_laporan_magang->getClientOriginalName());
        // $file_laporan_magangUrl = $file_laporan_magang->storeAs('file/laporan_magang', "{$slug_file_laporan_magang}.{$file_laporan_magang->extension()}", "public");

        // // UPLOAD FILE JURNAL MAGANG
        // $file_jurnal_magang = request()->file('file_jurnal_magang');
        // $slug_file_jurnal_magang = \Str::slug($file_jurnal_magang->getClientOriginalName());
        // $file_jurnal_magangUrl = $file_jurnal_magang->storeAs('file/jurnal_magang', "{$slug_file_jurnal_magang}.{$file_jurnal_magang->extension()}", "public");

        // LINK GD
        // UPLOAD FILE SK MAGANG
        // $file_sk_magang = request()->file('file_sk_magang');
        // $slug_file_sk_magang = \Str::slug($file_sk_magang->getClientOriginalName());
        // $file_sk_magangUrl = $file_sk_magang->storeAs('file/sk_magang', "{$slug_file_sk_magang}.{$file_sk_magang->extension()}", "public");

        $uuid = Uuid::uuid4()->getHex();

        $magang = new Magang;
        $magang->uuid                   = $uuid;
        $magang->mulai_magang           = $request->mulai_magang;
        $magang->lama_magang            = $request->lama_magang;
        $magang->akhir_magang           = $request->akhir_magang;
        $magang->file_laporan_magang    = null;
        $magang->file_jurnal_magang     = null;
        $magang->file_sk_magang         = $request->file_sk_magang;
        $magang->status_magang          = $request->status_magang;
        $magang->dosen_uuid             = $request->dosen_uuid;
        $magang->mitra_uuid             = $request->mitra_uuid;
        $magang->mahasiswa_uuid         = $request->mahasiswa_uuid;
        $magang->jenis_kegiatan_uuid    = $request->jenis_kegiatan_uuid;
        $magang->user_uuid              = Auth::User()->uuid;
        $magang->prodi_uuid             = Auth::User()->prodi_uuid;
        $magang->jurusan_uuid           = Auth::User()->jurusan_uuid;
        $magang->save();

        return redirect(route('magang.index'))->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $data['magang']     = Magang::findOrFail($id);
        $data['title']      = 'Ubah Data Magang';
        $data['dosen']      = Dosen::pluck('nama_dosen', 'uuid');
        $data['mitra']      = Mitra::pluck('nama_mitra', 'uuid');
        $data['mahasiswa']  = Mahasiswa::pluck('nama_mahasiswa', 'uuid');

        return view('magang.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mulai_magang'          => 'required',
            'lama_magang'           => 'required',
            'akhir_magang'          => 'required',
            'file_laporan_magang'   => 'required',
            'file_jurnal_magang'    => 'required',
            'file_sk_magang'        => 'required',
            'status_magang'         => 'required',
        ]);




        $magang = Magang::findOrFail($id);
        $magang->mulai_magang           = $request->mulai_magang;
        $magang->lama_magang            = $request->lama_magang;
        $magang->akhir_magang           = $request->akhir_magang;
        $magang->file_laporan_magang    = $request->file_laporan_magang;
        $magang->file_jurnal_magang     = $request->file_jurnal_magang;
        $magang->file_sk_magang         = $request->file_sk_magang;
        $magang->status_magang          = $request->status_magang;
        $magang->dosen_uuid             = $request->dosen_uuid;
        $magang->mitra_uuid             = $request->mitra_uuid;
        $magang->mahasiswa_uuid         = $request->mahasiswa_uuid;
        $magang->user_uuid              = $request->user_uuid;
        $magang->jenis_kegiatan_uuid    = $request->jenis_kegiatan_uuid;
        $magang->prodi_uuid             = $request->prodi_uuid;
        $magang->jurusan_uuid           = $request->jurusan_uuid;
        $magang->save();

        return redirect(route('magang.index'))->with('success', 'Data Berhasil Ditambah');
    }

    public function destroy($id)
    {
        $magang = Magang::findOrFail($id);
        $magang->delete();

        return redirect(route('magang.index'))->with('delete', 'Data Berhasi Dihapus');
    }
}
