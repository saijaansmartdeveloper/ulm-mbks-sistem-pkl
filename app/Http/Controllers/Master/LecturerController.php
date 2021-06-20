<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Ramsey\Uuid\Uuid;
use App\Models\Activity;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\LecturerDataTable;
use Illuminate\Support\Facades\Storage;
use App\DataTables\Scopes\LecturerDataTableScope;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LecturerDataTable $datatable)
    {
        $user = Auth::guard('web')->user();
        $data = [
            'title' => 'Kelola Data Dosen',
            'user' => $user
        ];

        return $datatable->addScope(new LecturerDataTableScope(Auth::user()))->render('public.lecturer.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Tambah Dosen',
            'guard' => 'web',
            'data'  => null,
            'user'  => $user
        ];

        return view('public.lecturer.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nip_dosen'         => 'required',
                'nama_dosen'        => 'required',
                'email'             => 'required',
                'password'          => 'required',
                'foto_dosen'        => 'image|mimes:jpeg,png,jpg|max:512'
            ],
            [
                'nip_dosen.required'     => 'NIP Dosen Tidak Boleh Kosong',
                'nama_dosen.required'    => 'Nama Dosen Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
                'password.required'      => 'Password Tidak Boleh Kosong',
                'foto_dosen.max'         => 'File Foto Maksimal 512KB'
            ]
        );

        if (request()->file('foto_dosen')) {
            $foto_dosen = request()->file('foto_dosen');
            $fotoUrl        = $foto_dosen->storeAs('file/foto_dosen', "{$request->nip_dosen}.{$foto_dosen->extension()}", "public");
        } else {
            $fotoUrl = null;
        }

        $dosen = new Lecturer;
        $dosen->uuid            = Uuid::uuid4()->getHex();
        $dosen->nip_dosen       = $request->nip_dosen;
        $dosen->nama_dosen      = $request->nama_dosen;
        $dosen->email           = $request->email;
        $dosen->password        = bcrypt($request->password);
        $dosen->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $dosen->prodi_uuid      = Auth::User()->prodi_uuid;
        $dosen->foto_dosen      = $fotoUrl;
        $dosen->save();
        $dosen->assignRole('lecturer');

        return redirect()->route('dosen.index')->with('success', 'Data Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::guard('web')->user();

        $activity   = Activity::select('jenis_kegiatan_uuid')->orderBy('jenis_kegiatan_uuid', 'asc')->distinct()->get();

        foreach ($activity as $key => $value) {
            $activity[$key]->list_guidance = Activity::where('jenis_kegiatan_uuid', $value->jenis_kegiatan_uuid)->where('dosen_uuid', $id)->orderBy('mitra_uuid', 'asc')->paginate(5);
        }

        $data = [
            'title' => 'Detail Dosen',
            'data'  => Lecturer::findOrFail($id),
            'guard' => 'web',
            'user'  => $user,
            'guidance' => $activity ?? null
        ];

        return view('public.lecturer.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Ubah Data Dosen',
            'guard' => 'web',
            'data'  => Lecturer::findOrFail($id),
            'user'  => $user
        ];

        return view('public.lecturer.form', $data);
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
        $request->validate(
            [
                'nip_dosen'         => 'required',
                'nama_dosen'        => 'required',
                'email'             => 'required',
                'foto_dosen'        => 'image|mimes:jpeg,png,jpg|max:512'
            ],
            [
                'nip_dosen.required'     => 'NIP Dosen Tidak Boleh Kosong',
                'nama_dosen.required'    => 'Nama Dosen Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
                'foto_dosen.max'         => 'File Foto Maksimal 512KB'
            ]
        );

        $dosen = Lecturer::findOrFail($id);



        if (request()->file('foto_dosen')) {
            Storage::delete($dosen->foto_dosen);
            $foto_dosen = request()->file('foto_dosen');
            $fotoUrl    = $foto_dosen->storeAs('file/foto_dosen', "{$request->nip_dosen}.{$foto_dosen->extension()}", "public");
        } else {
            $fotoUrl = $dosen->foto_dosen;
        }

        $dosen->nip_dosen       = $request->nip_dosen;
        $dosen->nama_dosen      = $request->nama_dosen;
        $dosen->email           = $request->email;
        if ($request->password != null) {
            $dosen->password = bcrypt($request->password);
        }
        $dosen->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $dosen->prodi_uuid      = Auth::User()->prodi_uuid;
        $dosen->foto_dosen      = $fotoUrl;
        $dosen->save();

        return redirect()->route('dosen.show', ['id' => $id])->with('update', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Lecturer::findOrFail($id);
        Storage::delete($dosen->foto_dosen);
        $dosen->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
