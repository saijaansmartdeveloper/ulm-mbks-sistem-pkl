@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    @include('alert')

    @forelse ($data as $key => $item)
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="h4">Nama Kegiatan <strong>{{$item->typeofactivity()->first()->nama_jenis_kegiatan}}</strong></h4>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <tr>
                        <th>No</th>
                        <th>Lokasi Kegiatan</th>
                        <th>Pendamping Mitra</th>
                        <th>Nama Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Jurnal Terakhir</th>
                        <th>Aksi</th>
                    </tr>
                    @forelse ($item->list_guidance as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value->partner()->first()->nama_mitra ?? '' }}</td>
                        <td>{{ $value->partner()->first()->pamong_mitra ?? '' }}</td>
                        <td>{!! $value->student()->first()->student_link_profile ?? '' !!}</td>
                        <td>{!! $value->student()->first()->prodi()->first()->nama_prodi ?? '' !!}</td>
                        <td>{{ $value->journals()->latest()->catatan_jurnal ?? '' }}</td>
                        <td><a href="{{ url('guidance/lecturer/' . $value->uuid) }}">Lihat Detail</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6"><i>Tidak Ada Daftar Bimbingan</i></td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
    @empty
    <div class="card mb-4">
        <div class="card-body">
            <i>Tidak Ada Mahasiswa Bimbingan</i>
        </div>
    </div>
    @endforelse

@endsection
