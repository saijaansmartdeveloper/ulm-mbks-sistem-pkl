@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            <a href="{{ route('jenis_kegiatan.create') }}" class="btn btn-primary">Tambah Data</a>
            <hr>
            @include('alert')
            <div class="table-responsive">
                <table class="table table-bordered" id="table-jenis-kegiatan">
                    <thead>
                        <tr>
                            <th>Kode Jenis Kegiatan</th>
                            <th>Nama Jenis Kegiatan</th>
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
            $('#table-jenis-kegiatan').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('jenis_kegiatan.list') }}",
                columns: [{
                        data: 'kode_jenis_kegiatan',
                        name: 'kode_jenis_kegiatan'
                    },
                    {
                        data: 'nama_jenis_kegiatan',
                        name: 'nama_jenis_kegiatan'
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
