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
        $data['title'] = 'Master Data Prodi';
        return view('admin_prodi.index', $data);
    }


    public function create()
    {
        $data['title']      = 'Master Data Admin Prodi';
        $data['jurusan']    = Jurusan::pluck('nama_jurusan', 'uuid');
        $data['prodi']      = Prodi::pluck('nama_prodi', 'uuid');


        return view('admin_prodi.create', $data);
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_pengguna' => 'required',
                'email'         => 'required',
                'password'      => 'required'
            ]
        );

        $uuid   =  Uuid::uuid4()->getHex();

        $admin_prodi = new User;
        $admin_prodi->uuid              = $uuid;
        $admin_prodi->nama_pengguna     = $request->nama_pengguna;
        $admin_prodi->email             = $request->email;
        $admin_prodi->password          = bcrypt($request->password);
        $admin_prodi->jurusan_uuid      = $request->jurusan_uuid;
        $admin_prodi->prodi_uuid        = $request->prodi_uuid;
        $admin_prodi->role_pengguna     = 'admin_prodi';
        $admin_prodi->save();
        $admin_prodi->assignRole('admin_prodi');

        return redirect('/admin_prodi')->with('success', 'Data Berhasil Dibuat');
    }


    public function show($id)
    {
    }


    public function edit($id)
    {
        $data['title']          = 'Master Data Admin Prodi';
        $data['admin_prodi']    = User::where('uuid', $id)->first();
        $data['jurusan']        = Jurusan::pluck('nama_jurusan', 'uuid');
        $data['prodi']          = Prodi::pluck('nama_prodi', 'uuid');


        return view('admin_prodi.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_pengguna' => 'required',
                'email'         => 'required',
                'password'      => 'required'
            ]
        );



        $admin_prodi = User::where('uuid', $id)->first();
        $admin_prodi->nama_pengguna     = $request->nama_pengguna;
        $admin_prodi->email             = $request->email;
        $admin_prodi->password          = bcrypt($request->password);
        $admin_prodi->jurusan_uuid      = $request->jurusan_uuid;
        $admin_prodi->prodi_uuid        = $request->prodi_uuid;
        $admin_prodi->role_pengguna     = 'admin_prodi';
        $admin_prodi->save();

        return redirect('/admin_prodi')->with('update', 'Data Berhasil Diubah');
    }


    public function destroy($id)
    {
        $admin_prodi = User::where('uuid', $id)->first();
        $admin_prodi->delete();

        return redirect('/admin_prodi')->with('delete', 'Data Berhasil Dihapus');
    }
}
