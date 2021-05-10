@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('alert')
            @if ($data == null)
                {{ Form::open(['url' => route('dosen.store'), 'enctype' => 'multipart/form-data']) }}
            @else
                {{ Form::model($data, ['url' => route('dosen.update', ['id' => $data->uuid]), 'enctype' => 'multipart/form-data', 'method' => 'put']) }}
            @endif

            <div class="form-group">
                {{ Form::label('nip_dosen', 'NIP Dosen') }}
                {{ Form::text('nip_dosen', null, ['class' => 'form-control', 'placeholder' => 'Masukkan NIP Dosen']) }}
            </div>

            <div class="form-group">
                {{ Form::label('nama_dosen', 'Nama Dosen') }}
                {{ Form::text('nama_dosen', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Dosen']) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Email Dosen']) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
            </div>

            <div class="form-group">
                {{ Form::label('foto_dosen', 'Foto Dosen') }}
                {{ Form::file('foto_dosen', ['class' => 'form-control-file', 'accept' => 'image/png,image/gif,image/jpeg']) }}
            </div>

            <div class="form-group text-right">
                <a href="{{ route('dosen.index') }}" class="btn btn-danger">Kembali</a>
                {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
