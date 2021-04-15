@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Jurusan</div>

                    <div class="card-body">

                        <a href="/jurusan/create" class="btn btn-primary">Tambah Data</a>
                        <hr>
                        @include('alert')
                        <table class="table table-bordered" id="table-jurusan">
                            <thead>
                                <tr>
                                    <th>Kode Jurusan</th>
                                    <th>Nama Jurusan</th>
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
            $('#table-jurusan').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/jurusan/list",
                columns: [{
                        data: 'kode_jurusan',
                        name: 'kode_jurusan'
                    },
                    {
                        data: 'nama_jurusan',
                        name: 'nama_jurusan'
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
