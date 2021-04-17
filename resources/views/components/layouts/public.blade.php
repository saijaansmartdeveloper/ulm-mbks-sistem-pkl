@props([
    'title' => ''
])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>
        {{ (empty($title)) ? config('app.name') : $title . ' - ' . config('app.name') }}
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bursa Kerja Khusus {{ config('app.name') }}" />
    <meta name="keywords" content="Bursa Kerja Khusus {{ config('app.name') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @include('components._css')

</head>
<body>

<div class="wrapper">
    <header>
        <div class="container">
            <div class="header-data">
                <div class="logo">
                    <a href="{{ '/dashboard' }}" title=""><img src="{{ asset('public_assets/images/logo.png') }}" alt=""></a>
                </div><!--logo end-->
                <nav>
                    {{--                        <ul>--}}
                    {{--                            <li>--}}
                    {{--                                <a href="index.html" title="">--}}
                    {{--                                    <span>--}}
                    {{--                                        <i class="fa fa-home "></i>--}}
                    {{--                                    </span>--}}
                    {{--                                    Home--}}
                    {{--                                </a>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                </nav><!--nav end-->
                <div class="menu-btn">
{{--                    <a href="#" title=""><i class="fa fa-bars"></i></a>--}}
                </div><!--menu-btn end-->
                @auth('company')
                    <div class="user-account">
                        <div class="user-info">
                            <img
                                style="max-width: 30px; background-color: #fff"
                                src="{{ (!empty(auth('company')->user()->logo_perusahaan)) ? Storage::disk('public_uploads')->url(auth('company')->user()->logo_perusahaan) : 'https://fakeimg.pl/170x170?text=170x170 Logo' }}" alt="">
                            <a href="#" title="">
                                {{ auth('company')->user()->nama_perusahaan ?? auth('alumni')->user()->nama_alumni }}
                            </a>
                            <i class="la la-sort-down"></i>
                        </div>
                        <div class="user-account-settingss">
                            <h3 class="tc"><a href="{{ route('public.auth.logout') }}" title="">Logout</a></h3>
                        </div><!--user-account-settingss end-->
                    </div>
                @elseauth('alumni')
                    <div class="user-account">
                        <div class="user-info">
                            <img
                                style="max-width: 30px; background-color: #fff"
                                src="{{ 'https://fakeimg.pl/170x170?text=170x170 Logo' }}" alt="">
                            <a href="#" title="">
                                {{ auth('alumni')->user()->nama_alumnus }}
                            </a>
                            <i class="la la-sort-down"></i>
                        </div>
                        <div class="user-account-settingss">
                            <h3 class="tc"><a href="{{ route('public.alumni.profile', ['action' => 'edit']) }}" title="">Edit Profil</a></h3>
                            <h3 class="tc"><a href="{{ route('public.auth.logout') }}" title="">Logout</a></h3>
                        </div><!--user-account-settingss end-->
                    </div>
                @endauth
            </div><!--header-data end-->
        </div>
    </header>

    @isset($cover)
        <section class="cover-sec">
            {{ $cover }}
        </section>
        <style>
            .user-pro-img {
                float: left;
                width: 100%;
                text-align: center;
                margin-bottom: 28px;
                margin-top: -95px;
                position: relative;
            }
        </style>
    @endif

    <main>
        <div class="main-section">
            {{ $slot }}
        </div>
    </main>

</div>

@include('components._js')

</body>
</html>

