@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')

            @if ($data == null)
                {{ Form::open(['url' => route('admin_prodi.store')]) }}
            @else
                {{ Form::model($data, ['url' => route('admin_prodi.update', ['id' => $data->uuid]), 'method' => 'put']) }}
            @endif

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Nama Pengguna</label>
                <div class="col-md-5">
                    {{ Form::text('nama_pengguna', null, ['class' => 'form-control', 'placeholder' => 'Nama Pengguna']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Email</label>
                <div class="col-md-5">
                    {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Password</label>
                <div class="col-md-5">
                    {{ Form::password('password', ['class' => 'form-control ', 'placeholder' => 'Password']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Prodi</label>

                <div class="col-md-6">
                    {{ Form::select('prodi_uuid', $prodi, null, ['placeholder' => '-- Pilih Prodi --', 'id' => 'prodi', 'class' => 'form-control prodi-select2']) }}
                </div>
            </div>


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
    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.prodi-select2').select2();
        });

    </script>
@endsection
