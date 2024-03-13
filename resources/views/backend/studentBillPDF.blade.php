@extends('frontend.includes.main')
@section('content')
<button id="printButton" onclick="validateAndPrint()">Print</button>
@endsection
@section('script')

{{$bill}}
<!-- Include your script at the end of the HTML body -->
<script>
    // Function to validate and trigger the print
    function validateAndPrint() {
        // Perform any validation checks here
        // For example, check if the user is logged in, has necessary permissions, etc.

        // If validation passes, trigger the print
        window.print();
    }
</script>
@endsection
