@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('alert')

            @if ($data == null)
                {{ Form::open(['url' => route('jurusan.store')]) }}
            @else
                {{ Form::model($data, ['url' => route('jurusan.update', ['id' => $data->uuid]), 'method' => 'put']) }}
            @endif


            <div class="form-group">
                {{ Form::label('kode_jurusan', 'Kode Major') }}
                {{ Form::text('kode_jurusan', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kode Major']) }}
            </div>

            <div class="form-group">
                {{ Form::label('nama_jurusan', 'Nama Major') }}
                {{ Form::text('nama_jurusan', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Major']) }}
            </div>


            <div class="form-group text-right">
                <a href="{{ route('jurusan.index') }}" class="btn btn-danger">Kembali</a>
                {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
            </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
