@extends('frontend.includes.main')
@section('title', 'STD_Details')
@section('content')
<div class="col-12 ps-2 pb-2">
    <button type="button" id="backButton" style="float: left; font-weight:600;">
        <i class="fas fa-arrow-left"></i>Back
    </button>
</div>
    <div class="row p-0 m-0">
        <div class="col">
            <h2 class="p-2">Student Details</h2>
        </div>
        
    </div>
<div data-card-height="200" class="card card-style" style="background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(29,29,171,1) 28%, rgba(0,212,255,1) 100%);">
        <div class="card-top mt-3 ms-3">
            <div class="d-flex m-0 ">
                <h6 class="color-white ">Name - </h6>&nbsp; <h6 class="color-white">{{ $students->student_name??'N/A' }}</h6>                  
            </div>
            <div class="d-flex m-0 p-0 "> 
            <h6 class="color-white ">Father Name - </h6>&nbsp; <h6 class="color-white">{{ $students->father_name??'N/A' }}</h6>   
            </div>
            <p class="color-white font-15  mb-n1"><label>Class- </label> {{ $students->className->class??'N/A' }}<label class="ms-3 ">Section- </label>{{ $students->sectionName->section??'N/A' }}<i class="ms-3 far fa-calendar"> {{ \Carbon\Carbon::parse($students->date_of_birth)->format('d - M - Y') ??'N/A' }}</i> </p>

        </div>
        <div class="card-bottom ms-3 mb-3">
            <img data-src="{{ isset($students->student_image)?asset('storage/'.$students->student_image):'https://static.vecteezy.com/system/resources/thumbnails/008/154/360/small/student-logo-vector.jpg' }}" alt="img" width="60" height="60" class="pb-1 preload-img shadow-xl rounded-m">
        </div>
        <div class="card-bottom mb-n2 ps-5 ms-5">
            <h5 class="font-13 color-white mb-n1">Registration No.</h5>
            <p class="color-white font-14 opacity-85">{{$students->registration_number??'N/A'  }}</p>
        </div>
</div>
<div class="row p-0 m-0">
    <div class="col">
        <h2 class="p-2">Student Fee Details</h2>
    </div>
</div>

<div class="card card-style">
    <div class="content mb-1">
        <div class="table-responsive">
            <table class="table table-bordered rounded-sm datatables " style="overflow: hidden;">
                <thead>
                    <tr class="bg-success">
                        <th scope="col" class="color-white">Sr.No</th>
                        <th scope="col" class="color-white">Invoice No.</th>
                        <th scope="col" class="color-white">Total Fee</th>
                        <th scope="col" class="color-white">Invoice Date</th>
                        <th scope="col" class="color-white">View</th>
                    </tr>
                </thead>
               
                <tbody>
                    <tr>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection
@section('script')

<script>
    $(document).ready(function() {
        var studentId = {{ $students->id}};
        var dataTable = $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('student.student.show', ['student' => ':studentId']) }}".replace(':studentId', studentId),
                type: 'GET'
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'invoice_no',
                    name: 'invoice_no',
                },
                {
                    data: 'total_fee',
                    name: 'total_fee',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'view',
                    name: 'view',
                },
                
            ]
        });
    });
</script>


<script>
    $(document).ready(function() {
document.getElementById('backButton').addEventListener('click', function() {
        window.history.back();
    });
});
</script>
@endsection
