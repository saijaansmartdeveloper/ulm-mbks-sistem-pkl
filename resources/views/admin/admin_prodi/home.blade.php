@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')
    <hr>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card bg-success border-0 shadow-sm text-white mb-4" style="background: #1e7e34 !important;">
                <div class="card-body justify-content-between">
                    <i class="fas fa-user-graduate fa-2x"></i>
                    <h2 class="h2 float-right mb-0">{{ $data['jumlah_dosen'] ?? '0' }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('dosen.index') }}" class="text-white stretched-link">Detail Dosen</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card bg-danger border-0 shadow-sm text-white mb-4" style="background: #a71d2a !important;">
                <div class="card-body justify-content-between">
                    <i class="fas fa-users fa-2x"></i>
                    <h2 class="h2 float-right mb-0">{{ $data['jumlah_mahasiswa'] ?? '0' }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('mahasiswa.index') }}" class="text-white stretched-link">Detail Mahasiswa </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card bg-primary border-0 shadow-sm text-white mb-4">
                <div class="card-body justify-content-between">
                    <i class="fas fa-landmark fa-2x"></i>
                    <h2 class="h2 float-right mb-0">{{ $data['jumlah_mitra'] ?? '0' }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('mitra.index') }}" class="text-white stretched-link">Detail Mitra
                    </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card bg-warning border-0 shadow-sm text-white mb-4">
                <div class="card-body justify-content-between">
                    <i class="fas fa-tasks fa-2x"></i>
                    <h2 class="h2 float-right mb-0">{{ $data['jumlah_mahasiswa_kegiatan'] ?? '0' }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('mitra.index') }}" class="text-white stretched-link">Program Kegiatan
                    </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
@endsection
@section('js')

@endsection
