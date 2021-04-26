@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')

    @include('alert')

    <div class="card">
        <div class="card-body">
            <div class="col-12">
                <h4 class="h4">Cetak Jurnal</h4>
                <hr>
                {{ Form::open() }}
                <div class="row mb-5">
                    <div class="col-5">
                        <input type="text" class="form-control" id="date_from" value="{{\Carbon\Carbon::now()}}">
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" id="date_to" value="{{\Carbon\Carbon::now()->addDays(7)}}">
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
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Catatan</th>
                            <th>Komentar</th>
                            <th>Status</th>
                            <th>TTD</th>
                        </tr>
                        </thead>
                    </table>
                    @endif
                </div>
            </div>
            <div class="col-12 pr-0">


            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            // $("#date_from").datepicker();
            // $("#date_to").datepicker();
        })
    </script>
@endsection
