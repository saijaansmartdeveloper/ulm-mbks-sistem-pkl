@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')
    @include('alert')

    <div class="card py-4">
        <div class="card-body">

            @if ($data == null)
            {{ Form::open(['url' => route('public.journal.store'), 'files' => true]) }}
            @else
            {{ Form::model($data, ['url' => 'journal/' . $data->uuid, 'method' => 'put', 'file' => 'true']) }}
            @endif

                <div class="col-12">
                    <h4 class="h4">Form Jurnal</h4>
                    <hr>
                    <div class="form-group">
                        <label class="col-form-label text-md-right" for="tanggal_jurnal">Tanggal Jurnal</label>
                        {{ Form::date('tanggal_jurnal', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-md-right" for="catatan_monev">Catatan Jurnal</label>
                        {{ Form::textarea('catatan_jurnal', null, ['class' => 'form-control', 'rows' => '4', 'placeholder' => 'Catatan Jurnal']) }}
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label text-md-right" for="file_image_jurnal">File Image Dokumentasi</label><br>
                        {{ Form::file('file_image_jurnal', ['class' => 'form-control-file']) }}
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label text-md-right" for="file_dokumen_jurnal">File Laporan</label><br>
                        {{ Form::file('file_dokumen_jurnal', ['class' => 'form-control-file']) }}
                    </div>
                     <div class="form-group">
                        {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                        <a href="{{ route('public.journal.index') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection

