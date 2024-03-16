@extends('frontend.includes.main')
@section('content')
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
    <h1 class="my-3"><center>Student Bill</center></h1>

     <div class="container ">
        <div class="row custom-border" >
            <div class="col-sm-3 col-2  my-3">
              <img height="50" width="50" src="{{asset('frontend/assets/images/collage/coll_logo.png') }}" >
            </div>
            <div class="col-sm-6 col-10 my-4">
              <h4> J.S.F. Academy Barabanki</h4>
            </div>
        </div>
        <div class="row custom-border custom-spacing" >
            <div class="col-sm-4 col-6 ">
             <p>Student Name :- {{$student->student_name}}</p>
             <p>Father Name :- {{$student->father_name}}</p>
             <p> class :- {{$student->class}}</p>
            </div>
            <div class="col-sm-4 col-6 ">
             <p>Date :- {{$student->created_at}}</p>
             <p>Roll No. :-  {{$student->registration_number}}</p>
             <p> Section :- {{$student->section}}</p>
            </div>
        </div>
    </div>
    <div class="row col-10 mx-auto card card-style content custom-border">
        <table class="table table-borderless text-center">
            <thead>
                <tr style="background-color:#2F539B; color:white;">
                    <th scope="col">Sr.No.</th>
                    <th scope="col">Description</th>
                    <th scope="col">Month</th>
                    <th scope="col">Year</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody style="color:#2F539B;">
                <tr>
                    <td scope="col">1.</td>
                    <td scope="col">{{$bill->desc}}</td>
                    <td scope="col">{{$bill->month}}</td>
                    <td scope="col">{{$bill->year}}</td>
                    <td scope="col">{{$bill->amount}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">Total Amount:</td>
                    <td> $180</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row card-style mt-5% mx-2" >
        <p>Signature</p>
     </div>

    <!-- Print button -->
    <div class="row mt-3 mb-5">
        <div class="col text-center">
            <button onclick="printPage()" class="btn btn-primary">Print</button>
        </div>
    </div>
@endsection

@section('script')
<script>
    function printPage() {
        window.print(); // Trigger window.print() function to print the page
    }
</script>
@endsection
