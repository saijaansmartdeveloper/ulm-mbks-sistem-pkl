@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')

            @if ($data == null)
                {{ Form::open(['url' => route('public.monev.store')]) }}
            @else
                {{ Form::model($data, ['url' => 'monev/' . $data->uuid, 'method' => 'put']) }}
            @endif
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Catatan Monev</label>
                <div class="col-md-5">
                    {{ Form::textarea('catatan_monev', null, ['class' => 'form-control', 'rows' => '4', 'placeholder' => 'Catatan Monev']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Tanggal Monev</label>
                <div class="col-md-5">
                    {{ Form::date('tanggal_monev', null, ['class' => 'form-control', 'placeholder' => 'Tanggal Monev']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">File Monev</label>
                <div class="col-md-5">
                    {{ Form::text('file_monev', null, ['class' => 'form-control', 'placeholder' => 'file_monev']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Kegiatan</label>
                <div class="col-md-5">
                    {{ Form::select('file_monev', $magang, null, ['class' => 'form-control magang-select2', 'placeholder' => '--Pilih Magang--']) }}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-2">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                    </form>
                    <a href="{{ route('public.monev.index') }}" class="btn btn-danger">Kembali</a>
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
            $('.magang-select2').select2();
        });

    </script>
@endsection
