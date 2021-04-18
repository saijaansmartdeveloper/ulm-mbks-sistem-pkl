@if (Auth::User()->hasRole('super_admin'))
    <a class="nav-link collapsed" href="{{ route('supervisor.index') }} ">
        <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
        Supervisor
    </a>
    <a class="nav-link collapsed" href="{{ route('jurusan.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-building fa-fw"></i></div>
        Jurusan
    </a>
    <a class="nav-link collapsed" href="{{ route('prodi.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-building fa-fw"></i></div>
        Prodi
    </a>
    <a class="nav-link collapsed" href="{{ route('admin_prodi.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-building fa-fw"></i></div>
        Admin Prodi
    </a>
@endif

@if (Auth::User()->hasRole('admin_prodi'))
    <a class="nav-link collapsed" href="{{ route('dosen.index') }} ">
        <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
        Dosen
    </a>
    <a class="nav-link collapsed" href="{{ route('jenis_kegiatan.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-building fa-fw"></i></div>
        Jenis Kegiatan
    </a>
    <a class="nav-link collapsed" href="{{ route('magang.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-building fa-fw"></i></div>
        Magang
    </a>
    <a class="nav-link collapsed" href="">
        <div class="sb-nav-link-icon"><i class="fas fa-building fa-fw"></i></div>
        Mitra
    </a>

    <a class="nav-link collapsed" href="">
        <div class="sb-nav-link-icon"><i class="fas fa-building fa-fw"></i></div>
        Mahasiswa
    </a>
@endif
