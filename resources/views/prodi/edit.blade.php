@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Prodi</div>

                    <div class="card-body">
                        @include('validation')
                        {{ Form::model($prodi,['url' => 'prodi/'. $prodi->uuid, 'method' => 'put']) }}
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right">Kode Prodi</label>
                            <div class="col-md-5">
                                {{ Form::text('kode_prodi', null, ['class' => 'form-control', 'placeholder' => 'Kode Prodi']) }}
                            </div>
                        </div>
                        
                        @include('prodi.form')
                        
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                                </form>
                                <a href="{{ route('prodi.index') }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
