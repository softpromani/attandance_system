@extends('frontend.includes.main')
@section('title', 'mark')

@section('content')
<div class="page-content clear-medium ">
  
<div class="card card-style ">
    <div class="content">
    <style>

#reader {
  width: 500px;
}

.result {
  background-color: green;
  color: #fff;
  padding: 20px;
}

.row {
  display: flex;
}

#reader__scan_region {
  background: white;
}

    </style>
    

<!-- QR SCANNER CODE BELOW  -->

{{-- <div class="page-content clear-medium "> --}}
  {{-- <div class="card card-style "> --}}
{{-- <div class="container"> --}}
  <div class="row">
    <div class="col-sm-4">
      <div id="reader"></div>
    </div>
    <div class=" col-sm-4" style="padding: 30px">
      <h4>Scan Result </h4>
      <div id="result">
        Result goes here
      </div>
    </div>
  </div>
{{-- </div> --}}

  {{-- </div> --}}
{{-- </div> --}}


</div>
</div>
@endsection
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.2.0/html5-qrcode.min.js"></script>
<script>
    // When scan is successful fucntion will produce data
function onScanSuccess(qrCodeMessage) {
  document.getElementById("result").innerHTML =
    '<span class="result">' + qrCodeMessage + "</span>";
}
// When scan is unsuccessful fucntion will produce error message
function onScanError(errorMessage) {
  // Handle Scan Error
}
// Setting up Qr Scanner properties
var html5QrCodeScanner = new Html5QrcodeScanner("reader", {
  fps: 10,
  qrbox: 200
});
// in
html5QrCodeScanner.render(onScanSuccess, onScanError);

</script>
@endsection
