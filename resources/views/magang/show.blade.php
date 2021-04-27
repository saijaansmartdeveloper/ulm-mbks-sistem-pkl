@extends('layouts.admin')
@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            <h4>Mahasiswa</h4>
            <hr>
            <div class="row">
                <div class="col-3">
                    @if ($data->student()->first()->foto_mahasiswa == null)
                        <img src="{{ asset('img/person.png') }}" width='250px' height="250px" alt="">
                    @else
                        <img src="{{ asset('storage/'. $data->student()->first()->foto_mahasiswa) }}" width='250px' height="250px" alt="">

                    @endif
                </div>
                <div class="col-9">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th width = '20%'>NIM Mahasiswa</th>
                            <td width = '2%'>:</td>
                            <td>{{ $data->student()->first()->nim_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th width = '20%'>Nama Mahasiswa</th>
                            <td width = '2%'>:</td>
                            <td>{{ $data->student()->first()->nama_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th width = '20%'>Program Studi</th>
                            <td width = '2%'>:</td>
                            <td>{{ $data->student()->first()->prodi()->first()->nama_prodi ?? '' }}</td>
                        </tr>
                        <tr>
                            <th width = '20%'>Jurusan</th>
                            <td width = '2%'>:</td>
                            <td>{{ $data->student()->first()->jurusan()->first()->nama_jurusan ?? '' }}</td>
                        </tr>
                        <tr>
                            <th width = '20%'>Email</th>
                            <td width = '2%'>:</td>
                            <td>{{ $data->student()->first()->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>


        </div>
    </div>
    <div class="card py-4 my-4">
        <div class="card-body">
            <h4>{{ $data->jenis_kegiatan()->first()->nama_jenis_kegiatan }}
                ({{ $data->jenis_kegiatan()->first()->kode_jenis_kegiatan }})</h4>
            <hr>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Tempat {{ $data->jenis_kegiatan()->first()->kode_jenis_kegiatan }}</th>
                    <td>{{ $data->partner()->first()->nama_mitra }}</td>
                    <th>Mulai {{ $data->jenis_kegiatan()->first()->kode_jenis_kegiatan }}</th>
                    <td>{{ $data->mulai_magang }}</td>

                </tr>
                <tr>
                    <th>Pamong {{ $data->jenis_kegiatan()->first()->kode_jenis_kegiatan }}</th>
                    <td>{{ $data->partner()->first()->pamong_mitra }}</td>
                    <th>Lama {{ $data->jenis_kegiatan()->first()->kode_jenis_kegiatan }}</th>
                    <td>{{ $data->lama_magang }} Minggu</td>
                </tr>
                <tr>
                    <th>Dosen Pembimbing</th>
                    <td>{{ $data->lecturer()->first()->nama_dosen }}</td>
                    <th>Akhir {{ $data->jenis_kegiatan()->first()->kode_jenis_kegiatan }}</th>
                    <td>{{ $data->akhir_magang }}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection
@section('js')
    {{-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}
    {{-- <script>
        $(function() {
            $('#table-jenis-kegiatan').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('magang.list') }}",
                columns: [{
                        data: 'jenis_kegiatan.nama_jenis_kegiatan',
                        defaultContent: '-',
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

    </script> --}}
@endsection
