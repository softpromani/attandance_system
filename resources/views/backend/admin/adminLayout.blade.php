@extends('frontend.includes.main')
@section('content')

    {{-- <div id="preloader">
        <div class="spinner-border color-highlight" role="status"></div>
    </div> --}}
    <div id="page">
        <div class="page-content">
            <div class="content mt-0">
                <div class="row mb-n3">
                    <div class="col-6 pe-2">
                        <a href="{{ route('staff.teacherRegisterData') }}">
                            <div class="card card-style gradient-green shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
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
                        <a href="{{ route('student.student.index') }}">
                            <div class="card card-style gradient-red shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
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
                        <a href="{{ route('staff.attendanceMark') }}">
                            <div class="card card-style gradient-red shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Mark Attendance</h3>
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
                    <div class="col-6 pe-2">
                        <a href="#">
                            <div class="card card-style gradient-yellow shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block pt-1">Present</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">35</h1>
                                    <i class="color-white font-10 fa fa-arrow-up"></i>
                                    <span class="color-white font-10 font-700">1 New</span>
                                    <span class="color-white font-10 opacity-60"> vs last 7 days</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 ps-2">
                        <a href="{{ route('admin.leave-set-up.index') }}">
                            <div class="card card-style gradient-blue shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Leave SetUp</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $lv }}</h1>
                                    <span class="color-white font-10 opacity-60">No new Meetings</span>
                                </div>
                            </div>
                    </div>
                   
                </div>
                </a>
            </div>

        </div>
    </div>
    @endsection
    @section('script')
    @endsection
