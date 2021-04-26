@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            @if ($data == null)
                {{ Form::open(['url' => route('mitra.store')]) }}
            @else
                {{ Form::model($data, ['url' => 'mitra/' . $data->uuid, 'method' => 'put']) }}
            @endif
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Nama Mitra</label>
                <div class="col-md-5">
                    {{ Form::text('nama_mitra', null, ['class' => 'form-control', 'placeholder' => 'Nama Mitra']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Divisi Mitra</label>
                <div class="col-md-5">
                    {{ Form::text('divisi_mitra', null, ['class' => 'form-control', 'placeholder' => 'Divisi Mitra']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Alamat Mitra</label>
                <div class="col-md-5">
                    {{ Form::textarea('alamat_mitra', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Alamat Mitra']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Penanggung Jawab Mitra</label>
                <div class="col-md-5">
                    {{ Form::text('penanggung_jawab_mitra', null, ['class' => 'form-control', 'placeholder' => 'Penanggung Jawab Mitra']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Pamong Mitra</label>
                <div class="col-md-5">
                    {{ Form::text('pamong_mitra', null, ['class' => 'form-control', 'placeholder' => 'Pamong Mitra']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Email</label>
                <div class="col-md-5">
                    {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Username</label>
                <div class="col-md-5">
                    {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Password</label>
                <div class="col-md-5">
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Phone</label>
                <div class="col-md-5">
                    {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Phone']) }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 offset-md-2">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                    </form>
                    <a href="{{ route('mitra.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
