@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')

    @include('alert')

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

