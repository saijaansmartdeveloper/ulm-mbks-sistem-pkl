@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            {{ Form::model($supervisor, ['url' => 'supervisor/' . $supervisor->uuid, 'method' => 'put']) }}
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Nama Pengguna</label>
                <div class="col-md-5">
                    {{ Form::text('nama_pengguna', null, ['class' => 'form-control', 'placeholder' => 'Nama Pengguna']) }}
                </div>
            </div>

            @include('supervisor.form')

            <div class="form-group row">
                <div class="col-md-6 offset-md-2">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                    </form>
                    <a href="{{ route('supervisor.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
