@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @include('alert')
            {{-- <a href="{{ route('supervisor.create') }}" class="btn btn-primary">Tambah Data</a> --}}
            {{-- <hr> --}}
            <div class="table-responsive">
                <table class="table table-bordered" id="table-mahasiswa">
                    <thead>
                        <tr>
                            <th width='20%'>NIM Mahasiswa</th>
                            <th>Nama Mahasiswa</th>
                            <th class='text-center' width="85">Action</th>
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
            $('#table-mahasiswa').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mahasiswa.list') }}",
                columns: [{
                        data: 'nim_mahasiswa',
                        name: 'nim_mahasiswa'
                    },
                    {
                        data: 'nama_mahasiswa',
                        name: 'nama_mahasiswa'
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
