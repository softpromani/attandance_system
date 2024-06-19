@extends('frontend.includes.main')
@section('title', 'Event')
@section('content')
  @section('style')
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/styles/evo-calendar.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/styles/midnight-blue.min.csss')}}">
      <style>

        *{
        padding:0;
        margin:0;
        box-sizing:border-box;
        }
        body{
        }
        .hero{
        width:100%;
        height:100%;
        background:linear-gradient(45deg,#83B8D7,#BAA6FD);
        display:grid;

        }
        #calendar{
        width:90%;
        margin:40px auto;
        }
        .event-point {
        display: flex;
        align-items: center; /* Align vertically */
        justify-content: center; /* Align horizontally */
        }
        tr.calendar-header .calendar-header-day, tr.calendar-body .calendar-day {
       font-size: 13px;
        }
       

      </style>
  @endsection
    <div class="card card-style">
        <div class="content mb-1">
            <div id="calendar" ></div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('frontend/assets/scripts/evo-calendar.min.js')}}" ></script>
<script>
    $(document).ready(function() {
        var calendarEvents = {!! json_encode($calendarEvents) !!};
        $('#calendar').evoCalendar({
            settingName: "hello",
            calendarEvents: calendarEvents
        });
    });
</script>




@endsection
