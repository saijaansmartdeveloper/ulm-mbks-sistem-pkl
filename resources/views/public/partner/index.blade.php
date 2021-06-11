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
                    <a href="#" class="text-white stretched-link">Detail Bimbingan Mahasiswa</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
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
                    <a href="#" class="text-white stretched-link">Detail Jurnal Bimbingan </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
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
                    <a href="#" class="text-white stretched-link">Detail Laporan Monev </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card bg-info border-0 shadow-sm text-white mb-4">
                <div class="card-body justify-content-between">
                    <i class="fas fa-tasks fa-2x"></i>
                    <h2 class="h2 float-right mb-0">{{ $data['persentase_jurnal'] ?? '0 %' }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="#" class="text-white stretched-link">Persentase Jurnal Diperiksa</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card bg-warning border-0 shadow-sm text-white mb-4" style="background: #fd7e14 !important;">
                <div class="card-body justify-content-between">
                    <i class="fas fa-handshake fa-2x"></i>
                    <h2 class="h2 float-right mb-0">{{ $data['persentase_monev'] ?? '0 %' }}</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="#" class="text-white stretched-link">Persentase Monitoring dan Evaluasi Dilakukan</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card-header">Table Jurnal Terakhir Update</div>
            <table class="table table-hover table-striped">
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Mitra</th>
                    <th>Tanggal Jurnal</th>
                    <th>Aksi</th>
                </tr>
                @forelse($data['journals'] as $key => $item)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center"><i>Jurnal Belum Tersedia</i></td>
                    </tr>
                @endforelse
            </table>
        </div>
        <div class="col-6">
            <div class="card-header">Table Monitoring Evaluasi</div>
            <table class="table table-hover table-striped">
                <tr>
                    <th>No</th>
                    <th>Mitra</th>
                    <th>Mahasiswa</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
                @forelse($data['monev'] as $key => $item)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center"><i>Kegiatan Monitoring dan Evaluasi Belum Ada</i></td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
@endsection
