@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')

            @if ($data == null)
                {{ Form::open(['url' => route('jurusan.store')]) }}
            @else
                {{ Form::model($data, ['url' => route('jurusan.update', ['id' => $data->uuid]), 'method' => 'put']) }}
            @endif

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Kode Jurusan</label>
                <div class="col-md-5">
                    {{ Form::text('kode_jurusan', null, ['class' => 'form-control', 'placeholder' => 'Kode Jurusan']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Nama Jurusan</label>
                <div class="col-md-5">
                    {{ Form::text('nama_jurusan', null, ['class' => 'form-control', 'placeholder' => 'Nama Jurusan']) }}
                </div>
            </div>


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
