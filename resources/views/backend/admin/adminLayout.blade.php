@extends('frontend.includes.main')
@section('title', 'Dashboard')
@section('content')
    <div id="page">

        <div class="card-style">
            <div class="content">
                <i class="fas fa-map-marker-alt" style="color:green;"></i> 
                <div id="demo" style="color:red;display: inline;">
                    Loading....
                </div>
                @if (auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin.push') }}" class="btn btn-success btn-sm m-2">Push Notification</a>
                @endif
                <div class="row mb-n3">
                    @if(auth()->user()->hasAnyRole(['staff','admin']))
                    <div class="col-6 ps-2">
                        <a href="{{ route('student.student.index') }}">
                            <div class="card card-style bg-danger shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Student's</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $stdnt }}</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    <div class="col-6 ps-2">
                        @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('staff.markattendance') }}">
                            <div class="card card-style gradient-blue shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Attendance List</h3>
                                </div>
                            </div>
                        </a>
                        @elseif(auth()->user()->hasAnyRole(['staff','driver']))
                         <a href="{{ route('staff.markattendance') }}">
                            <div class="card card-style gradient-blue shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Mark Attendance</h3>
                                </div>
                            </div>
                        </a>
                        @endif
                    </div>


                    @if(auth()->user()->hasRole('admin'))
                    <div class="col-6 ps-2">
                        <a href="{{ route('staff.teacherRegisterData') }}">
                            <div class="card card-style gradient-yellow shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
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
                        <a href="{{ route('admin.viewhistory') }}">
                            <div class="card card-style demo-color bg-orange-dark shadow-bg shadow-bg-m mx-0 mb-3" data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Today History</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 pe-2">
                        <a href="{{ route('admin.leave-set-up.index') }}">
                            <div class="card card-style bg-success shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block pt-1">Leave SetUp</h3>
                                </div>
                                {{-- <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $lv }}</h1>
                                </div> --}}
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(auth()->user()->hasRole('admin'))
                    <div class="col-6 ps-2">
                        <a href="{{ route('staff.student-bill.create') }}">
                            <div class="card card-style bg-info shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Student Bill</h3>
                                </div>
                                {{-- <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $lv }}</h1>
                                </div> --}}
                            </div>
                        </a>
                    </div>
                    @endif
                     @if(auth()->user()->hasAnyRole(['staff','driver']))
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
                        <a href="{{ route('admin.teacherAllLeave') }}">
                            <div class="card card-style bg-secondary shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Approve Leave</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 ps-2">
                        <a href="{{ route('admin.systemSetting') }}">
                            <div class="card card-style demo-color bg-magenta-dark shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">System Setting</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 ps-2">
                        <a href="{{ route('admin.getreport') }}">
                            <div class="card card-style demo-color bg-pink-dark shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Report</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 ps-2">
                        <a href="{{ route('admin.getevent') }}">
                            <div class="card card-style demo-color bg-brown-dark shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Event</h3>
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
    {{-- <script>
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
    </script> --}}
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
           
            getAddress(latitude, longitude);
            var locationData = latitude + ',' + longitude;
            
    
    // Create a new FormData object
    var formData = new FormData();
    formData.append('location', locationData);
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Set up the request
    xhr.open('POST', "{{ route('staff.updatelocation') }}", true);
    xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");

    // Set the callback function to handle the response
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('Form submitted successfully');
        }
    };

    // Send the request with the form data
    xhr.send(formData);
        }
        function getAddress(latitude, longitude) {
    var geocoder = new google.maps.Geocoder();
    var latlng = { lat: parseFloat(latitude), lng: parseFloat(longitude) };

    geocoder.geocode({ 'location': latlng }, function(results, status) {
        if (status === 'OK') {
            if (results[0]) {
                var addressComponents = results[0].address_components;
                var formattedAddress = '';

                // Extract specific address components
                for (var i = 0; i < addressComponents.length; i++) {
                    if (addressComponents[i].types.includes('street_number') || 
                        addressComponents[i].types.includes('route') ||
                        addressComponents[i].types.includes('sublocality') ||
                        addressComponents[i].types.includes('neighborhood')) {
                        formattedAddress += addressComponents[i].long_name + ', ';
                    }
                }

                // Remove trailing comma and space
                formattedAddress = formattedAddress.replace(/, $/, '');

                document.getElementById("demo").innerHTML = formattedAddress;
            } else {
                document.getElementById("demo").innerHTML = "Address not found";
            }
        } else {
            document.getElementById("demo").innerHTML = "Geocoder failed due to: " + status;
        }
    });
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=places"></script> 

    
@endsection
