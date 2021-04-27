@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            @if ($data == null)
                {{ Form::open(['url' => route('dosen.store')]) }}
            @else
                {{ Form::model($data, ['url' => route('dosen.update', ['id' => $data->uuid]), 'method' => 'put']) }}
            @endif

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">NIP</label>
                <div class="col-md-5">
                    {{ Form::text('nip_dosen', null, ['class' => 'form-control', 'placeholder' => 'NIP']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Nama</label>
                <div class="col-md-5">
                    {{ Form::text('nama_dosen', null, ['class' => 'form-control', 'placeholder' => 'Nama']) }}
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
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                </div>
            </div>


            <div class="form-group row">
                <div class="col-md-6 offset-md-2">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                    </form>
                    <a href="{{ route('dosen.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
