@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('alert')
            @if ($data == null)
                {{ Form::open(['url' => route('magang.store'), 'files' => true]) }}
            @else
                {{ Form::model($data, ['url' => route('magang.update', ['id' => $data->uuid]), 'method' => 'put', 'files' => true]) }}
            @endif
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('mulai_kegiatan', 'Mulai Kegiatan') }}
                        {{ Form::date('mulai_kegiatan', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('akhir_kegiatan', 'Akhir Kegiatan') }}
                        {{ Form::date('akhir_kegiatan', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('lama_kegiatan', 'Lama Kegiatan') }}
                        {{ Form::number('lama_kegiatan', null, ['class' => 'form-control', 'placeholder' => 'Lama Kegiatan (Hari)']) }}
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('file_sk_magang', 'File SK Kegiatan') }}
                {{ Form::text('file_sk_magang', null, ['class' => 'form-control', 'placeholder' => 'Link File SK Google Drive']) }}
            </div>

            <div class="form-group">
                {{ Form::label('status_magang', 'Status Kegiatan') }}
                {{ Form::select('status_magang', ['1' => 'Masih Berjalan', '2' => 'Selesai'], null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('dosen_uuid', 'Dosen Pembimbing') }}
                {{ Form::select('dosen_uuid', $dosen, null, ['placeholder' => '-- Pilih Dosen --', 'class' => 'form-control dosen-select2']) }}
            </div>

            <div class="form-group">
                {{ Form::label('mahasiswa_uuid', 'Mahasiswa') }}
                {{ Form::select('mahasiswa_uuid[]', $mahasiswa, null, ['multiple' => 'multiple', 'class' => 'form-control mahasiswa-select2']) }}
            </div>

            <div class="form-group">
                {{ Form::label('mitra_uuid', 'Mitra') }}
                {{ Form::select('mitra_uuid', $mitra, null, ['placeholder' => '-- Pilih Mitra --', 'class' => 'form-control mitra-select2']) }}
            </div>

            <div class="form-group">
                {{ Form::label('status_mitra', 'Status Mitra') }}
                {{ Form::select('status_mitra', ['Dalam Negeri' => 'Dalam Negeri', 'Luar Negeri' => 'Luar Negeri'], ['Dalam Negeri' => 'Dalam Negeri'], ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('jenis_kegiatan_uuid', 'Jenis Kegiatan') }}
                {{ Form::select('jenis_kegiatan_uuid', $jenis_kegiatan, null, ['placeholder' => '-- Pilih Jenis Kegiatan --', 'class' => 'form-control jenis_kegiatan-select2']) }}
            </div>

            <div class="form-group">
                {{ Form::label('link_survey', 'Link Survey') }}
                {{ Form::text('link_survey', null, ['class' => 'form-control', 'placeholder' => 'Link File Link Survey']) }}
            </div>

            <div class="form-group text-right">
                <a href="{{ route('magang.index') }}" class="btn btn-danger">Kembali</a>
                {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')
    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.dosen-select2').select2();
            $('.mitra-select2').select2();
            $('.jenis_kegiatan-select2').select2();
            $('.mahasiswa-select2').select2();
            $('.select2').css('width', "100%");

        });

    </script>
@endsection
