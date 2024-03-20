

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{asset('frontend/assets/scripts/bootstrap.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('frontend/assets/scripts/custom.js')}}" defer=""></script>
<!-- At the end of your layout file, before the closing </body> tag -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="{{asset('frontend/assets/scripts/sweetalert2.all.min.js')}}" defer=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
<script>
   $(document).ready(function() {
  $(".notification-drop .item").on('click',function() {
    $(this).find('ul').toggle();
  });
});
</script>

<script>

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
