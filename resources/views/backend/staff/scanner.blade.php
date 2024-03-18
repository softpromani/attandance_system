<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>J.S.F. Academy | @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/images/collage/JFS.png') }}" style="border-radius: 25%;">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/styles/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/fonts/css/fontawesome-all.min.css')}}">
    {{-- <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js"> --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('frontend/assets/app/icons/icon-192x192.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default"> 
    {{-- @extends('frontend.includes.main') --}}
{{-- @section('content') --}}

<div class="content ">
    <div class="row">
        <div class="col">
            <h1>QR Scanner</h1>
        </div>
    </div>
</div>

    <div id="content" style="width:400px">
<div class="card card-style">
        @include('frontend.includes.header') 
        <div id="qr-reader" style="width:400px"></div>
        <div id="qr-reader-results"></div>
    {{-- </div> --}}
    </div>
        @include('frontend.includes.footer')
    </div>
         
    {{-- @endsection --}}
    @section('script')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                // Extract the URL from the decodedResult object
                let redirectUrl = decodedResult.result.text;
                window.location.href = redirectUrl; 
            }   
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>
{{-- @endsection --}}
