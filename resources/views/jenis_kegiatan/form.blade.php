@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            @if ($data == null)
                {{ Form::open(['url' => route('jenis_kegiatan.store')]) }}
            @else
                {{ Form::model($data, ['url' => route('jenis_kegiatan.update', ['id' => $data->uuid]), 'method' => 'put']) }}
            @endif

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Kode Jenis Kegiatan</label>
                <div class="col-md-5">
                    {{ Form::text('kode_jenis_kegiatan', null, ['class' => 'form-control', 'placeholder' => 'Kode Jenis Kegiatan']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Nama Jenis Kegiatan</label>
                <div class="col-md-5">
                    {{ Form::text('nama_jenis_kegiatan', null, ['class' => 'form-control', 'placeholder' => 'Nama Jenis Kegiatan']) }}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-2">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                    </form>
                    <a href="{{ route('jenis_kegiatan.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
