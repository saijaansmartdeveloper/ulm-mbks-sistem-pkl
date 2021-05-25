@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('alert')
            @if ($data == null)
                {{ Form::open(['url' => route('public.monev.store'), 'files' => true]) }}
            @else
                {{ Form::model($data, ['url' => 'monev/' . $data->uuid, 'method' => 'put', 'files' => true]) }}
            @endif

            <div class="form-group ">
                {{ Form::label('magang_uuid', 'Kegiatan') }}
                {{ Form::select('magang_uuid', $magang, null, ['class' => 'form-control magang-select2', 'placeholder' => '-- Pilih Kegiatan --']) }}
            </div>

            <div class="form-group ">
                {{ Form::label('jenis_laporan', 'Jenis Laporan') }}
                {{ Form::select('jenis_laporan', ['Laporan Penyerahan Ke Mitra' => 'Laporan Penyerahan Ke Mitra', 'Laporan Akhir' => 'Laporan Akhir', 'Sharing Session' => 'Sharing Session'], null, ['class' => 'form-control jenis-laporan-select2', 'placeholder' => '-- Pilih Jenis Laporan --']) }}
            </div>

            <div class="form-group ">
                {{ Form::label('catatan_monev', 'Catatan') }}
                {{ Form::textarea('catatan_monev', null, ['class' => 'form-control', 'id' => 'textarea', 'placeholder' => 'Catatan Laporan Kegiatan']) }}
            </div>

            <div class="form-group ">
                {{ Form::label('tanggal_monev', 'Tanggal') }}
                {{ Form::date('tanggal_monev', null, ['class' => 'form-control', 'placeholder' => 'Tanggal Laporan Kegiatan']) }}
            </div>

            <div class="form-group">
                {{ Form::label('file_monev', 'File Dokumen') }}
                {{ Form::file('file_monev', ['class' => 'form-control-file', 'accept' => '.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document']) }}
            </div>



            <div class="form-group text-right">
                <a href="{{ route('public.monev.index') }}" class="btn btn-danger">Kembali</a>
                {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')
    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('.magang-select2').select2();
            $('.jenis-laporan-select2').select2();
        });

        var textarea = document.getElementById("textarea");
        CKEDITOR.replace(textarea, {
            language: 'en-gb'
        });
        CKEDITOR.config.allowedContent = true;

    </script>
@endsection
