@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')

    @include('alert')
    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-hover table-striped">
                <tr>
                    <td width='20%'>Jenis Laporan</td>
                    <td>: <strong>{{ $data->jenis_laporan }}</strong></td>
                    <td>Tanggal Laporan</td>
                    <td>: <strong>{{ Carbon\Carbon::createFromDate($data->tanggal_laporan_activity)->format('d M Y') }}</strong></td>
                </tr>
                <tr>
                    <td>Judul Laporan Kegiatan</td>
                    <td colspan="3">: <strong>{{ $data->judul_laporan_activity }}</strong></td>
                </tr>
                <tr>
                    <td>Catatan Laporan Kegiatan</td>
                    <td colspan="3">:</td>
                </tr>
                <tr>
                    <td colspan="4">{!! $data->catatan_laporan_activity !!}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- <div class="card mb-4">
        <div class="card-header">
            Komentar
        </div>
        <div class="card-body">
            {!! $data->komentar_laporan_activity ?? '<i>Tidak Ada Komentar</i>' !!}
        </div>
    </div> --}}

    <div class="card mb-4">
        <div class="card-header">
            Lampiran
        </div>
        <div class="card-body">
            @if ($data->file_laporan_activity != null)
                <a href="{{ asset('storage/' . $data->file_laporan_activity ?? 'not_found') }}" target="_blank">File Lampiran</a>
            @endif
        </div>
    </div>
@endsection
