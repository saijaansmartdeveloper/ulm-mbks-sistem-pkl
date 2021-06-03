@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')

<hr>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card bg-success border-0 shadow-sm text-white mb-4">
            <div class="card-body justify-content-between">
                <i class="fas fa-users fa-2x"></i>
                <h2 class="h2 float-right mb-0">{{ $data['jumlah_supervisor'] ?? '0' }}</h2>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="text-white stretched-link">Pengguna Supervisor</span>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card bg-info border-0 shadow-sm text-white mb-4">
            <div class="card-body justify-content-between">
                <i class="fas fa-users fa-2x"></i>
                <h2 class="h2 float-right mb-0">{{ $data['jumlah_admin_prodi'] ?? '0' }}</h2>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="text-white stretched-link">Pengguna Admin Prodi</span>
            </div>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card bg-primary border-0 shadow-sm text-white mb-4">
            <div class="card-body justify-content-between">
                <i class="fas fa-graduation-cap fa-2x"></i>
                <h2 class="h2 float-right mb-0">{{ $data['jumlah_lecturer'] ?? '0' }}</h2>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="text-white stretched-link">Dosen MBKM</span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card bg-warning border-0 shadow-sm text-white mb-4">
            <div class="card-body justify-content-between">
                <i class="fas fa-user-graduate fa-2x"></i>
                <h2 class="h2 float-right mb-0">{{ $data['jumlah_student'] ?? '0' }}</h2>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="text-white stretched-link">Mahasiswa MBKM</span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card bg-danger border-0 shadow-sm text-white mb-4">
            <div class="card-body justify-content-between">
                <i class="fas fa-building fa-2x"></i>
                <h2 class="h2 float-right mb-0">{{ $data['jumlah_partner'] ?? '0' }}</h2>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="text-white stretched-link">Mitra MBKM</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card card bg-secondary border-0 shadow-sm text-white mb-4">
            <div class="card-body justify-content-between">
                <i class="fas fa-school fa-2x"></i>
                <h2 class="h2 float-right mb-0">{{ $data['jumlah_jurusan'] ?? '0' }}</h2>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('jurusan.index') }}" class="text-white stretched-link">Jumlah Program Studi
                </a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card card bg-secondary border-0 shadow-sm text-white mb-4">
            <div class="card-body justify-content-between">
                <i class="fas fa-school fa-2x"></i>
                <h2 class="h2 float-right mb-0">{{ $data['jumlah_prodi'] ?? '0' }}</h2>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('prodi.index') }}" class="text-white stretched-link">Daftar Program Studi
                </a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')

@endsection
