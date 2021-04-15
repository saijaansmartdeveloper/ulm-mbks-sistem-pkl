@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Supervisor</div>

                    <div class="card-body">

                        <a href="/supervisor/create" class="btn btn-primary">Tambah Data</a>
                        <hr>
                        <table class="table table-bordered" id="table_supervisor">
                            <thead>
                                <tr>
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
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
            $('#table_supervisor').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/supervisor/list",
                columns: [{
                        data: 'nama_pengguna',
                        name: 'nama_pengguna'
                    },
                    {
                        data: 'email',
                        name: 'email'
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
