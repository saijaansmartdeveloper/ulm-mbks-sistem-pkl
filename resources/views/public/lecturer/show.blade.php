@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
@include('alert')

<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 mb-1">
                <img src="{{ $data->foto_dosen != null ? asset('storage/' . $data->foto_dosen) : asset('img/person.png') }}"
                    class="img-thumbnail" alt="">
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <table class="table table-striped table-hover">
                    <tr>
                        <th width='20%'>NIP Dosen</th>
                        <td width='2%'>:</td>
                        <td>{{ $data->nip_dosen }}</td>
                    </tr>
                    <tr>
                        <th width='20%'>Nama Dosen</th>
                        <td width='2%'>:</td>
                        <td>{{ $data->nama_dosen }}</td>
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
                </table>
            </div>
        </div>
    </div>
</div>

@forelse ($guidance as $key => $item)
<div class="card mb-4">
    <div class="card-body">
        <h4 class="h4">Nama Kegiatan <strong>{{$item->typeofactivity()->first()->nama_jenis_kegiatan}}</strong></h4>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <tr class="text-center">
                    <th>No</th>
                    <th>Lokasi Kegiatan</th>
                    <th>Pendamping Mitra</th>
                    <th>Mahasiswa</th>
                    <th>Program Studi</th>
                    <th width='15%'>Aksi</th>
                </tr>
                @forelse ($item->list_guidance as $key => $value)
                <tr>
                    <td class="text-center">{{ $item->list_guidance->firstItem() + $key }}</td>
                    <td>{{ $value->partner()->first()->nama_mitra ?? '' }}</td>
                    <td>{{ $value->partner()->first()->pamong_mitra ?? '' }}</td>
                    <td>{!! $value->student()->first()->student_link_profile ?? '' !!}</td>
                    <td>{!! $value->student()->first()->prodi()->first()->nama_prodi ?? '' !!}</td>
                    <td>
                        <a href="{{ url('guidance/'.$guard.'/' . $value->uuid) }}"
                            class="btn btn-outline-info btn-sm m-1">Detail Kegiatan</a>
                        <a href="{{ url($guard.'/profile/' . $value->student()->first()->uuid) }}"
                            class="btn btn-outline-primary btn-sm m-1">Daftar Jurnal</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6"><i>Tidak Ada Daftar Bimbingan</i></td>
                </tr>
                @endforelse
            </table>

            <div>
                {!! $item->list_guidance->links() !!}
            </div>
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