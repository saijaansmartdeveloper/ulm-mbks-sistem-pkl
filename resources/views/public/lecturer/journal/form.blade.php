@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            {{ Form::model($data, ['url' => '/public/lecturer/mahasiswa_bimbingan/jurnal/' . $data->uuid, 'method' => 'put']) }}
            <div class="row">
                <div class="col-2">
                    <h4>Catatan Jurnal</h4>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    {{ Form::textarea('catatan_jurnal', null, ['class' => 'form-control', 'rows' => '4', 'placeholder' => 'Isi Komentar', 'readonly' => true]) }}

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-2">
                    <h4>Foto Kegiatan</h4>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <img src="{{ asset('storage/' . $data->file_image_jurnal . '') }}" alt="">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-2">
                    <h4>Dokumen Jurnal</h4>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="" class="btn btn-warning" target = '_blank'>Lihat Data</a>
                </div>
            </div>
            <hr>

            
            <div class="row">
                <div class="col-2">
                    <h4>Komentar Jurnal</h4>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    {{ Form::textarea('komentar_jurnal', null, ['class' => 'form-control', 'rows' => '4', 'placeholder' => 'Isi Komentar']) }}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 mt-5">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
