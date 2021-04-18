@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            {{ Form::open(['url' => route('prodi.store')]) }}
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Kode Prodi</label>
                <div class="col-md-5">
                    {{ Form::text('kode_prodi', null, ['class' => 'form-control', 'placeholder' => 'Kode Prodi']) }}
                </div>
            </div>

            @include('prodi.form')

            <div class="form-group row">
                <div class="col-md-6 offset-md-2">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                    </form>
                    <a href="{{ route('prodi.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
