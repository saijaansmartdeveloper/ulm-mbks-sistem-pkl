@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            <h4>{{ $data->nama_mitra }}</h4>
            <hr>
            <table class="table table-striped table-hover">
                <tr>
                    <th width='15%'>Divisi Mitra</th>
                    <td width='2%'>:</td>
                    <td>{{ $data->divisi_mitra }}</td>
                </tr>
                <tr>
                    <th width='15%'>Alamat Mitra</th>
                    <td width='2%'>:</td>
                    <td>{{ $data->alamat_mitra }}</td>
                </tr>
                <tr>
                    <th width='15%'>Penanggung Jawab Mitra</th>
                    <td width='2%'>:</td>
                    <td>{{ $data->penanggung_jawab_mitra }}</td>
                </tr>
                <tr>
                    <th width='15%'>Pamong Mitra</th>
                    <td width='2%'>:</td>
                    <td>{{ $data->pamong_mitra }}</td>
                </tr>
                <tr>
                    <th width='15%'>Email</th>
                    <td width='2%'>:</td>
                    <td>{{ $data->email }}</td>
                </tr>
                <tr>
                    <th width='15%'>No. Telpon</th>
                    <td width='2%'>:</td>
                    <td>{{ $data->phone }}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection
