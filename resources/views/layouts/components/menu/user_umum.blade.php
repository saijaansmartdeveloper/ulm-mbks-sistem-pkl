@if (Auth::User()->hasRole('super_admin'))
    <div class="sb-sidenav-menu-heading">Core</div>

    <a class="nav-link" href="{{ route('super_admin.dashboard') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Dashboard
    </a>

    <div class="sb-sidenav-menu-heading">Master Data</div>
    <a class="nav-link collapsed" href="{{ route('user.index') }} ">
        <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
        Pengguna
    </a>
    <a class="nav-link collapsed" href="{{ route('jurusan.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-university fa-fw"></i></div>
        Jurusan
    </a>
    <a class="nav-link collapsed" href="{{ route('prodi.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-graduation-cap fa-fw"></i></div>
        Program Studi
    </a>
    <a class="nav-link collapsed" href="{{ route('mahasiswa.superadmin.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
        Mahasiswa
    </a>
    <a class="nav-link collapsed" href="{{ route('pengumuman.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-newspaper fa-fw"></i></div>
        Pengumuman
    </a>
    <a class="nav-link collapsed" href="{{ route('jenis_kegiatan.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-folder-open fa-fw"></i></div>
        Jenis Kegiatan
    </a>
@endif

@if (Auth::User()->hasRole('admin_prodi'))
    <div class="sb-sidenav-menu-heading">Core</div>

    <a class="nav-link" href="{{ route('admin_prodi.dashboard') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Dashboard
    </a>

    <div class="sb-sidenav-menu-heading">Master Data</div>
    <a class="nav-link collapsed" href="{{ route('dosen.index') }} ">
        <div class="sb-nav-link-icon"><i class="fas fa-user-graduate fa-fw"></i></div>
        Dosen
    </a>
    <a class="nav-link collapsed" href="{{ route('mahasiswa.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
        Mahasiswa
    </a>
    <a class="nav-link collapsed" href="{{ route('mitra.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-landmark fa-fw"></i></div>
        Mitra
    </a>
    <a class="nav-link collapsed" href="{{ route('magang.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-folder-open fa-fw"></i></div>
        Kegiatan
    </a>


    {{-- <a class="nav-link collapsed" href="{{ route('pengumuman.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-building fa-fw"></i></div>
        Announcement
    </a> --}}
@endif
