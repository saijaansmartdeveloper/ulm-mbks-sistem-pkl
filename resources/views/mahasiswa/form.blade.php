@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('alert')

            @if ($data == null)
                {{ Form::open(['url' => route('mahasiswa.store')]) }}
            @else
                {{ Form::model($data, ['url' => route('mahasiswa.update', ['id' => $data->uuid]), 'method' => 'put']) }}
            @endif


            <div class="form-group">
                {{ Form::label('nim_mahasiswa', 'NIM Mahasiswa') }}
                {{ Form::text('nim_mahasiswa', null, ['class' => 'form-control', 'placeholder' => 'Masukkan NIM Mahasiswa']) }}
            </div>

            <div class="form-group">
                {{ Form::label('nama_mahasiswa', 'Nama Mahasiswa') }}
                {{ Form::text('nama_mahasiswa', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Mahasiswa']) }}
            </div>

            <div class="form-group">
                {{ Form::label('phone', 'No. Telepon Mahasiswa') }}
                {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Masukkan No. Telepon Mahasiswa']) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email Mahasiswa') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Email Mahasiswa']) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Masukkan Password']) }}
            </div>

            <div class="form-group">
                {{ Form::label('foto_mahasiswa', 'Foto Mahasiswa') }}
                {{ Form::file('foto_mahasiswa', ['class' => 'form-control-file']) }}
            </div>


            <div class="form-group text-right">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-danger">Kembali</a>
                {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
            </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
