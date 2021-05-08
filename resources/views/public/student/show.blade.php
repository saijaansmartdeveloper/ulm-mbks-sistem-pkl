@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    @include('alert')

    <div class="card py-4">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    @if ($data->foto_mahasiswa == null)
                        <img src="{{ asset('img/person.png') }}" width='250px' height="250px" alt="">
                    @else
                        <img src="{{ asset('storage/' . $data->foto_mahasiswa) }}" alt="" style="max-height: 250px">
                    @endif
                </div>
                <div class="col-9">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th width='20%'>NIM Mahasiswa</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->nim_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Nama Mahasiswa</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->nama_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Program Studi</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->prodi()->first()->nama_prodi ?? '' }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Jurusan</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->jurusan()->first()->nama_jurusan ?? '' }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Email</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->email }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>No. Telpon</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>


        </div>
    </div>
@endsection
