@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('alert')

            @if ($data == null)
                {{ Form::open(['url' => route('prodi.store')]) }}
            @else
                {{ Form::model($data, ['url' => route('prodi.update', ['id' => $data->uuid]), 'method' => 'put']) }}
            @endif

            <div class="form-group">
                {{ Form::label('kode_prodi', 'Kode Prodi') }}
                {{ Form::text('kode_prodi', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kode Prodi']) }}

            </div>

            <div class="form-group">
                {{ Form::label('nama_prodi', 'Nama Prodi') }}
                {{ Form::text('nama_prodi', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Prodi']) }}
            </div>

            <div class="form-group">
                {{ Form::label('jurusan_uuid', 'Jurusan') }}
                {{ Form::select('jurusan_uuid', $jurusan, null, ['placeholder' => '-- Pilih Jurusan --', 'id' => 'jurusan', 'class' => 'form-control jurusan-select2']) }}
            </div>

            <div class="form-group text-right">
                <a href="{{ route('prodi.index') }}" class="btn btn-danger">Kembali</a>
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
            $('.jurusan-select2').select2();
            $('.select2').css('width', "100%");
        });

    </script>
@endsection
