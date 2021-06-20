@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    @include('alert')

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <h5 class="h5">Informasi Program Kegiatan dan Mitra</h5>
                <table class="table table-striped table-hover mb-5">
                    <tr>
                        <td>Jenis Program</td>
                        <td>: <strong>{{ ($data->typeofactivity()->first()->nama_jenis_kegiatan) }}</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Mulai Program Kegiatan</td>
                        <td>: <strong>{{ ($data->mulai_kegiatan) }} s.d {{ ($data->akhir_kegiatan) }}</strong></td>
                        <td>Lama Program Kegiatan</td>
                        <td>: <strong>{{ ($data->lama_kegiatan) }} Hari</strong></td>
                    </tr>
                    <tr>
                        <td>Tempat Program Kegiatan</td>
                        <td>: <strong>{!! ($data->partner()->first()->partner_link_profile) !!} ({{ ($data->status_mitra) }})</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Penanggung Jawab Mitra Program Kegiatan</td>
                        <td>: <strong>{{ ($data->partner()->first()->penanggung_jawab_mitra) }}</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Pendamping Mitra Program Kegiatan</td>
                        <td>: <strong>{{ ($data->partner()->first()->pamong_mitra) }}</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <h5 class="h5">Informasi Pendamping dan Mahasiswa</h5>
            <table class="table table-striped table-hover">
                <tr>
                    <td>Dosen Pembimbing</td>
                    <td>: <strong>{!! ($data->lecturer()->first()->lecturer_link_profile) !!}</strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Mahasiswa Bimbingan</td>
                    <td>: <strong>{!! ($data->student()->first()->student_link_profile) !!} ({{($data->student()->first()->nim_mahasiswa)}})</strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        Lampiran
                    </td>
                    <td colspan="3"> :
                        <a href="{{ asset('storage/' . $data->file_laporan_kegiatan) }}" class="btn btn-outline-primary btn-sm" target="_blank">Laporan Kegiatan Mahasiswa</a>
                        <a href="{{ asset('storage/' . $data->file_jurnal_kegiatan) }}" class="btn btn-outline-success btn-sm" target="_blank">File Jurnal Kegiatan</a>
                        <a href="{{ ($data->link_survey ?? url('404')) }}" target="__blank" class="btn btn-outline-warning btn-sm" target="_blank">Link Survey</a>
                        <a href="{{ ($data->file_sk_kegiatan ?? url('404')) }}" target="__blank" class="btn btn-outline-info btn-sm" target="_blank">Download SK</a>
                    </td>
                </tr>
                <tr>
                    <td>File Penilaian</td>
                    <td colspan="3">
                        @if ($data->file_penilaian_kegiatan != null)
                        <a href="{{ asset('storage/' . $data->file_penilaian_kegiatan ?? 'not_found') }}" class="btn btn-success btn-sm" target="_blank">File Penilaian Kegiatan</a>
                        @else
                        : <i>File Penilaian Belum Ada Oleh Mitra</i>
                        @endif
                    </td>
                </tr>
            </table>

        </div>
    </div>


    <div class="card mb-4">
        <div class="card-header">Laporan Kegiatan</div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <tr>
                    <th>No</th>
                    <th>Jenis Laporan</th>
                    <th>Judul Laporan</th>
                    <th>Tanggal Laporan</th>
                    <th>Aksi</th>
                </tr>
            @foreach ($data->report_activities()->paginate(5) as $key => $item)
            <tr>
                <td class="text-center">{{ $data->report_activities()->paginate(5)->firstItem() + $key }}</td>
                <td>{{ $item->jenis_laporan }}</td>
                <td>{{ $item->judul_laporan_activity }}</td>
                <td>{{ Carbon\Carbon::createFromDate($item->tanggal_laporan_activity)->format('d M Y') }}</td>
                <td><a href="{!! route('public.laporan-kegiatan.show', ['id' => $item->uuid]) !!}" class="btn btn-outline-primary btn-sm">Detail</a></td>
            </tr>
            @endforeach
            </table>
            <div class="row">
                {{$data->report_activities()->paginate(5)->links()}}
            </div>
        </div>
    </div>

@endsection
