@extends('frontend.includes.main')
@section('content')
@section('style') 
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>
  .calendar {
  margin-top: 20px;
}

.date-selected {
  background-color: #007bff;
  color: #fff;
}

</style>
@endsection
<div class="content ">
    <div class="row">
        <div class="col">
            <h2 class="">View Mark</h2>
        </div>
        <div class="text-end col">
            <p style="color: maroon; vertical-align: middle; font-size: 14pt; margin-top: 15px; font-weight: 700; ">
                {{ \Carbon\Carbon::now('Asia/Kolkata')->format('d, M, Y') }}
            </p>
        </div>
    </div>
</div>
<div class="card card-style">
    <div class="content mb-0">
        <h1 class="text-center mb-0">Mark Attendance</h1>
        <p class="text-center color-highlight mt-n1 font-12">{{ ucwords(auth()->user()->name) }}</p>
        <p class="text-center mt-n3 mb-0 pb-0">
            @if ($punching == null)
                <a href="{{ route('staff.qrscanner') }}"
                    class="btn btn-sm bg-green-dark text-uppercase font-700 text-uppercase rounded-s shadow-xl mb-2 mt-2">Punching
                </a>
            @else
                <button class="btn btn-sm bg-green-dark font-700 rounded-s shadow-xl mb-2 mt-2">
                    <p class="text-light"><strong>Punching Time
                            {{ DateTime::createFromFormat('Y-m-d H:i:s', $punching)->format('h:i A') ?? '' }} </strong>
                    </p>
                </button>
            @endif
            @if ($punchout == null)
                <a href="{{ route('staff.qrscanner') }}"
                    class="btn btn-sm bg-red-dark text-uppercase font-700 text-uppercase rounded-s shadow-xl mb-2 mt-2">Punchout</a>
            @else
                <button class="btn btn-sm bg-red-dark font-700 rounded-s shadow-xl mb-2 mt-2">
                    <p class="text-light"><strong>Punchout Time
                            {{ DateTime::createFromFormat('Y-m-d H:i:s', $punchout)->format('h:i A') ?? '' }} </strong>
                    </p>
                </button>
            @endif

        </p>
    </div>
</div>
<div class="card card-style">
    <div class="content mb-0">
     
        <div class="container">
            <h2 class="text-center">Attendance Calendar</h2>
            <div id="calendar" class="calendar"></div>
          </div>
        
        
          
        
       </div>
</div>
@endsection
@section('script')
<script>
    var userAttendance = <?php echo json_encode($userAttendance); ?>;

    // Function to render calendar
    function renderCalendar() {
      var currentDate = new Date();
      var currentMonth = currentDate.getMonth();
      var currentYear = currentDate.getFullYear();
      var firstDay = new Date(currentYear, currentMonth, 1);
      var lastDay = new Date(currentYear, currentMonth + 1, 0);
      var startingDay = firstDay.getDay();
      var monthLength = lastDay.getDate();

      var calendarHtml = '<div class="row">';
      for (var i = 0; i < startingDay; i++) {
        calendarHtml += '<div class="col border text-center"> </div>';
      }
      for (var day = 1; day <= monthLength; day++) {
        var dateStr = currentYear + '-' + (currentMonth + 1).toString().padStart(2, '0') + '-' + day.toString().padStart(2, '0');
        var attendance = userAttendance.find(function(item) {
          return item.date === dateStr;
        });
        var cellClass = attendance && attendance.status === '1' ? 'date-selected' : '';
        calendarHtml += '<div class="col border text-center ' + cellClass + '">' + day + '<br>';
        if (attendance) {
          calendarHtml += attendance.status === '1' ? 'Present' : 'Absent';
        } else {
          calendarHtml += 'N/A';
        }
        calendarHtml += '</div>';
        if ((day + startingDay) % 7 === 0) {
          calendarHtml += '</div><div class="row">';
        }
      }
      calendarHtml += '</div>';
      $('#calendar').html(calendarHtml);
    }

    // Render the calendar initially
    renderCalendar();
  </script>

@endsection
