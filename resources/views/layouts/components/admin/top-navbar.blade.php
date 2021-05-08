<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="#">MBKM</a>

    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </div>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                @if ($guard == 'student')
                    <a class="dropdown-item" href="{{ route('public.student.show', ['id' => ($user->uuid ?? '404')]) }}">Profile</a>
                    <a class="dropdown-item" href="{{ route('public.student.edit', ['id' => ($user->uuid ?? '404')]) }}">Ganti Profile</a>
                @elseif ($guard == 'lecturer')
                    <a class="dropdown-item" href="{{ route('public.lecturer.show', ['id' => ($user->uuid ?? '404')]) }}">Profile</a>
                    <a class="dropdown-item" href="{{ route('public.lecturer.edit', ['id' => ($user->uuid ?? '404')]) }}">Ganti Profile</a>
                @elseif ($guard == 'partner')
                    <a class="dropdown-item" href="{{ route('public.partner.show', ['id' => ($user->uuid ?? '404')]) }}">Profile</a>
                    <a class="dropdown-item" href="{{ route('public.partner.edit', ['id' => ($user->uuid ?? '404')]) }}">Ganti Profile</a>
                @endif
                <div class="dropdown-divider"></div>

                <form method="POST" action="{{ route('logout') }}" onclick="event.preventDefault();
                this.closest('form').submit();">
                    @csrf
                    <a class="dropdown-item" href="#">Logout</a>
                </form>

            </div>
        </li>
    </ul>
</nav>
