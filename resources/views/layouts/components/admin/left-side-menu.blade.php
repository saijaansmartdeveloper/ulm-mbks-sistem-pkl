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
            @auth('web')
                @include('layouts.components.menu.user_umum')
            @endauth

            @auth('lecturer')
                @include('layouts.components.menu.lecturer')
            @endauth
            
            @auth('student')
                @include('layouts.components.menu.student')
            @endauth

        </div>
    </div>
    {{-- <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->nama_pengguna ?? '' }}
    </div> --}}
</nav>
