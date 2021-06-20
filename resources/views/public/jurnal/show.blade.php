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
                    @if ($guard == 'student')
                        @switch($data->status_jurnal)
                            @case('submit')
                                {!! Form::open(['url' => route('public.journal.destroy', ['uuid' => $data->uuid]), 'id' => 'data-' . $data->uuid, 'method' => 'delete']) !!}
                                {!! Form::close() !!}
                                <button onclick="deleteRow('{{$data->uuid}}')" class="btn btn-danger btn-sm"><span class="fas fa-trash fa-sm"></span></button>
                                @break
                            @case('resubmit')
                                @break
                            @default
                            <a href="{{ route('public.journal.edit', ['prefix' => 'student', 'uuid' => $data->uuid]) }}" class="btn btn-outline-success btn-sm"><span class="fas fa-edit"></span></a>
                        @endswitch
                    @endif
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <tr>
                        <td width="20%">Tempat Pelaksanaan</td>
                        <td>: <strong>{!! $data->activity()->partner()->first()->partner_link_profile ?? '' !!}</strong></td>
                        <td>Waktu Pelaksanaan</td>
                        <td>: <strong>{{ Carbon\Carbon::createFromDate($data->activity()->mulai_kegiatan)->format('d M Y') }} - {{ Carbon\Carbon::createFromDate($data->activity()->akhir_kegiatan)->format('d M Y') }} ({{ $data->activity()->lama_kegiatan }} Hari)</strong></td>
                    </tr>
                    <tr>
                        <td>Mitra Pendamping</td>
                        <td>: <strong>{!! $data->activity()->partner()->first()->pamong_mitra !!}</strong></td>
                        <td>Dosen Pendamping</td>
                        <td>: <strong>{!! $data->activity()->lecturer()->first()->lecturer_link_profile !!}</strong></td>
                    </tr>
                    <tr>
                        <td>Mahasiswa</td>
                        <td>: <strong> {!! $data->activity()->student()->first()->student_link_profile !!}</strong></td>
                        <td>Status Jurnal</td>
                        <td>
                            : {!! $data->status_jurnal_with_label !!}
                        </td>
                    </tr>

                    <tr>
                        <td>Isi Catatan Jurnal</td>
                        <td colspan="3">: {!! $data->catatan_jurnal !!}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Komentar Jurnal</div>
        <div class="card-body">
            @forelse ($data->comments()->get() as $key => $item)
            <div class="col-12 mb-3">
                <div class="d-flex justify-content-between mb-2">
                    <p class="d-inline-block"><strong>{{ $item->lecturer()->first()->nama_dosen ?? '' }}</strong> Memberikan Komentar :</p>
                    <div class="mb-1 d-inline-block">
                        <span class="text-secondary">{!! ($item->updated_at)->format('H:i:s d M Y')!!}</span>
                    </div>
                </div>
                <blockquote class="form-control mb-2">
                    {{$item->komentar_jurnal}}
                </blockquote>
                <div class="text-right">
                    @if ($guard == 'lecturer')
                        <a href="#" class="btn btn-primary btn-sm mr-2" data-bs-toggle="modal" data-bs-target="#add-comment">
                            <i class="fas fa-plus"></i>
                        </a>
                        {!! Form::open(['url' => route('public.journal.comment.destroy', ['prefix' => 'lecturer', 'id' => $item->uuid]), 'method' => 'delete', 'class' => 'd-inline-block']) !!}
                        <button type="submit" class="btn btn-outline-danger btn-sm mr-2">
                            <i class="fas fa-trash"></i>
                        </button>
                        {!! Form::close() !!}
                    @endif
                </div>
                <hr>
            </div>
            @empty
            <div class="col-12">
                <i>Tidak Ada Komentar</i>
                @if ($guard == 'lecturer')
                    <button class="btn btn-success btn-sm btn-block mt-3" style="height: 2.5rem" data-bs-toggle="modal" data-bs-target="#add-comment">Tambah Komentar dan Update Status</button>
                @endif
            </div>
            @endforelse
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <strong>Lampiran</strong>
            <hr>
            <ol>
                @if ($data->file_dokumen_jurnal != null)
                <li> <a href="{{ asset('storage/' . $data->file_dokumen_jurnal ?? 'file_not_found') }}" target="_blank" class="text-link">Dokumen Upload Terlampir</a> </li>
                @endif
                @if ($data->file_image_jurnal != null)
                <li> <a href="{{ asset('storage/' . $data->file_image_jurnal ?? 'file_not_found') }}" target="_blank">Gambar Jurnal Terlampir</a> </li>
                @endif
            </ol>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add-comment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            {{ Form::open(['url' => route('public.journal.comment.store', ['prefix' => 'lecturer']), 'method' => 'POST']) }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Komentar</h5>
                    <a href="#" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="close">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_dosen">Anda Sebagai :</label>
                        <input type="text" class="form-control" value="{!! $data->activity()->lecturer()->first()->nama_dosen !!}" readonly disabled>
                        <input name="dosen_uuid" type="hidden" class="form-control" value="{{ $data->activity()->lecturer()->first()->uuid }}">
                        <input name="jurnal_uuid" type="hidden" class="form-control" value="{{ $data->uuid }}">
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

@section('js')

<script src="{{ asset('sweetalert/alert.js') }}"></script>

@endsection

