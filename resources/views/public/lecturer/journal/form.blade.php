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
                    <td>: <strong>{{ $data->magang()->first()->partner()->first()->nama_mitra }}</strong></td>
                    <td>Waktu Magang</td>
                    <td>: <strong>{{ $data->magang()->first()->mulai_magang }} s.d {{ $data->magang()->first()->akhir_magang }}</strong></td>
                </tr>
                <tr>
                    <td>Pamong Magang</td>
                    <td>: <strong>{{ $data->magang()->first()->partner()->first()->pamong_mitra }}</strong></td>
                    <td>SK Magang</td>
                    <td><a href="{{ url($data->magang()->first()->file_sk_magang) }}" target="__blank" class="btn btn-outline-info btn-sm">Download SK</a></td>
                </tr>
                <tr>
                    <td>Penanggung Jawab Tempat Magang</td>
                    <td>: <strong>{{ $data->magang()->first()->partner()->first()->penanggung_jawab_mitra }}</strong></td>
                    <td>Dosen Pembimbing</td>
                    <td>: <strong>{{ $data->magang()->first()->lecturer()->first()->nama_dosen }}</strong></td>
                </tr>
                <tr>
                    <td>File Laporan : <a href="{{ asset($data->file_dokumen_jurnal) }}" target="_blank">Lihat</a></td>
                    <td>Image Dokumentasi : <a href="{{ asset($data->file_image_jurnal) }}" target="_blank">Lihat</a></td>
                    <td>Status Jurnal</td>
                    <td>
                        {!! $data->status_jurnal_with_label !!}

                    </td>
                </tr>
                <tr>
                    <td>Catatan Jurnal</td>
                    <td colspan="3">{!! $data->catatan_jurnal !!}</td>
                </tr>
                <tr>
                    <td>Komentar Jurnal</td>
                    <td colspan="3">{!! $data->komentar_jurnal !!}</td>
                </tr>
            </table>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-comment">
                Tambah Komentar
            </button>
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

