<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}} - LOGIN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <style>
        :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: 0.8rem;
        }

        .login,

        .image {
            min-height: 100vh;
        }

        .animate-title {
            font-size: 3em;
            letter-spacing: 1px;
            font-weight: bold;
            /* opacity: 0.6; */
            /* color: rgb(59, 32, 140); */
            /* background: url('img/pattern-blue.png');
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: text 7.5s linear infinite; */
        }

        /* @keyframes text {
            from {
                background-position: 10% 10%;
            }

            to {
                background-position: 100% 100%;
            }
        } */

        .bg-image {
            background-image: url("{{asset('img/ulm-fkp.jpg')}}");
            background-size: cover;
            background-position: center;
        }

        .login-heading {
            font-weight: 300;
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
            border-radius: 2rem;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group>input,
        .form-label-group>label {
            padding: var(--input-padding-y) var(--input-padding-x);
            height: auto;
            border-radius: 2rem;
        }

        .form-label-group>label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0;
            /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            cursor: text;
            /* Match the input under the label */
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
            color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-moz-placeholder {
            color: transparent;
        }

        .form-label-group input::placeholder {
            color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
            padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
            padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown)~label {
            padding-top: calc(var(--input-padding-y) / 3);
            padding-bottom: calc(var(--input-padding-y) / 3);
            font-size: 12px;
            color: #777;
        }

        /* Fallback for Edge
        -------------------------------------------------- */

        @supports (-ms-ime-align: auto) {
            .form-label-group>label {
                display: none;
            }

            .form-label-group input::-ms-input-placeholder {
                color: #777;
            }
        }

        /* Fallback for IE
        -------------------------------------------------- */

        @media all and (-ms-high-contrast: none),
        (-ms-high-contrast: active) {
            .form-label-group>label {
                display: none;
            }

            .form-label-group input:-ms-input-placeholder {
                color: #777;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-8 bg-image"></div>
            <div class="col-md-8 col-lg-4">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                <img src="{{ asset('img/ULM-KampusMerdeka.png') }}" alt="" height="80px" class="mb-5">

                                <h1 class="mt-2 mb-4 text-center animate-title text-primary"><strong>SIBISA</strong>
                                    </h2>

                                    @include('alert')

                                    <form action="{{route('public.user.login')}}" method="post">
                                        @csrf
                                        <div class="form-label-group">
                                            <input name="email" type="email" id="inputEmail" class="form-control"
                                                placeholder="Masukan Email address" required autofocus>
                                            <label for="inputEmail">Email address</label>
                                        </div>

                                        <div class="form-label-group">
                                            <input name="password" type="password" id="inputPassword"
                                                class="form-control" placeholder="Masukan Password" required>
                                            <label for="inputPassword">Password</label>
                                        </div>

                                        <div class="form-label-group">
                                            {!! Form::select('type', ['lecturer' => 'Dosen', 'student' => 'Mahasiswa',
                                            'partner' => 'Mitra'], null, ['class' => 'form-control' ,'placeholder' =>
                                            'Masuk
                                            Sebagai', 'style' => 'border-radius: 2rem; padding-top: 14px;
                                            padding-bottom:
                                            12px; padding-left: 18px;']) !!}
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button
                                                class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2"
                                                type="submit">Masuk</button>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <a href="{{ route('mahasiswa.register') }}"
                                                class="btn btn-lg btn-danger btn-block btn-login text-uppercase font-weight-bold mb-2">Registrasi
                                                Mahasiswa</a>
                                        </div>

                                        <div class="text-center mb-2 mt-5">
                                            <a class="small text-secondary" href="{{ route('login') }}">Login Sebagai
                                                Admin
                                                Prodi</a>
                                        </div>

                                        <div class="text-center">
                                            <a class="small text-secondary" href="#">App Version {{
                                                config('app.version')
                                                }}</a>
                                        </div>
                                    </form>
                                    {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>