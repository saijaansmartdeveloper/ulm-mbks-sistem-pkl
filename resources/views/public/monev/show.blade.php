@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')

    @include('alert')
    <div class="card py-4">
        <div class="card-body">
            <table class="table table-hover table-striped">
                <tr>
                    <th>NIM Mahasiswa</th>
                    <td>{{ $data->magang()->first()->student()->first()->nim_mahasiswa }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <td>{{ $data->magang()->first()->student()->first()->nama_mahasiswa }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Tempat Magang</th>
                    <td>{{ $data->magang()->first()->partner()->first()->nama_mitra }}</td>
                    <th>Waktu Magang</th>
                    <td>{{ $data->magang()->first()->mulai_magang }} s.d {{ $data->magang()->first()->akhir_magang }}
                    </td>
                </tr>
                <tr>
                    <th>Pamong Magang</th>
                    <td>{{ $data->magang()->first()->partner()->first()->pamong_mitra }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Penanggung Jawab Tempat Magang</th>
                    <td>{{ $data->magang()->first()->partner()->first()->penanggung_jawab_mitra }}</td>
                    <th>Dosen Pembimbing</th>
                    <td>{{ $data->magang()->first()->lecturer()->first()->nama_dosen }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Catatan Monitor Evaluasi</th>
                    <td colspan="3">{!! $data->catatan_monev !!}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
