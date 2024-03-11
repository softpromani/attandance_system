@extends('frontend.includes.main')
@section('title', 'Mark Attendance')
@section('style')

@endsection
@section('content')
    <div class="page-content clear-medium ">

        <div class="card card-style ">
    <h1 class="text-center">QR Scanner</h1>

            <div id="qr-reader" ></div>
            <div id="qr-reader-results"></div>
        </div>
    </div>
@endsection
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
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess);
    </script>

@endsection
