@extends('layouts.admin')
@section('content-header', $data->student()->first()->nama_mahasiswa ?? '')
@section('content')
    @include('alert')

    <div class="card py-4">
        <div class="card-body">
            <h4 class="h4">{{ $data->jenis_kegiatan()->first()->nama_jenis_kegiatan }}</h4>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Tempat Magang</th>
                    <td>{{ $data->partner()->first()->nama_mitra }}</td>
                    <th>Mulai Magang</th>
                    <td>{{ $data->mulai_magang }}</td>

                </tr>
                <tr>
                    <th>Pamong Magang</th>
                    <td>{{ $data->partner()->first()->pamong_mitra }}</td>
                    <th>Lama Magang</th>
                    <td>{{ $data->lama_magang }} Minggu</td>
                </tr>
                <tr>
                    <th>Dosen Pembimbing</th>
                    <td>{{ $data->lecturer()->first()->nama_dosen }}</td>
                    <th>Akhir Magang</th>
                    <td>{{ $data->akhir_magang }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card py-4 my-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h4>List Jurnal</h4>
                </div>
            </div>
            <hr>
            <div class="col-12">
                <table class="table table-striped">
                    <tr>
                        <th width='100px'>No</th>
                        <th width='200px'>Tanggal</th>
                        <th>Catatan</th>
                        <th width='100px'>Komentar</th>
                        <th class="text-center" width='80px'>Action</th>
                    </tr>
                    @forelse($data->journals as $key => $item)
                        <tr>
                            <td class="text-center">{{ ++$key }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_jurnal)->format('d M Y') }}</td>
                            <td>{!! $item->catatan_jurnal !!}</td>
                            <td>{{ $item->komentar_jurnal ?? 'Kosong' }}</td>
                            <td class="text-center">
                                <a href='jurnal/{{ $item->uuid }}' class="btn btn-warning">Show</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection


{{-- <div class="row">
                <div class="col-md-12">
                    {{ Form::textarea('', null, ['class' => 'form-control', 'rows' => '4', 'placeholder' => 'Isi Komentar']) }}
                </div>
            </div> --}}
{{-- <div class="form-group row pt-2">
                <div class="col-md-3">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
                </div>
            </div> --}}
