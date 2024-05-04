@extends('frontend.includes.main')
@section('content')

    <div class="card card-style">
        <div class="content mb-0 ">
            <h2 class="pb-2"><strong>ToDay History</strong></h2>
            <div class="row">
                <div class="col-12 ps-2 pb-2">
                        <button type="button" id="backButton" style="float: left; font-weight:900;">
                            <i class="fas fa-arrow-left"></i>Back
                        </button>
            </div>
                    <div class="col-6 ps-2">
                            <div class="card card-style bg-danger shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1"> Attendance`s</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $newAttendance??'0' }}/{{ $allStaff??'0' }}</h1>
                                </div>
                            </div>
                    </div>
                    <div class="col-6 ps-2">
                            <div class="card card-style bg-success shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1"> Bill`s</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $newBills??'0' }}/{{ $allBills??'0' }}</h1>
                                </div>
                            </div>
                    </div>
                    <div class="col-6 ps-2">
                            <div class="card card-style bg-warning shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">New Student`s</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $newStudents??'0' }}/{{ $allStudents??'0'}}</h1>
                                </div>
                            </div>
                    </div>
                    <div class="col-6 ps-2">
                            <div class="card card-style bg-info shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">New Staff`s</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $newStaffs??'0' }}/{{ $allStaff??'0' }}</h1>
                                </div>
                            </div>
                    </div>
                    <div class="col-6 ps-2">
                            <div class="card card-style bg-primary shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">New Leave Apply</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $newLeave??'0' }}</h1>
                                </div>
                            </div>
                    </div>
            </div>
        </div>
    </div>  
@endsection
@section('script')
    <script>
            $(document).ready(function() {
        document.getElementById('backButton').addEventListener('click', function() {
                window.history.back();
            });
        });
    </script>
@endsection


