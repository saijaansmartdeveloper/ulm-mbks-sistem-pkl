@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')

    @include('alert')

    <hr>

    <div class="row">
        <div class="col-4">
            <div class="card bg-success border-0 shadow-sm text-white mb-4" style="background: #1e7e34 !important;">
                <div class="card-body justify-content-between">
                    <i class="fas fa-users fa-2x"></i>
                    <h2 class="h2 float-right mb-0">{{ $data['jumlah_bimbingan'] ?? '0' }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white stretched-link">Detail Bimbingan Mahasiswa</span>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-danger border-0 shadow-sm text-white mb-4" style="background: #a71d2a !important;">
                <div class="card-body justify-content-between">
                    <i class="fas fa-book fa-2x"></i>
                    <h2 class="h2 float-right mb-0">{{ $data['jumlah_jurnal'] ?? '0' }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white stretched-link">Detail Jurnal Bimbingan </span>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card bg-primary border-0 shadow-sm text-white mb-4" >
                <div class="card-body justify-content-between">
                    <i class="fas fa-file fa-2x"></i>
                    <h2 class="h2 float-right mb-0">{{ $data['jumlah_monev'] ?? '0' }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white stretched-link">Detail Laporan Kegiatan </span>
                </div>
            </div>
        </div>
    </div>

@endsection
