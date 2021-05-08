@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')

            @if ($data == null)
                {{ Form::open(['url' => route('user.store')]) }}
            @else
                {{ Form::model($data, ['url' => route('user.update', ['id' => $data->uuid]), 'method' => 'put']) }}
            @endif

            <div class="form-group">
                {{ Form::label('nama_pengguna', 'Nama Pengguna') }}
                {{ Form::text('nama_pengguna', null, ['class' => 'form-control', 'placeholder' => 'Nama Pengguna']) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['class' => 'form-control ', 'placeholder' => 'Password']) }}
            </div>

            <div class="form-group">
                {{ Form::label('role_pengguna', 'Role Pengguna') }}
                {{ Form::select('role_pengguna', ['admin_prodi' => 'Admin StudyProgram', 'supervisor' => 'Supervisor'], null, ['placeholder' => '-- Pilih Role --', 'class' => 'form-control role-select2']) }}
            </div>

            <div class="form-group">
                {{ Form::label('prodi_uuid', 'Program Studi') }}
                {{ Form::select('prodi_uuid', $prodi, null, ['placeholder' => '-- Pilih StudyProgram --', 'id' => 'prodi', 'class' => 'form-control prodi-select2']) }}
            </div>

            <div class="form-group text-right">
                <a href="{{ route('user.index') }}" class="btn btn-danger">Kembali</a>
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
            $('.prodi-select2').select2();
            $('.role-select2').select2();
            $('.select2').css('width','100%');
        });

    </script>
@endsection
