@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            <a href="{{ route('dosen.create') }}" class="btn btn-primary">Tambah Data</a>
            <hr>
            @include('alert')
            <div class="table-responsive">
                <table class="table table-bordered" id="table-dosen">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Prodi</th>
                            <th class='text-center'>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <link href="{{ asset('datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="{{ asset('datatables/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sweetalert/alert.js') }}"></script>

    <script>
        $(function() {
            $('#table-dosen').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dosen.list') }}",
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
                        data: 'prodi.nama_prodi',
                        defaultContent: '-',
                        name: 'prodi.nama_prodi'
                    },
                    {
                        data: 'action',
                        className: 'text-center',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });

    </script>
@endsection
