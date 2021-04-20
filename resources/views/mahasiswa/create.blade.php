@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            {{ Form::open(['url' => route('mahasiswa.store'), 'enctype' => 'multipart/form-data']) }}
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">NIM Mahasiswa</label>
                <div class="col-md-5">
                    {{ Form::text('nim_mahasiswa', null, ['class' => 'form-control', 'placeholder' => 'NIM Mahasiswa']) }}
                </div>
            </div>

            @include('mahasiswa.form')

            <div class="form-group row">
                <div class="col-md-6 offset-md-2">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                    </form>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
