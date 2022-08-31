@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')

@include('alert')

@if($data == null)
<hr>
<div class="card">
    <div class="card-body">
        <p><i>Anda Belum Didaftarkan untuk Kegiatan Magang <br> Harap Hubungi Admin Prodi Anda</i></p>
    </div>
</div>
@else
<hr>

<div id="calendar" style="box-shadow: none"></div>

<!-- Modal -->
<div class="modal fade" id="modal-confirm-add-journal" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            {{ Form::open(['url' => route('public.student.journal.store'), 'files' => true]) }}
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Jurnal</h5>
                <a href="#" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="close">&times;</a>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label text-md-right" for="tanggal_jurnal">Tanggal Jurnal</label>
                        {{ Form::text('tanggal_jurnal', null, ['class' => 'form-control', 'id' => 'date_journal']) }}
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-md-right" for="catatan_monev">Catatan Jurnal</label>
                        {{ Form::textarea('catatan_jurnal', null, ['class' => 'form-control', 'rows' => '8',
                        'placeholder' => 'Catatan Journal']) }}
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label text-md-right" for="file_image_jurnal">File Image
                            Dokumentasi</label><br>
                        {{ Form::file('file_image_jurnal', ['class' => 'form-control-file', 'accept' => 'image/png,
                        image/jpeg']) }}
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-md-right" for="file_dokumen_jurnal">File Laporan</label><br>
                        {{ Form::file('file_dokumen_jurnal', ['class' => 'form-control-file', 'accept' =>
                        "application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"])
                        }}
                    </div>
                    <div class="form-group">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="" data-bs-dismiss="modal" class="btn btn-secondary">Kembali</a>
                {{ Form::submit('Simpan', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@endif

@endsection

@section('js')
{{-- @if ($data != null) --}}
<script type="text/javascript">
    $(document).ready(function () {
            $("#date_journal").datepicker({ maxDate: "0D" });

            let journal = [
            @foreach($data->journals as $key => $item)
            {
                id: '{{$item->uuid}}', // Event's ID (required)
                name: "Jurnal {{$title}}", // Event name (required)
                description: '{{ substr($item->catatan_jurnal, 0, 20) }}',
                date: '{{$item->tanggal_jurnal}}', // Event date (required)
                type: "event", // Event type (required)
                detail : '{{ route('public.journal.show', ["prefix" => "student","uuid" => $item->uuid])}}'
            },
            @endforeach
        ]

        $("#calendar").evoCalendar({
            format: "MM dd, yyyy",
            calendarEvents : journal,
            sidebarToggler: true,
            sidebarDisplayDefault: false,
            eventListToggler: true,
            eventDisplayDefault: false,
            todayHighlight : true
        });

        $('#calendar').on('selectDate', function(event, newDate, oldDate) {
            let active_events   = $('#calendar').evoCalendar('getActiveEvents').length;
            let active_date     = $('#calendar').evoCalendar('getActiveDate');

            let date_picker     = new Date(active_date)

            if ((new Date()).getTime() < date_picker.getTime()) {
                alert('Tanggal Yang Anda Pilih Masih Belum Dilewati')
            } else if (active_events > 0) {
                $('#calendar').evoCalendar('toggleEventList', true);
            } else {
                $('#calendar').evoCalendar('toggleEventList', false);

                var myModal = new bootstrap.Modal(document.getElementById('modal-confirm-add-journal'), {
                    backdrop : 'static',
                    keyboard : false
                })
                myModal.show()

                $("#date_journal").val(active_date)

            }

        });

        $('#calendar').on('selectEvent', function(event, activeEvent)  {
            window.location.href = activeEvent.detail;
        });
     })  

</script>
{{-- @endif --}}
@endsection