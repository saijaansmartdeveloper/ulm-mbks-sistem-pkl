@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-student">
                    <thead>
                        <tr>
                            <th>NIM Mahasiswa</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tempat Magang</th>
                            <th class='text-center' width="60">Action</th>
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
            $('#table-student').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('public.lecturer.student_guidance.list') }}",
                columns: [{
                        data: 'student.nim_mahasiswa',
                        name: 'student.nim_mahasiswa'
                    },
                    {
                        data: 'student.nama_mahasiswa',
                        name: 'student.nama_mahasiswa'
                    },
                    {
                        data: 'partner.nama_mitra',
                        name: 'partner.nama_mitra'
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
