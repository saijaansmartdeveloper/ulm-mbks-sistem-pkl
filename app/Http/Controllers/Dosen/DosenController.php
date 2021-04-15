<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class DosenController extends Controller
{
    public function getDosen(Request $request)
    {

        $data = Dosen::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action   = '<a href="/dosen/' . $data->uuid . '/edit" class="btn btn-sm btn-primary" >Ubah</a>';
                $action  .= \Form::open(['url' => '/dosen/' . $data->uuid, 'method' => 'delete', 'style' => 'float:right']);
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
        return view('dosen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.create');
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
                'nip_dosen'     => 'required',
                'nama_dosen'    => 'required',
                'email'         => 'required',
                'password'      => 'required',

            ]
        );

        $uuid   =  Uuid::uuid4()->getHex();

        $dosen = new Dosen;
        $dosen->uuid            = $uuid;
        $dosen->nip_dosen       = $request->nip_dosen;
        $dosen->nama_dosen      = $request->nama_dosen;
        $dosen->email           = $request->email;
        $dosen->password        = bcrypt($request->password);
        $dosen->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $dosen->prodi_uuid      = Auth::User()->prodi_uuid;
        $dosen->save();

        return redirect('/dosen')->with('success', 'Data Berhasil Dibuat'); 
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
        $data['dosen'] = Dosen::findOrFail($id);

        return view('dosen.edit',$data);
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
                'nip_dosen'     => 'required',
                'nama_dosen'    => 'required',
                'email'         => 'required',
                'password'      => 'required',

            ]
        );

        $dosen = Dosen::findOrFail($id);
        $dosen->nip_dosen       = $request->nip_dosen;
        $dosen->nama_dosen      = $request->nama_dosen;
        $dosen->email           = $request->email;
        $dosen->password        = bcrypt($request->password);
        $dosen->jurusan_uuid    = Auth::User()->jurusan_uuid;
        $dosen->prodi_uuid      = Auth::User()->prodi_uuid;
        $dosen->save();

        return redirect('/dosen')->with('update', 'Data Berhasil Diubah'); 
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect('/dosen')->with('delete', 'Data Berhasil Dihapus'); 

    }
}
