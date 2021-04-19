@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            {{ Form::open(['url' => route('magang.store'), 'enctype' => 'multipart/form-data']) }}
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Mulai Magang</label>
                <div class="col-md-5">
                    {{ Form::date('mulai_magang', null, ['class' => 'form-control']) }}
                </div>
            </div>

            @include('magang.form')

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
    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.dosen-select2').select2();
            $('.mitra-select2').select2();
            $('.jenis_kegiatan-select2').select2();
            $('.mahasiswa-select2').select2();
        });

    </script>
@endsection
