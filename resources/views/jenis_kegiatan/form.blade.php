@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('alert')
            @if ($data == null)
                {{ Form::open(['url' => route('jenis_kegiatan.store')]) }}
            @else
                {{ Form::model($data, ['url' => route('jenis_kegiatan.update', ['id' => $data->uuid]), 'method' => 'put']) }}
            @endif

            <div class="form-group">
                {{ Form::label('kode_jenis_kegiatan', 'Kode Jenis Kegiatan') }}
                {{ Form::text('kode_jenis_kegiatan', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kode Jenis Kegiatan']) }}
            </div>

            <div class="form-group">
                {{ Form::label('nama_jenis_kegiatan', 'Nama Jenis Kegiatan') }}
                {{ Form::text('nama_jenis_kegiatan', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Jenis Kegiatan']) }}
            </div>

            <div class="form-group">
                {{ Form::label('deskripsi_jenis_kegiatan', 'Deskripsi Jenis Kegiatan') }}
                {{ Form::textarea('deskripsi_jenis_kegiatan', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Deskripsi Jenis Kegiatan']) }}
            </div>

            <div class="form-group text-right">
                <a href="{{ route('jenis_kegiatan.index') }}" class="btn btn-danger">Kembali</a>
                {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')

@endsection
