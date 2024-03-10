
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.29.0/dist/feather.min.js"></script>


{{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>  --}}
<script type="text/javascript" src="{{asset('frontend/assets/scripts/bootstrap.min.js')}}" defer=""></script>
<script type="text/javascript" src="{{asset('frontend/assets/scripts/custom.js')}}" defer=""></script>
<!-- At the end of your layout file, before the closing </body> tag -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.2.0/html5-qrcode.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/html5-qrcode@latest"></script>
<script src="https://unpkg.com/html5-qrcode@latest"></script> --}}



<script>
    $(document).ready(function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });
    // success message popup notification

    @if (session()->has('success'))
        toastr['success']("{{ session()->get('success') }}", 'success!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: false
        });
    @endif
    // info message popup notification
    @if (session()->has('info'))
        toastr['info']("{{ session()->get('info') }}", 'info!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: false
        });
    @endif
    // warning message popup notification
    @if (session()->has('warning'))
        toastr['warning']("{{ session()->get('warning') }}", 'Warning!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: false
        });
    @endif
    // error message popup notification
    @if (session()->has('error'))
        toastr['error']("{{ session()->get('error') }}", 'Error!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: false
        });
    @endif
 </script>
