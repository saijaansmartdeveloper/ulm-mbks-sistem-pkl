@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Admin Prodi</div>

                    <div class="card-body">

                        <a href="/admin_prodi/create" class="btn btn-primary">Tambah Data</a>
                        <hr>
                        @include('alert')
                        <table class="table table-bordered" id="table-admin-prodi">
                            <thead>
                                <tr>
                                    <th>Nama Pengguna</th>
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
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $('#table-admin-prodi').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/admin_prodi/list",
                columns: [{
                        data: 'nama_pengguna',
                        name: 'nama_pengguna'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'jurusan_uuid',
                        name: 'jurusan_uuid'
                    },
                    {
                        data: 'prodi_uuid',
                        name: 'prodi_uuid'
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
@endpush
