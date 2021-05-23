@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
<hr>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card bg-success border-0 shadow-sm text-white mb-4" style="background: #1e7e34 !important;">
                <div class="card-body justify-content-between">
                    <i class="fas fa-users fa-2x"></i>
                    <h2 class="h2 float-right mb-0">{{ $data['jumlah_pengguna'] ?? '0' }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('user.index') }}" class="text-white stretched-link">Detail Pengguna</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card bg-danger border-0 shadow-sm text-white mb-4" style="background: #a71d2a !important;">
                <div class="card-body justify-content-between">
                    <i class="fas fa-university fa-2x"></i>
                    <h2 class="h2 float-right mb-0">{{ $data['jumlah_jurusan'] ?? '0' }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('jurusan.index') }}" class="text-white stretched-link">Detail Jurusan </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card bg-primary border-0 shadow-sm text-white mb-4">
                <div class="card-body justify-content-between">
                    <i class="fas fa-graduation-cap fa-2x"></i>
                    <h2 class="h2 float-right mb-0">{{ $data['jumlah_prodi'] ?? '0' }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('prodi.index') }}" class="text-white stretched-link">Detail Program Studi
                    </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

@endsection
