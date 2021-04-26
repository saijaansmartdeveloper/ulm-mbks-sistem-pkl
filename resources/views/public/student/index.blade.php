@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')

    @include('alert')

    @if($data == null)
        <div class="card">
           <div class="card-body">
               <p><i>Anda Belum Didaftarkan untuk Kegiatan Magang <br> Harap Hubungi Admin Prodi Anda</i></p>
           </div>
        </div>
    @else
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="h4">{{ ($data->jenis_kegiatan()->first()->nama_jenis_kegiatan) }}</h4>
                <table class="table table-striped table-hover">
                    <tr>
                        <td>Tempat Magang</td>
                        <td>{{ ($data->partner()->first()->nama_mitra) }}</td>
                        <td>Mulai Magang</td>
                        <td>{{ ($data->mulai_magang) }}</td>
                        <td>Akhir Magang</td>
                        <td>{{ ($data->akhir_magang) }}</td>
                    </tr>
                    <tr>
                        <td>Pamong Magang</td>
                        <td>{{ ($data->partner()->first()->pamong_mitra) }}</td>
                        <td>Lama Magang</td>
                        <td>{{ ($data->lama_magang) }}</td>
                        <td>SK MAgang</td>
                        <td><a href="{{ url($data->file_sk_magang) }}" target="__blank" class="btn btn-outline-info btn-sm">Download SK</a></td>
                    </tr>
                    <tr>
                        <td>Dosen Pembimbing</td>
                        <td>{{ ($data->lecturer()->first()->nama_dosen) }}</td>
                        <td>Laporan Magang</td>
                        <td>
                            @if($data->laporan_magang == null)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Upload Laporan
                                </button>
                            @else
                            @endif
                        </td>
                        <td>Jurnal Magang</td>
                        <td>
                        @if($data->laporan_magang == null)
                            <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Jurnal Sah
                                </button>
                            @else
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="h4">Progres</h4>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Tanggal</th>
                        <th>Catatan</th>
                        <th width="10%">Status</th>
                        <th width="15%">Terakhir Update</th>

                    </tr>
                    </thead>
                    @forelse($data->journals as $key => $item)
                        <tr>
                            <td class="text-center">{{++$key}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_jurnal)->format('d M Y')}}</td>
                            <td>{!! $item->catatan_jurnal  !!}</td>
                            <td>{!! $item->status_jurnal_with_label !!}</td>
                            <td>{!! $item->updated_at->format('d/m/y h:i:s') !!}</td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                            <td>a</td>
                            <td>a</td>
                        </tr>
                    @endforelse

                </table>
            </div>
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>

@endsection
