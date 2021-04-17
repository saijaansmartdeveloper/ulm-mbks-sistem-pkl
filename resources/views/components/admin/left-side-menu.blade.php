<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('logoulm.png') }}" alt="" srcset="" style="width: 120px">
            </div>
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{ route('home') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Master Data</div>
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
                <a class="nav-link collapsed" href="">
                    <div class="sb-nav-link-icon"><i class="fas fa-building fa-fw"></i></div>
                    Mitra
                </a>
                <a class="nav-link collapsed" href="">
                    <div class="sb-nav-link-icon"><i class="fas fa-building fa-fw"></i></div>
                    Kegiatan
                </a>
                <a class="nav-link collapsed" href="">
                    <div class="sb-nav-link-icon"><i class="fas fa-building fa-fw"></i></div>
                    Mahasiswa
                </a>
            @endif

            {{-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Pages
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a> --}}
            {{-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                        Authentication
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="login.html">Login</a>
                            <a class="nav-link" href="register.html">Register</a>
                            <a class="nav-link" href="password.html">Forgot Password</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                        Error
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="401.html">401 Page</a>
                            <a class="nav-link" href="404.html">404 Page</a>
                            <a class="nav-link" href="500.html">500 Page</a>
                        </nav>
                    </div>
                </nav>
            </div> --}}
            {{-- <div class="sb-sidenav-menu-heading">Addons</div>
            <a class="nav-link" href="charts.html">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Charts
            </a>
            <a class="nav-link" href="tables.html">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tables
            </a> --}}
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->nama_pengguna ?? '' }}
    </div>
</nav>
