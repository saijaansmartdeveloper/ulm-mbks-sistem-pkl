@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            {{ Form::model($mitra, ['url' => 'mitra/' . $mitra->uuid, 'method' => 'put']) }}
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Nama Mitra</label>
                <div class="col-md-5">
                    {{ Form::text('nama_mitra', null, ['class' => 'form-control', 'placeholder' => 'Nama Mitra']) }}
                </div>
            </div>

            @include('mitra.form')

            <div class="form-group row">
                <div class="col-md-6 offset-md-2">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                    </form>
                    <a href="{{ route('mitra.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
