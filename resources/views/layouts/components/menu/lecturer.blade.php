<div class="sb-sidenav-menu-heading">Core</div>

<a class="nav-link" href="{{ route('public.lecturer.index') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Dashboard
</a>

<div class="sb-sidenav-menu-heading">Master Data</div>

<a class="nav-link collapsed" href="{{ route('public.activity.guidance', ['guard' => 'lecturer']) }} ">
    <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
    Daftar Mahasiswa
</a>

<a class="nav-link collapsed" href="{{ route('public.laporan-monev.index') }} ">
    <div class="sb-nav-link-icon"><i class="fas fa-handshake fa-fw"></i></div>
    Laporan Kegiatan
</a>
