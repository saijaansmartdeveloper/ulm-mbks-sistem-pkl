@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('validation')
            {{ Form::open(['url' => route('admin_prodi.store')]) }}
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Nama Pengguna</label>
                <div class="col-md-5">
                    {{ Form::text('nama_pengguna', null, ['class' => 'form-control', 'placeholder' => 'Nama Pengguna']) }}
                </div>
            </div>

            @include('admin_prodi.form')

            <div class="form-group row">
                <div class="col-md-6 offset-md-2">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                    </form>
                    <a href="{{ route('admin_prodi.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <link href="{{ asset('bootstrapselect/css/bootstrap-select.css') }}" rel="stylesheet">
    <script src="{{ asset('bootstrapselect/js/bootstrap-select.js') }}"></script>
    
@endsection
