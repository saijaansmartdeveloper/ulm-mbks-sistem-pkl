@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('alert')
            @if ($data == null)
                {{ Form::open(['url' => route('mitra.store')]) }}
            @else
                {{ Form::model($data, ['url' => 'mitra/' . $data->uuid, 'method' => 'put']) }}
            @endif

            <div class="form-group">
                {{ Form::label('nama_mitra', 'Nama Partner') }}
                {{ Form::text('nama_mitra', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Partner']) }}
            </div>

            <div class="form-group">
                {{ Form::label('divisi_mitra', 'Divisi Partner') }}
                {{ Form::text('divisi_mitra', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Divisi Partner']) }}
            </div>

            <div class="form-group">
                {{ Form::label('alamat_mitra', 'Alamat Partner') }}
                {{ Form::textarea('alamat_mitra', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Alamat Partner']) }}
            </div>

            <div class="form-group">
                {{ Form::label('penanggung_jawab_mitra', 'Penanggung Jawab Partner') }}
                {{ Form::text('penanggung_jawab_mitra', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Penanggung Jawab Partner']) }}
            </div>

            <div class="form-group">
                {{ Form::label('pamong_mitra', 'Pamong Partner') }}
                {{ Form::text('pamong_mitra', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Pamong Partner']) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email Partner') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Email']) }}
            </div>

            <div class="form-group">
                {{ Form::label('username', 'Username') }}
                {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Username']) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Masukkan Password']) }}
            </div>

            <div class="form-group">
                {{ Form::label('phone', 'No. Telepon') }}
                {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Masukkan No. Telepon']) }}
            </div>

            <div class="form-group text-right">
                <a href="{{ route('mitra.index') }}" class="btn btn-danger">Kembali</a>
                {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
