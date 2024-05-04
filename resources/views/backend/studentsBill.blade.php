@extends('frontend.includes.main')
@section('content')
<div class="content ">
<div class="row">
    <div class="col">
    <h2 class="">Student Bill`s</h2>
    </div>
     <div class="text-end col">
        <a href="{{route('staff.student-bill.index')}}">
        <button type="button" class="btn btn-success" title="Add Bill"><i class="fa fa-plus" aria-hidden="true"></i></button>
        </a>
     </div>
    </div>
</div>
<div class="card card-style">
        <div class="content mb-1 ">
            <div class="d-flex align-items-center">
                <span style="color:#2F539B;"><strong>Filter-</strong></span>&nbsp;
                  <input type="date" class="form-control form-control-sm" id="start_date_input">
                  <span class="mx-2" style="color:#2F539B;"><small>To</small></span>
                  <input type="date" class="form-control form-control-sm" id="end_date_input">
              </div>
            <div class="table-responsive">
            <table class="table table-borderless rounded-sm shadow-l datatables" style="overflow: hidden;">
                <thead>
                    <tr  style="background-color:#2F539B;">
                        <th scope="col" class="color-white">Sr. No</th>
                        <th scope="col" class="color-white">Invoice No</th>
                        <th scope="col" class="color-white">Ammount</th>
                        <th scope="col" class="color-white">Student Name</th>
                        <th scope="col" class="color-white">View</th>
                        <th scope="col" class="color-white">Edit</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @forelse ($bills as $bill)
                    <tr style="color:#2F539B;">
                        <th>{{ $loop->index + 1 }}</th>
                        <th>{{$bill->total_fee ??'' }}</th>
                        <th>{{ $bill->student->student_name ?? ''  }}</th>
                        <th>
                            <a href="{{ route('staff.student-bill.show' , $bill->id) }}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                        </th>
                        <th>
                            <a href="{{ route('staff.student-fee.edit', $bill->id) }}" class="edit-bill" title="Edit"><i class="fas fa-edit"></i></a>
                        </th>
                    </tr>
                    @empty
                        <th style="color:red;text-align:center;">No Data Found</th>
                    @endforelse

                </tbody> --}}
                <tbody>
                    <tr></tr>
                </tbody>
            </table>
            </div>
        </div>
</div>
@endsection
@section('script')
<script>
     $(document).ready(function() {
    var dataTable = $('.datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('staff.student-bill.create') }}",
            data: function(d) {
                d.start_date = $('#start_date_input').val();
                d.end_date = $('#end_date_input').val();
            }
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
                    data: 'student_name',
                    name: 'student_name',
                },
                {
                    data: 'view',
                    name: 'view',
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ]
        });
          // Event listener for start_date input change
     $('#start_date_input').on('change', function() {
        dataTable.ajax.reload();
    });

    // Event listener for end_date input change
    $('#end_date_input').on('change', function() {
        dataTable.ajax.reload();
    });
    });
</script>
@endsection
