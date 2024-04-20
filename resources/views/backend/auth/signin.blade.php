@extends('frontend.includes.main')

@section('content')
    <div class="pt-3">
        <div class="card card-style">
            <div class="content">
                <h1 class="text-center font-800 font-40 pt-2 mb-1">Sign In</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="fcm_token" id="fcm_token" value="">
                    <div class="input-style no-borders has-icon validate-field mb-4">
                        <i class="fa fa-user"></i>
                        <input type="name" name="email" class="form-control validate-name" id="form1a"
                            placeholder="Email">
                        <label for="form1a" class="color-blue-dark font-10 mt-1">Email</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    </div>
                    <div class="input-style no-borders has-icon validate-field">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" class="form-control validate-password" id="form3a"
                            placeholder="Password">
                        <label for="form3a" class="color-blue-dark font-10 mt-1">Password</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    
                                <a href="#" class=" color-highlight font-11 ">Forgot Credentials</a>
                    </div>
                    <div class=" mb-4 ">
                        
                    <input type="checkbox" name="remember" id="rememberThis" style="opacity: 1 !important;">
                    <label for="rememberThis" style="opacity: 1 !important;" class="">Remember Me</label>
                    </div>
                    <input type="submit" class="btn btn-m rounded-sm btn-full bg-green-dark text-uppercase font-900">
                </form>
                
                <div class="divider mt-3 mb-3"></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
 <script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/10.11.0/firebase.js"></script>

<script>
    var firebaseConfig = {
        apiKey: "AIzaSyCMq4WI77B_DyzBDookMHz6s1qKxANWaqs",
        authDomain: "attendance-417410.firebaseapp.com",
        projectId: "attendance-417410",
        storageBucket: "attendance-417410.appspot.com",
        messagingSenderId: "412414167773",
        appId: "1:412414167773:web:8b32778f5c41afef7ee934",
        measurementId: "G-H8V5EVEZZ8"
    };

    firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

// Request permission and get token
messaging.requestPermission()
    .then(() => {
        console.log('Notification permission granted.');
        return messaging.getToken();
    })
    .then((token) => {
        console.log('FCM token:', token);
        document.getElementById('fcm_token').value = token; // Set FCM token value to a hidden input field
        
    })
    .catch((err) => {
        console.log('Error getting permission or token:', err);
    });
</script> 
@endsection
