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
                {{ Form::label('nama_mitra', 'Nama Mitra') }}
                {{ Form::text('nama_mitra', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Mitra']) }}
            </div>

            <div class="form-group">
                {{ Form::label('divisi_mitra', 'Divisi Mitra') }}
                {{ Form::text('divisi_mitra', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Divisi Mitra']) }}
            </div>

            <div class="form-group">
                {{ Form::label('alamat_mitra', 'Alamat Mitra') }}
                {{ Form::textarea('alamat_mitra', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Alamat Mitra']) }}
            </div>

            <div class="form-group">
                {{ Form::label('penanggung_jawab_mitra', 'Penanggung Jawab Mitra') }}
                {{ Form::text('penanggung_jawab_mitra', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Penanggung Jawab Mitra']) }}
            </div>

            <div class="form-group">
                {{ Form::label('pamong_mitra', 'Pendamping Mitra') }}
                {{ Form::text('pamong_mitra', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Pendamping Mitra']) }}
            </div>

            <div class="form-group">
                {{ Form::label('eemail_mitra', 'Email Mitra') }}
                {{ Form::email('email_mitra', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Email Mitra']) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email Pendamping') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Email Pendamping']) }}
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
                <a href="{{ route('public.partner.index') }}" class="btn btn-danger">Kembali</a>
                {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
