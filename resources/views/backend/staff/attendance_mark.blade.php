@extends('frontend.includes.main')
@section('content')
@section('style')
<style>
        
        body {
        background: #ddd; 
         justify-content: center;
        align-items: center;  font-family: "Quicksand", sans-serif;  user-select: none;
        }
        .softcard {
            width: 316px;  height: fit-content; align-items: center;
        background: -webkit-linear-gradient(to right, #f7b733, #fc4a1a); 
        background: linear-gradient(to right, #f7b733, #fc4a1a); 
        border-radius: 20px;  box-shadow: 0px 0px 10px #000;
        }

        .calendar-bar {  display: flex;  justify-content: space-between;
        align-items: center;  padding: 20px;  padding-bottom: 15px;
        border-bottom: 19px;
        }

        .calendar-bar > .current-month {
        font-size: 20px;  font-weight: bold;  color: #ddd;
        background:#000;  padding:5px;  border-radius:10px;
        }

        .calendar-bar > [class$="soft-btn"] {
        width: 40px;  aspect-ratio: 1;  text-align: center;
        line-height: 40px;  font-size: 14px;  color: #000;
        background: #ddd;  border: none;  border-radius: 50%;
        }

        .weekdays-name,
        .calendar-days {  display: flex;  flex-wrap: wrap;  padding-inline:18px;}
        /* .weekdays-name {  padding-top: 12px;} */

        /* .calendar-days {  padding-bottom: 8px;} */

        .days-name,
        [class$="-day"] {  width: 35px;  height: 40px;  color: #000;  text-align: center;
        line-height: 40px;  font-weight: 500;  font-size: 1rem; 
        }

        .days-name {  color: #e71717;  font-weight: 700;}

        .current-day {
        background-color: #000;  color: #fff;
        border-radius: 50%;  font-weight: 700;  transition: 0.5s;  cursor: pointer;
        }

        .padding-day {
        color: #a5a5a5;  user-select: none;
        }

        .calendar-bar > [class$="soft-btn"]:hover,
        .month-day:hover,
        .btn:hover {
        border-radius:5px;  background-color:#0cd727;  color:#000;  border-radius:15px;
        transition: 0.1s;  cursor: pointer;
        
        }

        .calendar-bar > [class$="soft-btn"]:focus,
        .month-day:focus,
        .btn:focus {  border-radius:15px;  background-color: #000;  color: #ddd;
        }

        .goto-buttons {
        border-top: solid 2px yellow;   display: flex;
        justify-content: space-evenly;
        }

        .btn {
        background: #eee  border: none;  border-radius: 10px;
        padding: 11px 13px;  color:#000;  font-family: "Quicksand", sans-serif;
        font-weight: 600;  font-size: 0.9rem;  margin-right: 1px;  box-shadow: 0px 0px 0px #000;
        }


</style>

@endsection
<div class="content ">
    <div class="row">
        <div class="col">
            <h2 class="">View Attendance</h2>
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
        <button type="button" id="backButton" style="float: left; font-weight:900;">
            <i class="fas fa-arrow-left"></i>
        </button>
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
            @if ($punching != null && $punchout == null)
                <a href="{{ route('staff.qrscanner') }}" class="btn btn-sm bg-red-dark text-uppercase font-700 text-uppercase rounded-s shadow-xl mb-2 mt-2">Punchout</a>
            @elseif ($punchout != null)
                <button class="btn btn-sm bg-red-dark font-700 rounded-s shadow-xl mb-2 mt-2">
                    <p class="text-light"><strong>Punchout Time {{ DateTime::createFromFormat('Y-m-d H:i:s', $punchout)->format('h:i A') ?? '' }} </strong></p>
                </button>
            @endif
            {{-- @if ($punchout == null)
                <a href="{{ route('staff.qrscanner') }}"
                    class="btn btn-sm bg-red-dark text-uppercase font-700 text-uppercase rounded-s shadow-xl mb-2 mt-2">Punchout</a>
            @else
                <button class="btn btn-sm bg-red-dark font-700 rounded-s shadow-xl mb-2 mt-2">
                    <p class="text-light"><strong>Punchout Time
                            {{ DateTime::createFromFormat('Y-m-d H:i:s', $punchout)->format('h:i A') ?? '' }} </strong>
                    </p>
                </button>
            @endif --}}

        </p>
    </div>
</div>
@if(auth()->user()->hasRole('admin'))
<div class="content">
    <div class="row">
<div class="col">
    <select class="form-select users" aria-label="Default select example" name="userId" id="userId">
        <option selected disabled> select User</option>
        @foreach ($users as $user )
        <option value="{{$user->id }}" >{{ $user->name }}</option>
        @endforeach
    </select>
</div>
</div>
</div>
@endif
<div class="card-style">
    <center>
       
        <div class="softcard">
            <div class="calendar-bar">
                <button class="prev soft-btn"><i class="fas fa-chevron-left"></i></button>
                <div class="current-month"></div>
                <button class="next soft-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="calendar">
                <div class="weekdays-name">
                    <div class="days-name">Sa</div>
                    <div class="days-name">Su</div>
                    <div class="days-name">Mo</div>
                    <div class="days-name">Tu</div>
                    <div class="days-name">We</div>
                    <div class="days-name">Th</div>
                    <div class="days-name">Fr</div>
                </div>
                <div class="calendar-days"></div>
               
            </div>
            <p class="present" style="color:black;font-weight:700;"></p>
            <div class="goto-buttons">
                <button type="button" class="btn prev-year">Prev Year</button>
                <button type="button" class="btn today">Today</button>
                <button type="button" class="btn next-year">Next Year</button>
            </div>
        </div>
    </center>
</div>

<div class="card card-style">
    <div class="content mb-0">

        <div class="d-flex align-items-center">
          <span style="color:#2F539B;"><strong>Filter-</strong></span>&nbsp;
            <input type="date" class="form-control form-control-sm" id="start_date_input">
            <span class="mx-2" style="color:#2F539B;"><small>To</small></span>
            <input type="date" class="form-control form-control-sm" id="end_date_input">
        </div>
        
        <div class="table-responsive">
            <table class="table table-borderless rounded-sm shadow-l datatables" style="overflow: hidden;">
                <thead>
                    <tr style="background-color:#2F539B;">
                        <th scope="col" class="color-white">Sr. No</th>
                        <th scope="col" class="color-white">Staff Name</th>
                        <th scope="col" class="color-white">Role</th>
                        <th scope="col" class="color-white">Punching Time</th>
                        <th scope="col" class="color-white">Punchout Time</th>
                        <th scope="col" class="color-white">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th></th>
                    </tr>
                    
                </tbody>
            </table>
        </div>        
     
        
       </div>
</div>
@endsection
@section('script')

<script>
    $(document).ready(function () {
        var currentMonth = document.querySelector(".current-month");
        var calendarDays = document.querySelector(".calendar-days");
        var presentCountParagraph = document.querySelector(".present");
        var today = new Date();
        var date = new Date();
        var allAttendance = {!! json_encode($allAttendance) !!};
        console.log('first',allAttendance);
        today.setHours(0, 0, 0, 0);

        function renderCalendar() {
            const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate();
            const totalMonthDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
            const startWeekDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay();
            calendarDays.innerHTML = "";
            let totalCalendarDay = 6 * 7;
            let presentCount = 0; // Counter for tracking present days

            for (let i = 0; i < totalCalendarDay; i++) {
                let day = i - startWeekDay + 1; // Corrected to start from 1
                let dayClass = 'month-day'; // Default class for days
                let dateString = `${date.getFullYear()}-${("0" + (date.getMonth() + 1)).slice(-2)}-${("0" + day).slice(-2)}`; // Corrected date format

                if (i < startWeekDay) {
                    // Adding previous month days
                    calendarDays.innerHTML += `<div class='padding-day'>${prevLastDay - startWeekDay + i + 1}</div>`;
                } else if (day > 0 && day <= totalMonthDay) {
                    // Adding this month days
                    let currentDay = new Date(date.getFullYear(), date.getMonth(), day);
                    currentDay.setHours(0, 0, 0, 0);
                    dayClass = currentDay.getTime() === today.getTime() ? 'current-day' : 'month-day';

                    if (allAttendance.includes(dateString)) {
                        calendarDays.innerHTML += `<div class='${dayClass}' style='color: green; font-weight:900;'>${day}</div>`;
                        presentCount++;
                    } else {
                        calendarDays.innerHTML += `<div class='${dayClass}' style='color: red'>${day}</div>`;
                    }
                } else {
                    // Adding next month days
                    calendarDays.innerHTML += `<div class='padding-day'>${day - totalMonthDay}</div>`;
                }
            }
            presentCountParagraph.textContent = "Total Present: " + presentCount;
        }

        currentMonth.textContent = date.toLocaleDateString("en-US", { month: 'long', year: 'numeric' });
        renderCalendar();

        document.querySelectorAll(".soft-btn").forEach(function (element) {
            element.addEventListener("click", function () {
                date.setMonth(date.getMonth() + (element.classList.contains("prev") ? -1 : 1));
                currentMonth.textContent = date.toLocaleDateString("en-US", { month: 'long', year: 'numeric' });
                renderCalendar();
            });
        });

        document.querySelectorAll(".btn").forEach(function (element) {
            element.addEventListener("click", function () {
                let btnClass = element.classList;
                if (btnClass.contains("today")) {
                    date = new Date();
                } else if (btnClass.contains("prev-year")) {
                    date = new Date(date.getFullYear() - 1, date.getMonth(), 1);
                } else {
                    date = new Date(date.getFullYear() + 1, date.getMonth(), 1);
                }
                currentMonth.textContent = date.toLocaleDateString("en-US", { month: 'long', year: 'numeric' });
                renderCalendar();
            });
        });

        $(document).on('change', '#userId', function () {
            var userId = document.querySelector('.users').value;
            alert('fun run');
            // Sending AJAX request
            $.ajax({
                url: '{{ route("admin.selectuser") }}',
                type: 'GET',
                data: { userId: userId },
                dataType: 'json',
                success: function (data) {
                    // Assuming the API returns the attendance data
                    allAttendance = data.attendance;
                    console.log('ajax',data);
                    renderCalendar();
                    console.log("Attendance Loaded successfully");
                },
                error: function (error) {
                    console.error("Error:", error);
                }
            });
        });
    });
</script>

<script>
    // $(document).ready(function () {

</script>
{{-- <script>
    $(document).ready(function() {
        document.getElementById('backButton').addEventListener('click', function() {
                window.history.back();
            });
        var dataTable = $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('staff.markattendance') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'staff',
                    name: 'staff',
                },
                {
                    data: 'role',
                    name: 'role',
                },
                {
                    data: 'punching_time',
                    name: 'punching_time',
                },
                {
                    data: 'punchout_time',
                    name: 'punchout_time',
                },
                {
                    data: 'status',
                    name: 'status',
                },
            ]
        });
    });
   
</script> --}}

