@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Supervisor</div>

                    <div class="card-body">
                        {{ Form::open(['url' => '/supervisor']) }}
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right">Nama Pengguna</label>
                            <div class="col-md-5">
                                {{ Form::text('nama_pengguna', null, ['class' => 'form-control', 'placeholder' => 'Nama Pengguna']) }}
                            </div>
                        </div>
                        
                        @include('supervisor.form')
                        
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                                </form>
                                <a href="{{ route('supervisor.index') }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
