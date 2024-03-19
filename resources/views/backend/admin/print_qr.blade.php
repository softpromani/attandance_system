<html>
<body>
 <style>

 </style>

<div style="margin:22%;">
    <h2 style="color:brown; font-weight:800; text-align:center;">JSF Academy Barabanki</h2>
<div id="qrcode" ></div>
</div>
<input type="hidden" spellcheck="false" id="text" value="" />




@php $url = url()->current();
$baseUrl = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST) . ':' . parse_url($url, PHP_URL_PORT) . '/';
@endphp

<script type="text/javascript" src="{{asset('frontend/assets/scripts/qrcode.min.js')}}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    var capture_url = '{{ $baseUrl }}';
    capture_url =capture_url+'staff/cpr/'+'{{ $qrId}}';
    var myurl=document.getElementById('text').value = capture_url;
</script>
<script>
    const qrcode = document.getElementById("qrcode");
    const textInput = document.getElementById("text");
    const qr = new QRCode(qrcode);
    textInput.oninput = (e) => {
        qr.makeCode(e.target.value.trim());
    };
    qr.makeCode(textInput.value.trim());
    window.onload = () => {
        window.print();
    };

    $(document).ready(function () {
        var qrData = '{{$qrId??''}}'; // Convert PHP object to JSON
        $.ajax({
            url: '/staff/cpr', // Assuming the route for capture is '/capture'
            type: 'get',
            data: { qrData: qrData }, // Send the JSON data as 'qrData'
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
</script>
</body>
</html>