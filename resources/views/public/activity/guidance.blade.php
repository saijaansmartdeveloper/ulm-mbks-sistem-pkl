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
                        @if ($guard == 'partner')
                        <button type="button" class="btn btn-success btn-sm m-1" data-bs-toggle="modal"
                            data-bs-target="#uploadNilai">Upload Nilai</button>

                        <!-- Modal -->
                        <div class="modal fade" id="uploadNilai" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    {!! Form::open(['url' => route('public.activity.report_file', ['id' =>
                                    $value->uuid]), 'method' => 'put', 'files' => true]) !!}
                                    {{-- {{ Form::model($item, ['route' => ['public.activity.report_file', ['id' =>
                                    $item->uuid]], 'method' => 'put', 'files' => true]) }} --}}
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Upload Nilai</h5>
                                        <a href="#" class="close" data-dismiss="modal" data-bs-dismiss="modal"
                                            aria-label="close">&times;</a>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            @if ($value->file_penilaian_kegiatan != null)
                                            <div class="form-group">
                                                <p>Nilai Telah diupload : <a
                                                        href="{{ asset('storage/' . $value->file_penilaian_kegiatan ?? '404') }}"
                                                        target="_blank">Lihat Disini</a></p>
                                                <p>Untuk Merubah Nilai Bisa Upload Ulang File Tersebut</p>
                                            </div>
                                            <hr>
                                            @endif
                                            <div class="form-group">
                                                <label for="file_jurnal_kegiatan">File Penilaian</label>
                                                {{ Form::file('file_penilaian_kegiatan', ['class' =>
                                                'form-control-file']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        @endif
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
{{-- <div class="card mb-4">
    <div class="card-body">
        <i>Tidak Ada Mahasiswa Bimbingan</i>
    </div>
</div> --}}
@endforelse

@endsection