@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')

    @include('alert')

    <div class="card">
        <div class="card-body">

            @if ($data == null)
                {{ Form::open(['url' => route('public.student.store'), 'files' => true]) }}
            @else
                {{ Form::model($data, ['url' => route('public.student.update', ['id' => $data->uuid]), 'method' => 'put', 'files' => true]) }}
            @endif

            <div class="form-group">
                {{ Form::hidden('guard', $guard, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('nim_mahasiswa', 'NIM Student') }}
                {{ Form::text('nim_mahasiswa', null, ['class' => 'form-control', 'placeholder' => 'Masukkan NIM Student']) }}
            </div>

            <div class="form-group">
                {{ Form::label('nama_mahasiswa', 'Nama Student') }}
                {{ Form::text('nama_mahasiswa', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Student']) }}
            </div>

            <div class="form-group">
                {{ Form::label('phone', 'No. Telepon Student') }}
                {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Masukkan No. Telepon Student']) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email Student') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Email Student']) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Masukkan Password']) }}
            </div>

            <div class="form-group">
                {{ Form::label('foto_mahasiswa', 'Foto Student') }}
                {{ Form::file('foto_mahasiswa', ['class' => 'form-control-file', 'accept' => 'image/png, image/jpeg']) }}
            </div>


            <div class="form-group text-right">
                {{ Form::reset('Reset', ['class' => 'btn btn-danger']) }}
                {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
            </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
