@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            {{ Form::model($dosen, ['url' => 'dosen/' . $dosen->uuid, 'method' => 'put']) }}
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">NIP</label>
                <div class="col-md-5">
                    {{ Form::text('nip_dosen', null, ['class' => 'form-control', 'placeholder' => 'NIP']) }}
                </div>
            </div>

            @include('dosen.form')

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
