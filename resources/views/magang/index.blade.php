@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            <a href="{{ route('magang.create') }}" class="btn btn-primary">Tambah Data</a>
            <hr>
            @include('alert')
            <table class="table table-bordered" id="table-jenis-kegiatan">
                <thead>
                    <tr>
                        <th>Jenis Kegiatan</th>
                        <th>Mulai Magang</th>
                        <th>Akhir Magang</th>
                        <th>Lama Magang</th>
                        {{-- <th>Status Magang</th> --}}
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
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $('#table-jenis-kegiatan').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('magang.list') }}",
                columns: [{
                        data: 'jenis_kegiatan.nama_jenis_kegiatan',
                        name: 'jenis_kegiatan.nama_jenis_kegiatan'
                    },
                    {
                        data: 'mulai_magang',
                        name: 'mulai_magang'
                    },
                    {
                        data: 'akhir_magang',
                        name: 'akhir_magang'
                    },
                    {
                        data: 'lama_magang',
                        name: 'lama_magang'
                    },
                    // {
                    //     data: 'status_magang',
                    //     name: 'status_magang'
                    // },
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
