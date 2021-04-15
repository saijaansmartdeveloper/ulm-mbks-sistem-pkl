@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dosen</div>

                    <div class="card-body">

                        <a href="/dosen/create" class="btn btn-primary">Tambah Data</a>
                        <hr>
                        @include('alert')
                        <table class="table table-bordered" id="table-dosen">
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
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $('#table-dosen').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/dosen/list",
                columns: [{
                        data: 'nip_dosen',
                        name: 'nip_dosen'
                    },
                    {
                        data: 'nama_dosen',
                        name: 'nama_dosen'
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
