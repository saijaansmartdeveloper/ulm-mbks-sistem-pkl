@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')

    @include('alert')

    <div class="card">
        <div class="card-body">
            @if ($data == null)
                {{ Form::open(['url' => route('dosen.store'), 'files' => true]) }}
            @else
                @if ($guard == 'web')
                {{ Form::model($data, ['url' => route('dosen.update', ['id' => $data->uuid]), 'files' => true, 'method' => 'put']) }}
                @else
                {{ Form::model($data, ['url' => route('public.lecturer.update', ['id' => $data->uuid]), 'files' => true, 'method' => 'put']) }}
                @endif
            @endif

            <div class="form-group">
                {{ Form::hidden('guard', $guard, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('nip_dosen', 'NIP Lecturer') }}
                {{ Form::text('nip_dosen', null, ['class' => 'form-control', 'placeholder' => 'Masukkan NIP Lecturer']) }}
            </div>

            <div class="form-group">
                {{ Form::label('nama_dosen', 'Nama Lecturer') }}
                {{ Form::text('nama_dosen', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Lecturer']) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Email Lecturer']) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
            </div>

            <div class="form-group">
                {{ Form::label('foto_dosen', 'Foto Lecturer') }}
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
