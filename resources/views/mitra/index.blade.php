@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            <a href="{{ route('mitra.create') }}" class="btn btn-primary">Tambah Data</a>
            <hr>
            @include('alert')
            <div class="table-responsive">
                <table class="table table-bordered" id="table-mitra">
                    <thead>
                        <tr>
                            <th>Nama Mitra</th>
                            <th>Divisi Mitra</th>
                            <th>Pamong Mitra</th>
                            <th class='text-center' width="16.8%">Action</th>
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
    <script>
        $(function() {
            $('#table-mitra').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mitra.list') }}",
                columns: [{
                        data: 'nama_mitra',
                        name: 'nama_mitra'
                    },
                    {
                        data: 'divisi_mitra',
                        name: 'divisi_mitra'
                    },
                    {
                        data: 'pamong_mitra',
                        name: 'pamong_mitra'
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
