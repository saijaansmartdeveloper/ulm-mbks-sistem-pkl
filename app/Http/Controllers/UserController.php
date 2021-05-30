<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Major;
use Ramsey\Uuid\Uuid;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:super_admin')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $datatable)
    {
        $user = Auth::guard('web')->user();
        $data = [
            'title' => 'Daftar Data Pengguna',
            'user' => $user
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
        $user = Auth::guard('web')->user();

        $data = [
            'title'     => 'Tambah Data Pengguna',
            'jurusan'   => Major::pluck('nama_jurusan', 'uuid'),
            'prodi'     => StudyProgram::pluck('nama_prodi', 'uuid'),
            'data'      => null,
            'user' => $user
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
                'email'         => 'required|email',
                'password'      => 'required',
                'role_pengguna' => 'required'
            ],
            [
                'nama_pengguna.required' => 'Nama Pengguna Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
                'email.email'            => 'Teks Harus Berupa Email',
                'password.required'      => 'Password Tidak Boleh Kosong',
                'role_pengguna.required' => 'Role Pengguna Tidak Boleh Kosong',
            ]
        );

        $user = new User;
        $user->uuid              = Uuid::uuid4();
        $user->nama_pengguna     = $request->nama_pengguna;
        $user->email             = $request->email;
        $user->password          = bcrypt($request->password);
        $user->jurusan_uuid      = $request->jurusan_uuid ?? null;
        $user->prodi_uuid        = $request->prodi_uuid ?? null;
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
        $user = Auth::guard('web')->user();

        $data = [
            'title' => 'Detail Pengguna',
            'data'  => User::where('uuid',$id)->firstOrFail(),
            'user'  => $user
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
        $user = Auth::guard('web')->user();

        $data = [
            'title'     => 'Ubah Data Pengguna',
            'jurusan'   => Major::pluck('nama_jurusan', 'uuid'),
            'prodi'     => StudyProgram::pluck('nama_prodi', 'uuid'),
            'data'      => User::where('uuid', $id)->first(),
            'user'      => $user
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
            ],
            [
                'nama_pengguna.required' => 'Nama Pengguna Tidak Boleh Kosong',
                'email.required'         => 'Email Tidak Boleh Kosong',
                'password.required'      => 'Password Tidak Boleh Kosong',
                'role_pengguna.required' => 'Role Pengguna Tidak Boleh Kosong'
            ]
        );

        $user = User::where('uuid', $id)->first();

        if ($request->password == null) {
            $password = $user->password;
        } else {
            $password = bcrypt($request->password);
        }

        $user->nama_pengguna     = $request->nama_pengguna;
        $user->email             = $request->email;
        $user->password          = $password;
        $user->jurusan_uuid      = $request->jurusan_uuid;
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
