<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('content-header')</title>

    <link href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/jquery-ui/jquery-ui.structure.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('sbadmin/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
    </link>

    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/css/evo-calendar.min.css" />
    <style>
        .select2-selection__rendered {
            line-height: 40px !important;
            margin-left: 10px;
        }

        .select2-container .select2-selection--single {
            height: 40px !important;
        }

        .select2-selection__arrow {
            height: 40px !important;
        }

    </style>

    <script src="{{ asset('sbadmin/js/all.min.js') }}" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    @include('layouts.components.admin.top-navbar')

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('layouts.components.admin.left-side-menu')
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
            @include('layouts.components.admin.bottom-navbar-menu')
        </div>
    </div>

    <script src="{{ asset('sbadmin/js/jquery-3.5.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>

    <script src="{{ asset('sbadmin/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/js/evo-calendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>


    <script src="{{ asset('sbadmin/js/scripts.js') }}"></script>
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>


    @yield('js')

</body>

</html>
