@extends('layouts.admin')

@section('content-header', $title ." #". $data->tanggal_jurnal ?? '')

@section('content')

    @include('alert')

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <h3 class="h4"><strong>Jurnal Kegiatan {{ $data->activity()->typeofactivity()->first()->nama_jenis_kegiatan ?? ''}}</strong></h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 text-right">
                    @if (!($data->status_jurnal != 'submit' || $data->status_jurnal != 'resubmit'))
                        <button class="btn btn-outline-success btn-sm"><span class="fas fa-edit"></span></button>
                    @endif
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <tr>
                        <td width="20%">Tempat Pelaksanaan</td>
                        <td>: <strong>{!! $data->activity()->partner()->first()->partner_link_profile ?? '' !!}</strong></td>
                    </tr>
                    <tr>
                        <td>Waktu Pelaksanaan</td>
                        <td>: <strong>{{ $data->activity()->mulai_kegiatan }} s.d {{ $data->activity()->akhir_kegiatan }} ({{ $data->activity()->lama_kegiatan }} Hari)</strong></td>
                    </tr>
                    <tr>
                        <td>Mitra Pendamping</td>
                        <td>: <strong>{!! $data->activity()->partner()->first()->pamong_mitra !!}</strong></td>
                    </tr>
                    <tr>
                        <td>Dosen Pendamping</td>
                        <td>: <strong>{!! $data->activity()->lecturer()->first()->lecturer_link_profile !!}</strong></td>
                    </tr>
                    <tr>
                        <td>Mahasiswa</td>
                        <td>: <strong> {!! $data->activity()->student()->first()->student_link_profile !!}</strong></td>
                    </tr>
                    <tr>
                        <td>Status Jurnal</td>
                        <td>
                            : {!! $data->status_jurnal_with_label !!}
                        </td>
                    </tr>
                    <tr>
                        <td>Isi Catatan Jurnal</td>
                        <td>: {!! $data->catatan_jurnal !!}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            @forelse ($data->comments()->get() as $key => $item)
            <div class="col-12 mb-3">

            </div>
            @empty
            <div class="col-12">
                <i>Tidak Ada Komentar</i>
            </div>
            @endforelse
            @if ($guard == 'lecturer')
                <button class="btn btn-success btn-sm btn-block mt-3" style="height: 2.5rem" data-bs-toggle="modal" data-bs-target="#add-comment">Tambah Komentar dan Update Status</button>
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <strong>Lampiran</strong>
            <hr>
            <ol>
                @if ($data->file_dokumen_jurnal != null)
                <li> <a href="{{ asset($data->file_dokumen_jurnal ?? 'file_not_found') }}" target="_blank" class="text-link">Dokumen Upload Terlampir</a> </li>
                @endif
                @if ($data->file_image_jurnal != null)
                <li> <a href="{{ asset($data->file_image_jurnal ?? 'file_not_found') }}" target="_blank">Gambar Jurnal Terlampir</a> </li>
                @endif
            </ol>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add-comment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            {{ Form::open(['url' => route('public.lecturer.student_guidance.update_journal', ['id' => $data->uuid]), 'method' => 'PUT']) }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Komentar</h5>
                    <a href="#" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="close">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_dosen">Anda Sebagai :</label>
                        <input type="text" class="form-control" value="{!! $data->activity()->lecturer()->first()->nama_dosen !!}" readonly disabled>
                        <input type="hidden" class="form-control" value="{{ $data->activity()->lecturer()->first()->uuid }}">
                    </div>
                    <div class="form-group">
                        <label for="komentar_jurnal">Komentar</label>
                        <textarea name="komentar_jurnal" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="komentar_jurnal">Status Jurnal</label>
                        <select name="status_jurnal" class="form-control">
                            <option value="accepted">Diterima</option>
                            <option value="rejected">Ditolak</option>
                            <option value="revision">Direvisi</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection

