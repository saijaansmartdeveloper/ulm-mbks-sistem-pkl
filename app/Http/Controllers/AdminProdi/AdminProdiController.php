<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DataTables;
use Ramsey\Uuid\Uuid;

class AdminProdiController extends Controller
{

    public function getAdminProdi(Request $request)
    {

        $data = User::where('role_pengguna', 'admin_prodi')->with('prodi')->with('jurusan')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action   = '<a href="/admin_prodi/' . $data->uuid . '/edit" class="btn btn-sm btn-primary" >Ubah</a>';
                $action  .= \Form::open(['url' => '/admin_prodi/' . $data->uuid, 'method' => 'delete', 'style' => 'float:right']);
                $action  .= "<button type='submit' class = 'btn btn-danger btn-sm' >Hapus</button>";
                $action  .= \Form::close();

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        $data = [
            'title' => 'Master Data Admin Prodi',
        ];
        return view('admin_prodi.index', $data);
    }


    public function create()
    {
        $data = [
            'title'     => 'Master Data Admin Prodi',
            'jurusan'   => Jurusan::pluck('nama_jurusan', 'uuid'),
            'prodi'     => Prodi::pluck('nama_prodi', 'uuid'),
            'data'      => null,
        ];

        return view('admin_prodi.form', $data);
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_pengguna' => 'required',
                'email'         => 'required',
                'password'      => 'required',
                'prodi_uuid'    => 'required'
            ],
            [
                'nama_pengguna.required' => 'Nama Pengguna Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
                'password.required'      => 'Password Tidak Boleh Kosong',
                'prodi_uuid.required'    => 'Prodi Tidak Boleh Kosong',
            ]
        );

        $uuid   =  Uuid::uuid4()->getHex();
        $prodi  = Prodi::findOrFail($request->prodi_uuid);

        $admin_prodi = new User;
        $admin_prodi->uuid              = $uuid;
        $admin_prodi->nama_pengguna     = $request->nama_pengguna;
        $admin_prodi->email             = $request->email;
        $admin_prodi->password          = bcrypt($request->password);
        $admin_prodi->jurusan_uuid      = $prodi->jurusan_uuid;
        $admin_prodi->prodi_uuid        = $request->prodi_uuid;
        $admin_prodi->role_pengguna     = 'admin_prodi';
        $admin_prodi->save();
        $admin_prodi->assignRole('admin_prodi');

        return redirect()->route('admin_prodi.index')->with('success', 'Data Berhasil Dibuat');
    }


    public function show($id)
    {
    }


    public function edit($id)
    {
        $data = [
            'title'     => 'Master Data Admin Prodi',
            'jurusan'   => Jurusan::pluck('nama_jurusan', 'uuid'),
            'prodi'     => Prodi::pluck('nama_prodi', 'uuid'),
            'data'      => User::where('uuid', $id)->first(),
        ];

        return view('admin_prodi.form', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_pengguna' => 'required',
                'email'         => 'required',
            ],
            [
                'nama_pengguna.required' => 'Nama Pengguna Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
            ]
        );

        $prodi  = Prodi::findOrFail($request->prodi_uuid);


        $admin_prodi = User::where('uuid', $id)->first();

        if ($request->password == null) {
            $password = $admin_prodi->password;
        } else {
            $password = bcrypt($request->password);
        }
        $admin_prodi->nama_pengguna     = $request->nama_pengguna;
        $admin_prodi->email             = $request->email;
        $admin_prodi->password          = $password;
        $admin_prodi->jurusan_uuid      = $prodi->jurusan_uuid;
        $admin_prodi->prodi_uuid        = $request->prodi_uuid;
        $admin_prodi->role_pengguna     = 'admin_prodi';
        $admin_prodi->save();

        return redirect()->route('admin_prodi.index')->with('update', 'Data Berhasil Diubah');
    }


    public function destroy($id)
    {
        $admin_prodi = User::where('uuid', $id)->first();
        $admin_prodi->delete();

        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
