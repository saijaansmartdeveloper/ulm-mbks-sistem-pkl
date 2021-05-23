@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    @include('alert')

    <div class="card py-4">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th width='20%'>NIM Mahasiswa</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->nama_mitra }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Nama Mahasiswa</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->divisi_mitra }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>Email</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->alamat_mitra }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>No. Telpon</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->penanggung_jawab_mitra }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>No. Telpon</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->email_mitra }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>No. Telpon</th>
                            <td width='2%'>:</td>
                            <td>{{ $data->pamong_mitra }}</td>
                        </tr>
                        <tr>
                            <th width='20%'>No. Telpon</th>
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
