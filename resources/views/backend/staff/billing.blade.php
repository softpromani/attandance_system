@extends('frontend.includes.main')
@section('content')
@section('style')
<style>
    .custom-border {
        border: 1px solid #9a9595; /* 1px solid border with a light gray color */
        padding: 10px; /* Optional: Add some padding for better visual appearance */
        margin-bottom: 10px; /* Optional: Add some margin to separate elements */
      
    }
    .  custom-spacing{
        margin-bottom: 1px
    }
    .custom-padding{
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
             <p>Student Name :-</p>
             <p>Father Name :-</p>
             <p> class :-</p>
            </div>
            <div class="col-sm-4 col-6 ">
             <p>Date :-</p>
             <p>Roll No. :-</p>
             <p> Section :-</p>
            </div>
        </div>
    </div>
    <div class="row col-10 mx-auto card card-style content custom-border">
        <table class="table table-borderless text-center">
            <thead>
                <tr style="background-color:#2F539B; color:white;">
                    <th scope="col">#</th>
                    <th scope="col">Sr.No.</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody style="color:#2F539B;">
                <tr>
                    <td scope="col">#</td>
                    <td scope="col">Sr.No.</td>
                    <td scope="col">Description</td>
                    <td scope="col">Amount</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end">Total Amount:</td>
                    <td> $180</td>
                </tr>
            </tbody>
        </table>
    </div>
     

    <div class="row card-style mt-5% mx-2" >
        <p>Signature</p> 
     </div>
@endsection
@section('script')
@endsection




