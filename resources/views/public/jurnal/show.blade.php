@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')

    @include('alert')

    <div class="card py-4">
        <div class="card-body">
            <h4 class="h4">Detail Jurnal {{$data->tanggal_jurnal}}</h4>
            <hr>
            <table class="table table-hover table-striped">
                <tr>
                    <td>Tempat Magang</td>
                    <td>{{ $data->magang()->first()->partner()->first()->nama_mitra }}</td>
                    <td>Waktu Magang</td>
                    <td>{{ $data->magang()->first()->mulai_magang }} s.d {{ $data->magang()->first()->akhir_magang }}</td>
                </tr>
                <tr>
                    <td>Pamong Magang</td>
                    <td>{{ $data->magang()->first()->partner()->first()->pamong_mitra }}</td>
                    <td>SK Magang</td>
                    <td><a href="{{ url($data->magang()->first()->file_sk_magang) }}" target="__blank" class="btn btn-outline-info btn-sm">Download SK</a></td>
                </tr>
                <tr>
                    <td>Penanggung Jawab Tempat Magang</td>
                    <td>{{ $data->magang()->first()->partner()->first()->penanggung_jawab_mitra }}</td>
                    <td>Dosen Pembimbing</td>
                    <td>{{ $data->magang()->first()->lecturer()->first()->nama_dosen }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Status Jurnal</td>
                    <td>
                        {!! $data->status_jurnal_with_label !!}

                    </td>
                </tr>
                <tr>
                    <td>Catatan Jurnal</td>
                    <td colspan="3">{!! $data->catatan_jurnal !!}</td>
                </tr>
            </table>

        </div>
    </div>

@endsection

