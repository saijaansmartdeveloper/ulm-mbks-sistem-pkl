<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('logoulm.png') }}" alt="" srcset="" style="width: 120px">
            </div>

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
