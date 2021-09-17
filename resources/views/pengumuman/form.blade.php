@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
<div class="card">
    <div class="card-body">
        @include('alert')

        @if ($data == null)
        {{ Form::open(['url' => route('pengumuman.store')]) }}
        @else
        {{ Form::model($data, ['url' => route('pengumuman.update', ['id' => $data->id]), 'method' => 'put']) }}
        @endif
        <div class="form-group">
            {{ Form::label('judul_pengumuman', 'Judul Pengumuman') }}
            {{ Form::text('judul_pengumuman', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Judul Pengumuman']) }}
        </div>
        <div class="form-group">
            {{ Form::label('content_pengumuman', 'Isi Pengumuman') }}
            {{ Form::textarea('content_pengumuman', null, ['class' => 'form-control', 'id' => 'textarea', 'placeholder' => 'Masukkan Isi Pengumuman']) }}
        </div>

        <div class="form-group">
            {{ Form::label('jenis_pengumuman', 'Jenis Pengumuman') }}
            {{ Form::select('jenis_pengumuman', ['pop-up' => 'Pop Up', 'wall' => 'Tertulis'], null, ['class' => 'form-control', 'placeholder' => 'Masukkan Jenis Pengumuman']) }}
        </div>

        @if ($user->hasRole('super_admin'))
        <div class="form-group">
            {{ Form::label('jurusan_uuid', 'Jurusan') }}
            {{ Form::select('jurusan_uuid', $jurusan, null, ['placeholder' => '-- Semua Jurusan --', 'id' => 'jurusan', 'class' => 'form-control jurusan-select2']) }}
        </div>

        <div class="form-group">
            {{ Form::label('prodi_uuid', 'Program Studi') }}
            {{ Form::select('prodi_uuid', $prodi, null, ['placeholder' => '-- Semua Studi Program --', 'id' => 'prodi', 'class' => 'form-control prodi-select2']) }}
        </div>
        @endif

        <div class="form-group">
            {{ Form::label('tanggal_pengumuman', 'Tanggal Pengumuman') }}
            {{ Form::date('tanggal_pengumuman', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Tanggal Pengumuman', 'required' => true]) }}
        </div>
        <div class="form-group">
            {!! Form::label('status_pengumuman', 'Status') !!}
            {!! Form::select('status_pengumuman', ['0' => 'Tidak Aktif', '1' => 'Aktif'], ['1' => 'Aktif'], ['class' =>
            'form-control']) !!}
        </div>
        <div class="form-group text-right">
            <a href="{{ route('pengumuman') }}" class="btn btn-danger">Kembali</a>
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
            $('.jurusan-select2').select2();
        });

        var textarea = document.getElementById("textarea");
        CKEDITOR.replace(textarea, {
            language: 'en-gb'
        });
        CKEDITOR.config.allowedContent = true;

</script>
@endsection