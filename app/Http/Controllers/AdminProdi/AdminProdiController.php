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

        $data = User::where('role_pengguna', 'admin_prodi')->get();
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Master Data Prodi';
        return view('admin_prodi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']      = 'Master Data Admin Prodi';
        $data['jurusan']    = Jurusan::pluck('nama_jurusan', 'uuid');
        $data['prodi']      = Prodi::pluck('nama_prodi', 'uuid');


        return view('admin_prodi.create', $data);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title']          = 'Master Data Admin Prodi';
        $data['admin_prodi']    = User::where('uuid', $id)->first();
        $data['jurusan']        = Jurusan::pluck('nama_jurusan', 'uuid');
        $data['prodi']          = Prodi::pluck('nama_prodi', 'uuid');


        return view('admin_prodi.edit', $data);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin_prodi = User::where('uuid', $id)->first();
        $admin_prodi->delete();

        return redirect('/admin_prodi')->with('delete', 'Data Berhasil Dihapus');
    }
}
