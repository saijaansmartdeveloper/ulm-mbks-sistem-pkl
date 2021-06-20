@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')

<hr>

<!-- Announcement -->
@if ($announcement != null)
<div class="row" id="announcement">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-6">Pengumuman</div>
                    <div class="col-6 text-right"><a href="#" onclick="close_ann()"><span class="fas fa-times"></span></a></div>
                </div>
            </div>
            @foreach ($announcement as $key => $item)
            <div class="card-body">{!! $item->content_pengumuman !!}</div>
            @endforeach
            <div class="card-footer py-1 pt-2">
                <div class="row justify-content-end">
                    {{ $announcement->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif

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
@if ($announcement != null)
<script>
    function close_ann()
    {
        $("#announcement").remove();
    }
</script>
@endif
@endsection
