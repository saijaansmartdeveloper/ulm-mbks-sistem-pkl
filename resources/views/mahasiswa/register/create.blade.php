<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('register_mahasiswa/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('register_mahasiswa/css/style.css') }}">


    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet" />

    <script src="{{ asset('sbadmin/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('select2/js/select2.min.js') }}"></script>
    <style>
        .select2-selection__rendered {
            line-height: 48px !important;
            margin-left: 10px;
        }

        .select2-container .select2-selection--single {
            height: 48px !important;
        }

        .select2-selection__arrow {
            height: 48px !important;
        }
    </style>

</head>

<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    {{ Form::open(['url' => route('mahasiswa.register.store'), 'enctype' => 'multipart/form-data']) }}
                    {{-- <form method="POST" id="signup-form" class="signup-form"> --}}
                        <h2 class="form-title">{{ $title }}</h2>
                        @include('alert')
                        <div class="form-group">
                            {{ Form::text('nim_mahasiswa', null, ['class' => 'form-input', 'placeholder' => 'NIM
                            ']) }}

                        </div>
                        <div class="form-group">
                            {{ Form::text('nama_mahasiswa', null, ['class' => 'form-input', 'placeholder' => 'Nama
                            ']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::text('phone', null, ['class' => 'form-input', 'placeholder' => 'No. Telpon
                            ']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::email('email', null, ['class' => 'form-input', 'placeholder' => 'Email']) }}

                        </div>
                        <div class="form-group">
                            {{ Form::password('password', ['class' => 'form-input', 'placeholder' => 'Password']) }}

                        </div>
                        <div class="form-group">
                            {{ Form::select('prodi_uuid', $prodi, null, ['placeholder' => '-- Pilih Program Studi --',
                            'id' => 'prodi', 'class' => 'form-input prodi-select2', 'style' =>
                            'height:100px!important']) }}
                        </div>
                        <div class="form-group">
                            <label for="foto_mahasiswa">Foto Mahasiswa : </label>
                            {{ Form::file('foto_mahasiswa', null, ['class' => 'form-input', 'accept' =>
                            'image/png,image/gif,image/jpeg']) }}
                        </div>
                        {{-- <div class="form-group">
                            <input type="password" class="form-input" name="re_password" id="re_password"
                                placeholder="Ulangi Password" />
                        </div> --}}
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Daftar" />
                        </div>
                    </form>
                    <p class="loginhere">
                        Sudah punya akun? <a href="{{ route('public.user.form_login') }}"
                            class="loginhere-link">Masuk</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{ asset('register_mahasiswa/js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.prodi-select2').select2();
        });

    </script>
</body>

</html>