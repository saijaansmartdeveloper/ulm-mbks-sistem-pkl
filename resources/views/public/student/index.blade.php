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
{{--        <div class="card mb-5">--}}
{{--            <div class="card-body">--}}

{{--            </div>--}}
{{--        </div>--}}

        <div id="calendar" style="box-shadow: none"></div>

    @endif

@endsection

@section('js')
    <script type="text/javascript">
        $("#calendar").evoCalendar();
    </script>
{{--    <script>--}}
{{--        myEvents = [--}}
{{--            {--}}
{{--                id: "required-id-1",--}}
{{--                name: "New Year",--}}
{{--                date: "Wed Jan 01 2020 00:00:00 GMT-0800 (Pacific Standard Time)",--}}
{{--                type: "holiday",--}}
{{--                everyYear: true--}}
{{--            },--}}
{{--            {--}}
{{--                id: "required-id-2",--}}
{{--                name: "Valentine's Day",--}}
{{--                date: "Fri Feb 14 2020 00:00:00 GMT-0800 (Pacific Standard Time)",--}}
{{--                type: "holiday",--}}
{{--                everyYear: true,--}}
{{--                color: "#222"--}}
{{--            },--}}
{{--            {--}}
{{--                id: "required-id-3",--}}
{{--                name: "Custom Date",--}}
{{--                badge: "08/03 - 08/05",--}}
{{--                date: ["August/03/2020", "August/05/2020"],--}}
{{--                description: "Description here",--}}
{{--                type: "event",--}}
{{--            },--}}
{{--            // more events here--}}
{{--        ]--}}

{{--        $('#calendar').evoCalendar({--}}
{{--            calendarEvents: myEvents--}}
{{--        });--}}

{{--        $('#calendar').evoCalendar({--}}
{{--            format: 'mm/dd/yyyy',--}}
{{--            titleFormat: 'MM yyyy',--}}
{{--            eventHeaderFormat: 'MM d, yyyy'--}}
{{--        });--}}

{{--        $('#calendar').evoCalendar({--}}
{{--            language: 'en'--}}
{{--        });--}}

{{--        $('#calendar').evoCalendar({--}}
{{--            sidebarToggler: true,--}}
{{--            sidebarDisplayDefault: true,--}}
{{--            eventListToggler: true,--}}
{{--            eventDisplayDefault: true,--}}
{{--        });--}}

{{--        $('#calendar').evoCalendar({--}}
{{--            firstDayOfWeek: 1 // Monday--}}
{{--        });--}}

{{--        $('#calendar').evoCalendar({--}}
{{--            disabledDate: ["02/17/2020", "02/21/2020"]--}}
{{--        });--}}

{{--        $('#calendar').evoCalendar({--}}
{{--            onSelectDate: function() {--}}
{{--                // console.log('onSelectDate!')--}}
{{--            }--}}
{{--        });--}}

{{--        $("#calendar").evoCalendar('addCalendarEvent', [--}}
{{--            {--}}
{{--                name: "NEW EVENT",--}}
{{--                date: "February/16/2020",--}}
{{--                type: "birthday",--}}
{{--                everyYear: true--}}
{{--            }--}}
{{--        ]);--}}

{{--        // set theme--}}
{{--        // $("#calendar").evoCalendar('setTheme', themeName);--}}

{{--        // toggle sidebar--}}
{{--        // $("#calendar").evoCalendar('toggleSidebar', true/false);--}}
{{--        //--}}
{{--        // // toggle event list--}}
{{--        // $("#calendar").evoCalendar('toggleEventList', true/false);--}}
{{--        //--}}
{{--        // // get the selected date--}}
{{--        // $("#calendar").evoCalendar('getActiveDate');--}}
{{--        //--}}
{{--        // // get active events--}}
{{--        // $("#evoCalendar").evoCalendar('getActiveEvents');--}}
{{--        //--}}
{{--        // // select a year--}}
{{--        // $("#calendar").evoCalendar('selectYear', yearNumber);--}}
{{--        //--}}
{{--        // // select a month--}}
{{--        // $("#calendar").evoCalendar('selectMonth', monthNumber);--}}
{{--        //--}}
{{--        // // select a date--}}
{{--        // $("#calendar").evoCalendar('selectDate', dateNumber);--}}
{{--        //--}}
{{--        // // add events--}}
{{--        // $("#calendar").evoCalendar('addCalendarEvent', [{--}}
{{--        //     id: 'Event ID',--}}
{{--        //     name: "Event Name",--}}
{{--        //     date: "Date Here",--}}
{{--        //     type: "Event Type",--}}
{{--        //     everyYear: true--}}
{{--        // }]);--}}
{{--        //--}}
{{--        // // remove events by ID--}}
{{--        // $("#calendar").evoCalendar('removeCalendarEvent', eventID);--}}
{{--        //--}}
{{--        // // destroy the calendar--}}
{{--        // $("#calendar").evoCalendar('destroy');--}}
{{--    </script>--}}
@endsection
