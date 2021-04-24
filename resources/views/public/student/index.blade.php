@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')
    @include('alert')
    <div class="card py-4">
        <div class="card-body">
            <table class="table table-bordered" id="table-student">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Prodi</th>
                        <th class='text-center' width="80">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        {{--$(function() {--}}
        {{--    $('#table-student').DataTable({--}}
        {{--        processing: true,--}}
        {{--        serverSide: true,--}}
        {{--        ajax: "{{ route('mahasiswa.list') }}",--}}
        {{--        columns: [{--}}
        {{--            data: 'nim_mahasiswa',--}}
        {{--            name: 'nim_mahasiswa'--}}
        {{--        },--}}
        {{--            // {--}}
        {{--            //     data: 'nama_dosen',--}}
        {{--            //     name: 'nama_dosen'--}}
        {{--            // },--}}
        {{--            // {--}}
        {{--            //     data: 'email',--}}
        {{--            //     name: 'email'--}}
        {{--            // },--}}
        {{--            // {--}}
        {{--            //     data: 'jurusan_uuid',--}}
        {{--            //     name: 'jurusan_uuid'--}}
        {{--            // },--}}
        {{--            // {--}}
        {{--            //     data: 'prodi_uuid',--}}
        {{--            //     name: 'prodi_uuid'--}}
        {{--            // },--}}
        {{--            {--}}
        {{--                data: 'action',--}}
        {{--                name: 'action',--}}
        {{--                orderable: true,--}}
        {{--                searchable: true--}}
        {{--            },--}}
        {{--        ]--}}
        {{--    });--}}

        {{--});--}}

    </script>
@endsection
