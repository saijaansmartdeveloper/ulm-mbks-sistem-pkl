<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Ramsey\Uuid\Uuid;

class SupervisorController extends Controller
{

    public function getSupervisor(Request $request)
    {

        $data = User::where('role_pengguna', 'supervisor')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action = '<a href="/supervisor/' . $data->uuid . '/edit" class="btn btn-sm btn-primary" >Ubah</a>';
                $action .= \Form::open(['url' => '/supervisor/' . $data->uuid, 'method' => 'delete', 'style' => 'float:right']);
                $action .= "<button type='submit' class = 'btn btn-danger btn-sm' >Hapus</button>";
                $action .= \Form::close();
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
        $data = [
            'title' => 'Master Data Supervisor',
        ];
        return view('supervisor.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Supervisor',
            'data'  => null,
        ];
        return view('supervisor.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required',
            'email'         => 'required|email',
            'password'      => 'required'
        ], [
            'nama_pengguna.required'    => 'Nama Pengguna Tidak Boleh Kosong',
            'email.required'            => 'Email Tidak Boleh Kosong',
            'email.email'               => 'Masukkan Email Dengan Benar',
            'password.required'         => 'Password Tidak Boleh Kosong',
            'password.min'              => 'Password Minimal 5 Karakter'
        ]);

        $uuid = Uuid::uuid4()->getHex();

        $supervisor = new User;
        $supervisor->uuid           = $uuid;
        $supervisor->nama_pengguna  = $request->nama_pengguna;
        $supervisor->email          = $request->email;
        $supervisor->password       = bcrypt($request->password);
        $supervisor->role_pengguna  = 'supervisor';
        $supervisor->save();
        $supervisor->assignRole('supervisor');

        return redirect()->route('supervisor.index')->with('success', 'Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            'title' => 'Ubah Data Supervisor',
            'data'  => User::where('uuid', $id)->first(),
        ];
        return view('supervisor.form', $data);
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
        $request->validate([
            'nama_pengguna' => 'required',
            'email'         => 'required|email',
        ], [
            'nama_pengguna.required'    => 'Nama Pengguna Tidak Boleh Kosong',
            'email.required'            => 'Email Tidak Boleh Kosong',
            'email.email'               => 'Masukkan Email Dengan Benar',
            'password.required'         => 'Password Tidak Boleh Kosong',
            'password.min'              => 'Password Minimal 5 Karakter'
        ]);


        $supervisor = User::where('uuid', $id)->first();

        if ($request->password == null) {
            $password = $supervisor->password;
        } else {
            $password = $request->password;
        }

        $supervisor->nama_pengguna  = $request->nama_pengguna;
        $supervisor->email          = $request->email;
        $supervisor->password       = bcrypt($password);
        $supervisor->role_pengguna  = 'supervisor';
        $supervisor->save();

        return redirect()->route('supervisor.index')->with('update', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supervisor = User::where('uuid', $id)->first();
        $supervisor->delete();

        return redirect()->route('supervisor.index')->with('delete', 'Data Berhasil Dihapus');

        //
    }
}
