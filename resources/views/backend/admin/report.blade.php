@extends('frontend.includes.main')
@section('title', 'Report')
@section('content')
@section('style')

@endsection
            <h2 class="pb-2 text-center"><strong>Report Card</strong></h2>
                <div class="col-12 ps-2 pb-2">
                        <button type="button" id="backButton" style="float: left; font-weight:600;">
                            <i class="fas fa-arrow-left"></i>Back
                        </button>
                </div>
                <div id="page">
                    <div class="content">
                        <div class="row mb-n3">
                            <div class="card">
                            <div class="col ps-2">
                                <canvas id="studentChart" style="width:100%;"></canvas>  
                                <p class="text-center">Student Report</p>  
                                <a href="{{ route('admin.viewstudentreport') }}">View All</a>
                            </div>
                        </div>
                        <div class="card">
                        <div class="col" >
                            <canvas id="myChart"></canvas>
                            <p class="text-center">Fees Report`s</p>
                            <a href="{{ route('admin.viewstdfeereport') }}">View All</a>
                         </div>
                        </div>
                        </div>
                    </div>
                </div>  
@endsection
@section('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> --}}
<script type="text/javascript" src="{{asset('frontend/assets/scripts/Chart.js')}}" ></script>

    <script>
            $(document).ready(function() {
        document.getElementById('backButton').addEventListener('click', function() {
                window.history.back();
            });
        });
        </script>

        <script>
            $(document).ready(function() {
                var females = {!! json_encode($studentFemale) !!};
                var males = {!! json_encode($studentMale) !!};
                var allstudent = {!! json_encode($allstudent) !!};
        var xValues = ["Female", "Male", "Total Student "];
        var yValues = [females, males, allstudent];
        var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797"
       
        ];

        new Chart("studentChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        // options: {
        //     title: {
        //     display: true,
        //     text: "Student`s Report",
        //     }
        // }
        });
        });
        </script>




        {{-- <script>
            $(document).ready(function() {
            var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan", "Fab", "Mar", "Apr", "May", "Jun", "Jul", "Aug","Sep","Oct","Nov","Dec"],
            datasets: [{
            label: 'apples',
            data: [12, 19, 3, 17, 28, 24, 7,8,10,15,43,55],
            backgroundColor: "rgba(153,255,51,1)"
            }, 
            // {
            // label: 'oranges',
            // data: [30, 29, 5, 5, 20, 3, 10],
            // backgroundColor: "rgba(255,153,0,1)"
            // }
        ]
        }
        });
        });
        </script> --}}
        
        <script>
            $(document).ready(function() {
                // Function to generate month names
                var monthlyFees = {!! json_encode(array_values($monthlyFees)) !!};
                function getMonthNames() {
                    const monthNames = [];
                    for (let i = 0; i < 12; i++) {
                        monthNames.push(new Date(0, i).toLocaleString('en', { month: 'short' }));
                    }
                    return monthNames;
                }
        
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: getMonthNames(),
                        datasets: [{
                            label: 'Monthly Fees',
                            data: monthlyFees,
                            backgroundColor: "rgba(153,255,51,1)"
                        }]
                    }
                });
            });
        </script>
@endsection


