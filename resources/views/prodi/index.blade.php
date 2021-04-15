@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Prodi</div>

                    <div class="card-body">

                        <a href="/prodi/create" class="btn btn-primary">Tambah Data</a>
                        <hr>
                        @include('alert')
                        <table class="table table-bordered" id="table-prodi">
                            <thead>
                                <tr>
                                    <th>Kode Prodi</th>
                                    <th>Nama Prodi</th>
                                    <th>Jurusan</th>
                                    <th class ='text-center'width="80">Action</th>
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
            $('#table-prodi').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/prodi/list",
                columns: [{
                        data: 'kode_prodi',
                        name: 'kode_prodi'
                    },
                    {
                        data: 'nama_prodi',
                        name: 'nama_prodi'
                    },
                    {
                        data: 'jurusan_uuid',
                        name: 'jurusan_uuid'
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
