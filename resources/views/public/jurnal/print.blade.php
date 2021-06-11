@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')

    @include('alert')

    <div class="card">
        <div class="card-body">
            <div class="col-12">
                <h4 class="h4">Cetak Jurnal</h4>
                <hr>
                {{ Form::open(['url' => route('public.journal.print.post', ['prefix' => 'student'])]) }}
                <div class="row mb-5">
                    <div class="col-5">
                        <input type="date" class="form-control" id="date_from" name="from" >
                    </div>
                    <div class="col-5">
                        <input type="date" class="form-control" id="date_to" name="to" >
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary btn-block">Generate</button>
                    </div>
                </div>
                {{ Form::close() }}

                <div class="row">
                    @if ($data == null)
                        <p><i>Data Laporan Belum di Generate</i></p>
                    @else
                        <p>Journal Cetak Dari : {!! Carbon\Carbon::createFromDate($data['from'])->format('d M Y') !!} s.d {!! Carbon\Carbon::createFromDate($data['to'])->format('d M Y') !!}</p>
                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th width="12%">Tanggal</th>
                                <th>Catatan</th>
                                <th width="12%">Status</th>
                                <th width="20%">Tanggal Verifikasi</th>
                                <th width="10%">TTD Dosen</th>
                                <th width="15%">TTD Pendamping</th>
                            </tr>
                            @foreach($data['journals'] as $key => $item)
                                <tr>
                                    <td class="text-center">{{++$key}}</td>
                                    <td class="text-center">{!! Carbon\Carbon::createFromDate($item->tanggal_jurnal)->format('d M Y') !!}</td>
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
