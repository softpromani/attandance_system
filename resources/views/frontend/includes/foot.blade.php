<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript" src="{{asset('frontend/assets/scripts/bootstrap.min.js')}}" defer=""></script>
<script type="text/javascript" src="{{asset('frontend/assets/scripts/custom.js')}}" defer=""></script>
<!-- At the end of your layout file, before the closing </body> tag -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="{{asset('frontend/assets/scripts/sweetalert2.all.min.js')}}" defer=""></script>


<script>
    {{--  $(document).ready(function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });  --}}
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
