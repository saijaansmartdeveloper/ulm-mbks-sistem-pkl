@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            <a href="{{ route('admin_prodi.create') }}" class="btn btn-primary">Tambah Data</a>
            <hr>
            @include('alert')
            <table class="table table-bordered" id="table-admin-prodi">
                <thead>
                    <tr>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Prodi</th>
                        <th class='text-center' width="85">Action</th>
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
        $(function() {
            $('#table-admin-prodi').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin_prodi.list') }}",
                columns: [{
                        data: 'nama_pengguna',
                        name: 'nama_pengguna'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'jurusan.nama_jurusan',
                        name: 'jurusan.nama_jurusan'
                    },
                    {
                        data: 'prodi.nama_prodi',
                        name: 'prodi.nama_prodi'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });

    </script>
@endsection
