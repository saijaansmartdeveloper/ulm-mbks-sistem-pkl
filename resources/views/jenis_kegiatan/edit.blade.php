@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            {{ Form::model($jenis_kegiatan, ['url' => 'jenis_kegiatan/' . $jenis_kegiatan->uuid, 'method' => 'put']) }}

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Kode Jenis Kegiatan</label>
                <div class="col-md-5">
                    {{ Form::text('kode_jenis_kegiatan', null, ['class' => 'form-control', 'placeholder' => 'Kode Jenis Kegiatan']) }}
                </div>
            </div>

            @include('jenis_kegiatan.form')

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
