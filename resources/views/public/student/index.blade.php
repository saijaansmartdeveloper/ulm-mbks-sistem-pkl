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
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Pamong Magang</td>
                        <td>{{ ($data->partner()->first()->pamong_mitra) }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Dosen Pembimbing</td>
                        <td>{{ ($data->lecturer()->first()->nama_dosen) }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="h4">Progres</h4>
                <table class="table table-striped table-hover">

                    @forelse($data->journals as $key => $item)
                        <tr>
                            <td>{{$item->tanggal_jurnal}}</td>
                            <td>a</td>
                            <td>a</td>
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

@endsection
