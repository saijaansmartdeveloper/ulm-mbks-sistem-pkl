<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\Major;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $datatable)
    {
        $data = [
            'title' => 'Master Data User',
        ];

        return $datatable->render('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'     => 'Tambah Data User',
            'prodi'     => StudyProgram::pluck('nama_prodi', 'uuid'),
            'data'      => null,
        ];

        return view('user.form', $data);
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
                'password'      => 'required',
                'role_pengguna' => 'required',
                'prodi_uuid'    => 'required'
            ],
            [
                'nama_pengguna.required' => 'Nama Pengguna Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
                'password.required'      => 'Password Tidak Boleh Kosong',
                'role_pengguna.required' => 'Role Pengguna Tidak Boleh Kosong',
                'prodi_uuid.required'    => 'StudyProgram Tidak Boleh Kosong',
            ]
        );

        $uuid   =   Uuid::uuid4()->getHex();
        $prodi  =   StudyProgram::findOrFail($request->prodi_uuid);

        $user = new User;
        $user->uuid              = $uuid;
        $user->nama_pengguna     = $request->nama_pengguna;
        $user->email             = $request->email;
        $user->password          = bcrypt($request->password);
        $user->jurusan_uuid      = $prodi->jurusan_uuid;
        $user->prodi_uuid        = $request->prodi_uuid;
        $user->role_pengguna     = $request->role_pengguna;
        $user->save();
        $user->assignRole($request->role_pengguna);

        return redirect()->route('user.index')->with('success', 'Data Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'title' => 'Detail User',
            'data'  => User::where('uuid', $id)->first(),
        ];

        return view('user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title'     => 'Ubah Data User',
            'prodi'     => StudyProgram::pluck('nama_prodi', 'uuid'),
            'data'      => User::where('uuid', $id)->first(),
        ];

        return view('user.form', $data);
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
                'role_pengguna' => 'required',
                'prodi_uuid'    => 'required'
            ],
            [
                'nama_pengguna.required' => 'Nama Pengguna Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
                'password.required'      => 'Password Tidak Boleh Kosong',
                'role_pengguna.required' => 'Role Pengguna Tidak Boleh Kosong',
                'prodi_uuid.required'    => 'StudyProgram Tidak Boleh Kosong',
            ]
        );

        $prodi  =   StudyProgram::findOrFail($request->prodi_uuid);

        $user = User::where('uuid', $id)->first();
        if ($request->password == null) {
            $password = $user->password;
        } else {
            $password = bcrypt($request->password);
        }
        $user->nama_pengguna     = $request->nama_pengguna;
        $user->email             = $request->email;
        $user->password          = $password;
        $user->jurusan_uuid      = $prodi->jurusan_uuid;
        $user->prodi_uuid        = $request->prodi_uuid;
        $user->role_pengguna     = $request->role_pengguna;
        $user->save();

        return redirect()->route('user.index')->with('update', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('uuid', $id)->first();
        $user->delete();

        return redirect()->back()->with('update', 'Data Berhasil Diubah');
    }
}
