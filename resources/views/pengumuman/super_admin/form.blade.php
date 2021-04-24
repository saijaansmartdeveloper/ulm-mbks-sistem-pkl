@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')

            @if ($data == null)
                {{ Form::open(['url' => route('pengumuman.store')]) }}
            @else
                {{ Form::model($data, ['url' => 'pengumuman/' . $data->id, 'method' => 'put']) }}
            @endif
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Judul Pengumuman</label>
                <div class="col-md-5">
                    {{ Form::text('judul_pengumuman', null, ['class' => 'form-control', 'placeholder' => 'Judul Pengumuman']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Isi Pengumuman</label>
                <div class="col-md-5">
                    {{ Form::textarea('content_pengumuman', null, ['class' => 'form-control','rows' => '4', 'placeholder' => 'Isi Pengumuman']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Tanggal Pengumuman</label>
                <div class="col-md-5">
                    {{ Form::date('tanggal_pengumuman', null, ['class' => 'form-control', 'placeholder' => 'Tanggal Pengumuman']) }}
                </div>
            </div>

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

@section('js')
    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.jurusan-select2').select2();
        });

    </script>
@endsection