<script>
    $(document).ready(function() {
        document.getElementById('backButton').addEventListener('click', function() {
                window.history.back();
            });
    var dataTable = $('.datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('staff.markattendance') }}",
            data: function(d) {
                d.start_date = $('#start_date_input').val();
                d.end_date = $('#end_date_input').val();
            }
        },
        columns: [
            {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'staff',
                    name: 'staff',
                },
                {
                    data: 'role',
                    name: 'role',
                },
                {
                    data: 'punching_time',
                    name: 'punching_time',
                },
                {
                    data: 'punchout_time',
                    name: 'punchout_time',
                },
                {
                    data: 'status',
                    name: 'status',
                },
        ]
    });
     // Event listener for start_date input change
     $('#start_date_input').on('change', function() {
        dataTable.ajax.reload();
    });

    // Event listener for end_date input change
    $('#end_date_input').on('change', function() {
        dataTable.ajax.reload();
    });
});
</script>

<script>
    // function sendUserId() {
    //     var userId = document.querySelector('.users').value;
    //     // Sending AJAX request
    //     fetch('{{ route("staff.markattendance") }}?userId=' + userId)
    //         .then(response => {
    //             if (response.ok) {
    //                 console.log("Attendance Loaded successfully");
    //             } else {
    //                 // Handle error
    //                 console.error("Failed to Load attendance");
    //             }
    //         })
    //         .catch(error => {
    //             console.error("Error:", error);
    //         }); 
    // }
</script>



@endsection
