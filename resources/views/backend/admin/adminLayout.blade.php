@extends('frontend.includes.main')
@section('title', 'Dashboard')
@section('content')
    <div id="page">
        <div class="card-style">
            <div class="content">
                <p id="demo" style="color:red;display: inline;">Loading....</p>
                <div class="row mb-n3">
                    @if(auth()->user()->hasAnyRole(['staff','admin']))
                    <div class="col-6 ps-2">
                        <a href="{{ route('student.student.index') }}">
                            <div class="card card-style gradient-green shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Student's</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $stdnt }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 ps-2">
                        @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('staff.markattendance') }}">
                            <div class="card card-style gradient-blue shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Attendance List</h3>
                                </div>
                            </div>
                        </a>
                        @elseif(auth()->user()->hasRole('staff'))
                         <a href="{{ route('staff.markattendance') }}">
                            <div class="card card-style gradient-blue shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Mark Attendance</h3>
                                </div>
                            </div>
                        </a>
                        @endif
                    </div>
                    @endif
                    @if(auth()->user()->hasRole('admin'))
                    <div class="col-6 ps-2">
                        <a href="{{ route('staff.teacherRegisterData') }}">
                            <div class="card card-style gradient-blue shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Teacher's</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $teach }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 ps-2">
                        <a href="{{ route('admin.qr.index') }}">
                            <div class="card card-style gradient-green shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Generate QR</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 ps-2">
                        <a href="{{ route('admin.setmap') }}">
                            <div class="card card-style gradient-yellow shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Set Area</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 pe-2">
                        <a href="{{ route('admin.leave-set-up.index') }}">
                            <div class="card card-style gradient-blue shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block pt-1">Leave SetUp</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $lv }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(auth()->user()->hasRole('admin'))
                    <div class="col-6 ps-2">
                        <a href="{{ route('staff.student-bill.create') }}">
                            <div class="card card-style gradient-blue shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Student Bill</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $lv }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                     @if(auth()->user()->hasRole('staff'))
                    <div class="col-6 ps-2">
                        <a href="{{ route('staff.teacher-leaves.create') }}">
                            <div class="card card-style gradient-yellow shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Leave Apply</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    {{--  <h1 class="color-white mb-n1 font-28">{{ $lv }}</h1>
                                    <span class="color-white font-10 opacity-60">No new Meetings</span>  --}}
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(auth()->user()->hasRole('admin'))
                    <div class="col-6 ps-2">
                        <a href="{{ route('staff.teacherAllLeave') }}">
                            <div class="card card-style gradient-yellow shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Approve Leave</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script>
        window.onload = function() {
            getLocation();
        };
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                document.getElementById("demo").innerHTML = "Geolocation is not supported by this browser.";
            }
        }
        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            document.getElementById("demo").innerHTML = "Latitude: " + latitude + " Longitude: " + longitude;
        }
    </script>
@endsection
