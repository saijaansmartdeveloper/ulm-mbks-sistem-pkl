@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')

    @include('alert')

    <div class="card">
        <div class="card-body">
            <div class="col-12">
                <h4 class="h4">Cetak Jurnal</h4>
                <hr>
                {{ Form::open(['url' => route('public.journal.print.post')]) }}
                <div class="row mb-5">
                    <div class="col-5">
                        <input type="date" class="form-control" id="date_from" name="date_from" >
                    </div>
                    <div class="col-5">
                        <input type="date" class="form-control" id="date_to" name="date_to" >
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary btn-block">Generate</button>
                    </div>
                </div>
                {{ Form::close() }}

                <div class="col-12">
                    @if ($data == null)
                        <p><i>Data Laporan Belum di Generate</i></p>
                    @else
                        <p>Journal Cetak Dari : {{$data['from']}} s.d {{$data['to']}}</p>
                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th width="12%">Tanggal</th>
                                <th>Catatan</th>
                                <th width="12%">Status</th>
                                <th width="20%">Tanggal Verifikasi</th>
                                <th width="10%">TTD Dosen</th>
                                <th width="11%">TTD Pamong</th>
                            </tr>
                            @foreach($data['journals'] as $key => $item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->tanggal_jurnal}}</td>
                                    <td>{{$item->catatan_jurnal}}</td>
                                    <td class="text-center">{{$item->status_jurnal}}</td>
                                    <td class="text-center">{{$item->tanggal_verifikasi_jurnal}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </thead>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {

        })
    </script>
@endsection
