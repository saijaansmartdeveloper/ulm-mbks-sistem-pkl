<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('content-header')</title>

        <link href="{{ asset('sbadmin/css/styles.css') }}" rel="stylesheet" />
        
        <script src="{{ asset('sbadmin/js/all.min.js') }}" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        @include('components.admin.top-navbar')

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('components.admin.left-side-menu')
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4 mb-4">@yield('content-header')</h1>

                        {{-- <ol class="breadcrumb mb-4">
                            @if ($breadcrumb ?? false)
                                @forelse ($breadcrumb as $item)
                                    <li class="breadcrumb-item">{{ $item }}</li>
                                @empty

                                @endforelse
                            @endif
                        </ol> --}}
                        <div class="mb-4">
                            @yield('content')
                        </div>
                    </div>
                </main>
                @include('components/admin/bottom-navbar-menu')
            </div>
        </div>

        <script src="{{ asset('sbadmin/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('sbadmin/js/bootstrap.min.js') }}"></script>
        @yield('js')

        <script src="{{ asset('sbadmin/js/scripts.js') }}"></script>
    </body>
</html>
