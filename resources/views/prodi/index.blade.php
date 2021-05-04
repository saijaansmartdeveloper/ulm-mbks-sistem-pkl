@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            <a href="{{ route('prodi.create') }}" class="btn btn-primary">Tambah Data</a>
            <hr>
            @include('alert')
            <div class="table-responsive">
                <table class="table table-bordered" id="table-prodi">
                    <thead>
                        <tr>
                            <th>Kode Prodi</th>
                            <th>Nama Prodi</th>
                            <th>Jurusan</th>
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
            $('#table-prodi').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('prodi.list') }}",
                columns: [{
                        data: 'kode_prodi',
                        name: 'kode_prodi'
                    },
                    {
                        data: 'nama_prodi',
                        name: 'nama_prodi'
                    },
                    {
                        data: 'jurusan.nama_jurusan',
                        defaultContent: '-',
                        name: 'jurusan.nama_jurusan'

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
