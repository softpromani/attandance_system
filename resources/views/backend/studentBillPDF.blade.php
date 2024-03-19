{{--  @extends('frontend.includes.main')
@section('content')  --}}

@extends('frontend.includes.head')

@section('style')
<style>
    .custom-border {
        border: 1px solid #9a9595; /* 1px solid border with a light gray color */
        padding: 10px; /* Optional: Add some padding for better visual appearance */
        margin-bottom: 10px; /* Optional: Add some margin to separate elements */
    }
    .custom-spacing {
        margin-bottom: 1px
    }
    .custom-padding {
        padding: 200px;
        color: #2F539B
    }
</style>
@endsection
<div id="printable-content">
<div class="container">
    <div class="row custom-border">
        <div class="col-sm-3 col-2 my-3">
            <img height="50" width="50" src="{{ asset('frontend/assets/images/collage/coll_logo.png') }}">
        </div>
        <div class="col-sm-6 col-10 my-4">
            <h4>J.S.F. Academy Barabanki</h4>
        </div>
    </div>
    <a onclick="printDiv('printable-content')" style="float:right; color:red;" class="btn btn-sm border"><strong>Print</strong></a>
    <div class="row">
        <div class="col-sm-4 col-md-6">
            <p>Student Name:- &nbsp;&nbsp;{{ $fee->student->student_name }}</p>
            <p>Father Name:- &nbsp;&nbsp; {{ $fee->student->father_name }}</p>
            <p>Class:- &nbsp;&nbsp; {{ $fee->student->class }}</p>
        </div>

        <div class="col-sm-4 col-md-6">
            <p>Date:-&nbsp;&nbsp; {{ \Carbon\Carbon::parse($fee->student->created_at)->format('Y-m-d') }}</p>
            <p>Roll No.:- &nbsp;&nbsp; {{ $fee->student->registration_number }}</p>
            <p>Section:- &nbsp;&nbsp;{{ $fee->student->section }}</p>
        </div>
    </div>
</div>
<div class="row col-sm-10 mx-auto card card-style ">
    <table class="table border text-center table-responsive">
        <thead>
            <tr style="background-color: #2F539B; color: white; ">
                <th scope="col">Sr.No.</th>
                <th scope="col">Description</th>
                <th scope="col">Month</th>
                <th scope="col">Year</th>
            </tr>
        </thead>

        <tbody style="color: #2F539B;">
            @foreach ($fee->feeDetails as $fe)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $fe->desc }}</td>
                <td>{{ $fe->month }}</td>
                <td>{{ $fe->year }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-end">Total Amount: {{ $fee->total_fee }}</td>
            </tr>
                <td colspan="4" class="text-start text-black text-"  >Signature : <img src="" alt="img"> </td>

        </tbody>
    </table>
</div>
</div>
{{--  <div class="row mt-3 ">
    <div class="col text-center">
        <button onclick="printDiv('printable-content')" class="btn btn-primary">Print</button>
    </div>
</div>  --}}
{{--  @endsection  --}}

{{--  @section('script')  --}}
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- Include custom JavaScript for printing -->
<script>
    function printDiv(divId) {
        var content = document.getElementById(divId).innerHTML;
        var printWindow = window.print();
        printWindow.document.write('<html><head><title>Print</title></head><body>' + content + '</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
{{--  @endsection  --}}

@extends('frontend.includes.foot')
