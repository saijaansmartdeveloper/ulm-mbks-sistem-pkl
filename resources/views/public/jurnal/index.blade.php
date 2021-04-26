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
        <div id="calendar" style="box-shadow: none"></div>
    @endif

@endsection

@section('js')
    <script type="text/javascript">

        let journal = [
            {
                id: 'bHay68s', // Event's ID (required)
                name: "Test", // Event name (required)
                date: "January/1/2020", // Event date (required)
                type: "holiday", // Event type (required)
                everyYear: true, // Same event every year (optional),
                detail : '{{ route('public.journal.show', ['uuid' => 'bHay68s'])}}'
            },
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
            if (newDate === oldDate) {
                $('#calendar').evoCalendar('toggleEventList');
            }
        });

        $('#calendar').on('selectEvent', function(event, activeEvent)  {
            window.location.href = activeEvent.detail;
        });

    </script>
@endsection
