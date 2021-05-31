<div class="sb-sidenav-menu-heading"></div>

@if (Auth::User()->hasRole('super_admin'))

<a class="nav-link" href="{{ route('super_admin.dashboard') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Dashboard
</a>

<div class="sb-sidenav-menu-heading">User Access Control</div>

<a class="nav-link collapsed" href="{{ route('user.index') }} ">
    <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
    Kelola Akses Pengguna
</a>

<div class="sb-sidenav-menu-heading">Master Kegiatan</div>

<a class="nav-link collapsed" href="{{ route('pengumuman') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-newspaper fa-fw"></i></div>
    Kelola Pengumuman
</a>

<a class="nav-link collapsed" href="{{ route('jenis_kegiatan.index') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-folder-open fa-fw"></i></div>
    Kelola Program Kegiatan
</a>


<div class="sb-sidenav-menu-heading">Master Jurusan</div>

<a class="nav-link collapsed" href="{{ route('jurusan.index') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-university fa-fw"></i></div>
    Kelola Data Jurusan
</a>
<a class="nav-link collapsed" href="{{ route('prodi.index') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-graduation-cap fa-fw"></i></div>
    Kelola Data Prodi
</a>

@elseif (Auth::User()->hasRole('supervisor'))

<a class="nav-link" href="{{ route('supervisor.dashboard') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Dashboard
</a>

<div class="sb-sidenav-menu-heading">Supervisi Pengguna</div>

<a class="nav-link collapsed" href="{{ route('dosen.index') }} ">
    <div class="sb-nav-link-icon"><i class="fas fa-user-graduate fa-fw"></i></div>
    Kelola Data Dosen
</a>
<a class="nav-link collapsed" href="{{ route('mahasiswa.index') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
    Kelola Data Mahasiswa
</a>
<a class="nav-link collapsed" href="{{ route('mitra.index') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-landmark fa-fw"></i></div>
    Kelola Data Mitra
</a>


@elseif (Auth::User()->hasRole('admin_prodi'))

<a class="nav-link" href="{{ route('admin_prodi.dashboard') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Dashboard
</a>

<div class="sb-sidenav-menu-heading">Master Kegiatan </div>

<a class="nav-link collapsed" href="{{ route('pengumuman') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-newspaper fa-fw"></i></div>
    Kelola Pengumuman
</a>

<a class="nav-link collapsed" href="{{ route('magang.index') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-folder-open fa-fw"></i></div>
    Kelola Program Kegiatan
</a>

<div class="sb-sidenav-menu-heading">Master Data Pengguna</div>

<a class="nav-link collapsed" href="{{ route('dosen.index') }} ">
    <div class="sb-nav-link-icon"><i class="fas fa-user-graduate fa-fw"></i></div>
    Kelola Data Dosen
</a>
<a class="nav-link collapsed" href="{{ route('mahasiswa.index') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
    Kelola Data Mahasiswa
</a>
<a class="nav-link collapsed" href="{{ route('mitra.index') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-landmark fa-fw"></i></div>
    Kelola Data Mitra
</a>

@endif
