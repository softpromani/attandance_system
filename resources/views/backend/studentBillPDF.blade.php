@include('frontend.includes.head')
<style>
 #printable-content {
    width: 100%; 
    max-width: 100%; 
}
.printable-content-adjusted {
    width: 4in; 
}
.row {
    margin: 0;
    padding: 0;
}
@media print {
    .area-print {
        width: 3.7in; 
        min-height: 5in;
    }
    .btn{
        display: none;
    }
}
.watermark-text {
    position: absolute;
    top: 25%;
    left: 25%;
    transform: translate(-50%, -50%) rotate(30deg);;
    font-size: 40px; 
    color: rgba(167, 164, 164, 0.2); 
    font-weight: bold;
}
</style>
<div class="watermark-text">STUDENT COPY</div> 
<div id="printable-content" >
    <div class="row p-0 m-0" >
        <div class="col-md-6 area-print border border-1 m-0 p-0">
            <div class="row my-2 border-bottom m-0 p-0">
                    <div class="col-1 ">
                        <img src="{{ asset('frontend/assets/images/collage/coll_logo.png') }}"  width="50" height="40">
                    </div>
                    <div class="col-11 text-center">
                        <h4 style="color: #2F539B; font-weight:600;">J.S.F. Academy Barabanki</h4>
                    </div>
                </div>
                <div class="row border-bottom">
                    <div class="col-md-6 d-flex justify-content-between">
                        <h6><b>Invoice No:-</b>&nbsp;&nbsp;{{ $fee->invoice_no }}</h6>&nbsp;&nbsp;
                        <h6><b>Date:-</b>&nbsp;&nbsp;{{  $fee->created_at->format('d-m-y') }}</h6>
                    </div>
                    <div class="col-md-6 d-flex justify-content-between">
                        <h6><b>Name:-</b>&nbsp;&nbsp;{{ $fee->student->student_name }}</h6>&nbsp;&nbsp;
                    <h6><b>Father:-</b>&nbsp;&nbsp;{{ $fee->student->father_name }}</h6>
                    </div>
                    <div class="col-md-6 d-flex justify-content-between">
                        <h6><b>Class:-</b>&nbsp;&nbsp;{{ $fee->student->class }}</h6>&nbsp;&nbsp;
                        <h6><b>Section:-</b>&nbsp;&nbsp;{{ $fee->student->section  }}</h6>
                    </div>
                        <div class="col-md-6 ">
                            <h6><b>Roll No:-</b>&nbsp;&nbsp;{{ $fee->student->registration_number }}</h6>
                    </div>
            </div>
            <div class="row m-0 p-0">
                <div class="col-sm-12 p-0 m-0">
                    <table class="table table-bordered text-center w-100" style="font-size:12px;">
                        <thead>
                            <tr style="background-color: #2F539B; color: white; ">
                                <th scope="col">Sr.No.</th>
                                <th scope="col">Description</th>
                                <th scope="col">Month</th>
                                <th scope="col">Year</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody style="color: #2F539B;">
                            @foreach ($fee->feeDetails as $fe)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $fe->desc }}</td>
                                <td>{{ $fe->feemonth->month}}</td>
                                <td>{{ $fe->feeyear->year }}</td>
                                <td>&#x20B9; {{ $fe->amount }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><b>Total</b></td>
                                <td colspan="3"></td>
                                <td> <b>&#x20B9; {{ $fee->total_fee }} </b></td>
                            </tr>
                            <tr>
                                <td colspan="3" rowspan="2">
                                    <h6>Sig.<img src="{{ asset('frontend/assets/images/signature.jpg') }}" alt="img" height="40" width="100"></h6>
                                </td>
                                <th>Paid</th>
                                <td>&#x20B9; {{ $fee->total_fee }} </td>
                            </tr>
                            <tr>
                                <th>remeinder</th>
                                <td> &#x20B9; 0.00</td>
                            </tr>
                        </tfoot>

                    </table>
                    {{-- <div class="d-flex justify-content-between m-2">
                        <h6>Total: &#x20B9; {{ $fee->total_fee }} </h6>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-md-6 area-print border border-1 m-0 p-0">
            <div class="row my-2 border-bottom m-0 p-0">
                    <div class="col-1 ">
                        <img src="{{ asset('frontend/assets/images/collage/coll_logo.png') }}"  width="50" height="40">
                    </div>
                    <div class="col-11 text-center">
                        <h4 style="color: #2F539B; font-weight:600;">J.S.F. Academy Barabanki</h4>
                    </div>
                </div>
                <div class="row border-bottom">
                        <div class="col-md-6 d-flex justify-content-between">
                            <h6><b>Invoice No:-</b>&nbsp;&nbsp;{{ $fee->invoice_no }}</h6>&nbsp;&nbsp;
                            <h6><b>Date:-</b>&nbsp;&nbsp;{{ $fee->student->created_at->format('d-m-y') }}</h6>
                        </div>
                        <div class="col-md-6 d-flex justify-content-between">
                            <h6><b>Name:-</b>&nbsp;&nbsp;{{ $fee->student->student_name }}</h6>&nbsp;&nbsp;
                        <h6><b>Father:-</b>&nbsp;&nbsp;{{ $fee->student->father_name }}</h6>
                        </div>
                        <div class="col-md-6 d-flex justify-content-between">
                            <h6><b>Class:-</b>&nbsp;&nbsp;{{ $fee->student->class }}</h6>&nbsp;&nbsp;
                            <h6><b>Section:-</b>&nbsp;&nbsp;{{ $fee->student->section  }}</h6>
                        </div>
                            <div class="col-md-6 ">
                                <h6><b>Roll No:-</b>&nbsp;&nbsp;{{ $fee->student->registration_number }}</h6>
                        </div>
                </div>
            <div class="row m-0 p-0">
                <div class="col-sm-12 p-0 m-0">
                    <table class="table table-bordered text-center w-100" style="font-size:12px;">
                        <thead>
                            <tr style="background-color: #2F539B; color: white; ">
                                <th scope="col">Sr.No.</th>
                                <th scope="col">Description</th>
                                <th scope="col">Month</th>
                                <th scope="col">Year</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody style="color: #2F539B;">
                            @foreach ($fee->feeDetails as $fe)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $fe->desc }}</td>
                                <td>{{ $fe->feemonth->month}}</td>
                                <td>{{ $fe->feeyear->year }}</td>
                                <td>&#x20B9; {{ $fe->amount }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><b>Total</b></td>
                                <td colspan="3"></td>
                                <td> <b>&#x20B9; {{ $fee->total_fee }} </b></td>
                            </tr>
                            <tr>
                                <td colspan="3" rowspan="2">
                                    <h6>Sig.<img src="{{ asset('frontend/assets/images/signature.jpg') }}" alt="img" height="40" width="100"></h6>
                                </td>
                                <th>Paid</th>
                                <td>&#x20B9; {{ $fee->total_fee }} </td>
                            </tr>
                            <tr>
                                <th>remeinder</th>
                                <td> &#x20B9; 0.00</td>
                            </tr>
                        </tfoot>

                    </table>
                    {{-- <div class="d-flex justify-content-between m-2">
                        <h6>Total: &#x20B9; {{ $fee->total_fee }} </h6>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    
</div>

<a onclick="window.print()" style=" text-align:center; color: #2F539B;" class="btn btn-sm "><strong>Print</strong></a>


<script>
    document.getElementById('printable-content').addEventListener('click', function() {
    this.classList.toggle('printable-content-adjusted');
});
</script>
@include('frontend.includes.foot')
