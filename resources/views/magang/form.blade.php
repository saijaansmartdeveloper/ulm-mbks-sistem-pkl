@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            @if ($data == null)
                {{ Form::open(['url' => route('magang.store'), 'enctype' => 'multipart/form-data']) }}
            @else
                {{ Form::model($data, ['url' => route('magang.update', ['id' => $data->uuid]), 'method' => 'put', 'enctype' => 'multipart/form-data']) }}
            @endif

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Mulai Kegiatan</label>
                <div class="col-md-5">
                    {{ Form::date('mulai_magang', null, ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Akhir Kegiatan</label>
                <div class="col-md-5">
                    {{ Form::date('akhir_magang', null, ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Lama Kegiatan</label>
                <div class="col-md-3">
                    {{ Form::number('lama_magang', null, ['class' => 'form-control', 'placeholder' => 'Lama Magang (Minggu)']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">File SK Kegiatan</label>

                <div class="col-md-6">
                    {{ Form::text('file_sk_magang', null, ['class' => 'form-control', 'placeholder' => 'Link File SK Google Drive']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Status Kegiatan</label>

                <div class="col-md-6">
                    {{ Form::select('status_magang', ['1' => 'Masih Berjalan', '2' => 'Selesai'], null, ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Dosen</label>

                <div class="col-md-6">
                    {{ Form::select('dosen_uuid', $dosen, null, ['placeholder' => '-- Pilih Dosen --', 'class' => 'form-control dosen-select2']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Mahasiswa</label>

                <div class="col-md-6">
                    {{ Form::select('mahasiswa_uuid[]', $mahasiswa, null, ['multiple' => 'multiple', 'class' => 'form-control mahasiswa-select2']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Mitra</label>

                <div class="col-md-6">
                    {{ Form::select('mitra_uuid', $mitra, null, ['placeholder' => '-- Pilih Mitra --', 'class' => 'form-control mitra-select2']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Jenis Kegiatan</label>

                <div class="col-md-6">
                    {{ Form::select('jenis_kegiatan_uuid', $jenis_kegiatan, null, ['placeholder' => '-- Pilih Jenis Kegiatan --', 'class' => 'form-control jenis_kegiatan-select2']) }}
                </div>
            </div>



            <div class="form-group row">
                <div class="col-md-6 offset-md-2">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                    </form>
                    <a href="{{ route('magang.index') }}" class="btn btn-danger">Kembali</a>
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
