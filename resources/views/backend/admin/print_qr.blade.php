<div id="qrcode"></div>
<input type="hidden" spellcheck="false" id="text" value="" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    document.getElementById('text').value = window.location.href + '{{ $data }}';
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
        var qrData = '{{$data??''}}'; // Convert PHP object to JSON
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
