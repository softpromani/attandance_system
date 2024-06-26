@extends('frontend.includes.main')
@section('content')
<div class="content ">
    <div class="row">
        <div class="col">
            <h2 class="">Apply Leave</h2>
        </div>
        <div class="text-end col">
            <a href="{{ route('staff.teacher-leaves.index') }}">
                <button type="button" class="btn btn-success" title="Leave"><i class="fa fa-id-card-o"></i></button>
            </a>
        </div>
    </div>
    <div class="col-md-6 ps-2">
        <div class="card card-style bg-success shadow-bg shadow-bg-m mx-0" data-card-height="150">
            <div class="card-top p-3">
                <h5 class="color-white d-block fs-6 fs-sm-5 fs-md-4 fs-lg-3">Casual</h5>
                <h5 class="color-white d-block fs-6 fs-sm-5 fs-md-4 fs-lg-3">P ({{$casuale->paid_leave??'0' }}) , Un ({{ $casuale->unpaid_leave??'0' }})</h5>
               
                @if (isset($allleaves[0]) && $allleaves[0]['leave_type'] == 'casual leave')
                <h1 class="color-white mb-n1 text-start fs-4 fs-sm-3 fs-md-2 fs-lg-1">
                    {{ isset($allleaves[0]['leave_count']) ? $allleaves[0]['leave_count'] : 0 }}/{{ $totalcasualLeave ?? 0 }}
                </h1>
            @endif
            </div>
            <div class="card-top p-3">
                <h5 class="color-white d-block text-end fs-6 fs-sm-5 fs-md-4 fs-lg-3">Sick</h5>
                <h5 class="color-white d-block text-end fs-6 fs-sm-5 fs-md-4 fs-lg-3">P ({{$sickle->paid_leave??'0' }}) , Un ({{ $sickle->unpaid_leave??'0' }})</h5>
                {{-- @if ($allleaves[1]['leave_type'] == 'sick leave')    
                    <h1 class="color-white mb-n1 text-end fs-4 fs-sm-3 fs-md-2 fs-lg-1">
                        {{ $allleaves[0]['leave_count']}}/{{ $totalcasualLeave??'0' }}
                    </h1>
                    <h1 class="color-white mb-n1 text-start fs-4 fs-sm-3 fs-md-2 fs-lg-1">
                        {{ isset($allleaves[0]['leave_count']) ? $allleaves[0]['leave_count'] : 0 }}/{{ $totalcasualLeave ?? '0' }}
                    </h1>  
                @endif --}}
                @if (isset($allleaves[1]) && $allleaves[1]['leave_type'] == 'sick leave')
                <h1 class="color-white mb-n1 text-end fs-4 fs-sm-3 fs-md-2 fs-lg-1">
                    {{ isset($allleaves[1]['leave_count']) ? $allleaves[1]['leave_count'] : 0 }}/{{ $totalsickLeave ?? '0' }}
                </h1>
                 @endif
            </div>
           
        </div>
    </div>
    <div class="card card-style">
        <div class="content mb-1 ">
            <div class="table-responsive">
        <table class="table table-borderless rounded-sm shadow-l datatables" style="overflow: hidden;">
            <thead>
                <tr style="background-color:#2F539B; color:white;">
                <th scope="col" class="color-white ">Sr.No.</th>
                <th scope="col" class="color-white">Leave Type</th>
                <th scope="col" class="color-white">Subject</th>
                <th scope="col" class="color-white">Description</th>
                <th scope="col" class="color-white">Start Date</th>
                <th scope="col" class="color-white">End Date</th>
                <th scope="col" class="color-white">File</th>
                <th scope="col" class="color-white">Status</th>
                <th scope="col" class="color-white ">Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        {{-- <tbody style="color:#2F539B;">
            @forelse($teacherleaves as $teacherleave)
            <tr>

            </tr>
            @empty
            teacher leaves not found
            @endforelse
        </tbody> --}}
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
            ajax: "{{ route('staff.teacher-leaves.create') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'leave_type', name: 'leave_type' },
                { data: 'subject', name: 'subject' },
                { data: 'description', name: 'description' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                {
                    data: 'file',
                    name: 'file',
                    render: function (data) {
                if (data !== null) {
                    return '<img src="' + data + '" alt=" Img" class="img-thumbnail" style="height: 100px; width:150px;">';
                } else {
                    return 'No Image';
                }
            }
        },
                { data: 'status', name: 'status' }, // Include the status column
                { data: 'action', name: 'action' }, // Action column for edit
            ]
        });
    });
    </script>
@endsection

