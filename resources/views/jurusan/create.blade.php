@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('validation')
            {{ Form::open(['url' => route('jurusan.store')]) }}
            @csrf
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Kode Jurusan</label>
                <div class="col-md-5">
                    {{ Form::text('kode_jurusan', null, ['class' => 'form-control', 'placeholder' => 'Kode Jurusan']) }}
                </div>
            </div>

            @include('jurusan.form')

            <div class="form-group row">
                <div class="col-md-6 offset-md-2">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                    </form>
                    <a href="{{ route('jurusan.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
