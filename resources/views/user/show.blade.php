@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-sm-12 mb-5 text-center mb-1">
                    <img src="{{ asset('img/person.png') }}" class="img-thumbnail" alt="">
                </div>
                <div class="col-md-9 col-sm-12">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th width='20%'>Nama Pengguna</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->nama_pengguna }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Role Pengguna</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->role_pengguna }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Program Studi</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->studyprogram()->first()->nama_prodi ?? '' }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Jurusan</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->major()->first()->nama_jurusan ?? '' }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Email</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>


        </div>
    </div>

@endsection
