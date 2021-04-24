@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            <a href="{{ route('public.monev.create') }}" class="btn btn-primary">Tambah Data</a>
            <hr>
            <table class="table table-bordered" id="table-monev">
                <thead>
                    <tr>
                        <th>Catatan</th>
                        <th>Tanggal</th>
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
    <link href="{{ asset('datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="{{ asset('datatables/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $('#table-monev').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('public.monev.list') }}",
                columns: [{
                        data: 'catatan_monev',
                        name: 'catatan_monev'
                    },
                    {
                        data: 'tanggal_monev',
                        name: 'tanggal_monev'
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
