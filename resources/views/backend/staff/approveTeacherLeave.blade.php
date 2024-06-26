@extends('frontend.includes.main')
@section('content')
<div class="content ">
    <div class="row">
        <div class="col">
            <h2 class="">Approve Leave</h2>
        </div>

    </div>
    <div class="card card-style">
        <div class="content mb-1 ">
            <div class="table-responsive">
        <table class="table table-borderless text-center rounded-sm shadow-l datatables" style="overflow: hidden;">
            <thead>
                <tr style="background-color:#2F539B; ">
                <th scope="col" class="color-white">SR.NO.</th>
                <th scope="col" class="color-white">User Name</th>
                <th scope="col" class="color-white">Subject</th>
                <th scope="col" class="color-white">Description</th>
                <th scope="col" class="color-white">Start Date</th>
                <th scope="col" class="color-white">End Date</th>
                <th scope="col" class="color-white">File</th>
                <th scope="col" class="color-white">Status</th>
                <th scope="col" class="color-white">Action</th>
            </tr>
        </thead>
        {{-- <tbody style="color:#2F539B;">
            @forelse($teacherleaves as $teacherleave)
            <tr>
                <th scope="row">{{ $loop->index+1}}</th>
                <td>{{ $teacherleave->subject ?? '' }}</td>
                <td>{{ $teacherleave->description ?? '' }}</td>
                <td>{{ $teacherleave->start_date ?? '' }}</td>
                <td>{{ $teacherleave->end_date ?? '' }}</td>
                <td>
                    <img src="{{asset('storage/'.$teacherleave->file) }}" width="100">
                </td>

                     <td>
                        @if($teacherleave->status==0)
                        <form id="approveButton" action="{{ route('staff.approveLeave') }}" method="POST">
                            @csrf
                            <input type="hidden" name="leave_id" value="{{ $teacherleave->id }}">
                            <input type="hidden" name="action" value="approve">
                            <button id="approveBtn" type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <br>
                        <form id="declineButton" action="{{ route('staff.approveLeave') }}" method="POST">
                            @csrf
                            <input type="hidden" name="leave_id" value="{{ $teacherleave->id }}">
                            <input type="hidden" name="action" value="decline">
                            <button id="declineBtn" type="submit" class="btn btn-danger">Decline</button>
                        </form>
                    @elseif($teacherleave->status==1)
                        <p class="text-white bg-success rounded-pill">Approved</p>
                    @elseif($teacherleave->status==2)
                        <p class="text-white bg-danger rounded-pill">Declined</p>
                    @endif
                 </td>  

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
    // Get references to the buttons
    const approveButton = document.getElementById('approveButton');
    const declineButton = document.getElementById('declineButton');

    // Add click event listeners to the buttons
    approveButton.addEventListener('click', function() {
        // Disable the "Decline" button
        declineButton.disabled = true;
    });

    declineButton.addEventListener('click', function() {
    });
</script>


{{--  <script>
    $(document).ready(function() {
        var dataTable = $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('staff.teacher-leaves.create') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'subject', name: 'subject' },
                { data: 'description', name: 'description' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'status', name: 'status' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }, // Action column for approve and decline buttons
            ]
        });
    });
</script>  --}}

{{--  <script>
    $(document).ready(function() {
        var dataTable = $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('staff.teacher-leaves.create') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'subject', name: 'subject' },
                { data: 'description', name: 'description' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'file', name: 'file' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' },
            ],
            columnDefs: [
                {
                    targets: [5], // Index of the File column
                    render: function(data, type, full, meta) {
                        return '<img src="' + data + '" width="100">';
                    }
                },
                {
                    targets: [6], // Index of the Status column
                    render: function(data, type, full, meta) {
                        if (data == 0) {
                            return '<p class="text-dark bg-warning rounded-pill">Pending</p>';
                        } else if (data == 1) {
                            return '<p class="text-white bg-success rounded-pill">Approved</p>';
                        } else if (data == 2) {
                            return '<p class="text-dark bg-danger rounded-pill">Declined</p>';
                        }
                    }
                },
                {
                    targets: [7], // Index of the Action column
                    render: function(data, type, full, meta) {
                        return '<button onclick="approveLeave(' + full.id + ')" class="btn btn-success">Approve</button>' +
                               '<button onclick="declineLeave(' + full.id + ')" class="btn btn-danger">Decline</button>';
                    }
                }
            ]
        });
    });

    function approveLeave(id) {
        $.ajax({
            url: "{{ route('staff.approveLeave', ['id' => $row->id]) }}",
            method: 'POST',
            data: {
                leave_id: id,
                action: 'approve'
            },
            success: function(response) {
                // Refresh the DataTable after success
                $('.datatables').DataTable().ajax.reload();
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    }

    function declineLeave(id) {
        $.ajax({
            url: "{{ route('staff.declineLeave', ['id' => $row->id]) }}",
            method: 'POST',
            data: {
                leave_id: id,
                action: 'decline'
            },
            success: function(response) {
                // Refresh the DataTable after success
                $('.datatables').DataTable().ajax.reload();
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    }
</script>  --}}
<script>
    $(document).ready(function() {
        var dataTable = $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.teacherAllLeave') }}",
            columns: [
                {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                { data: 'name', name: 'name' },
                { data: 'subject', name: 'subject' },
                { data: 'description', name: 'description' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                {
                    data: 'file',
                    name: 'file',
                    render: function (data) {
                if (data !== null) {
                    return '<img src="' + data + '" alt="file" class="img-thumbnail" style="height: 100px; width:150px;">';
                } else {
                    return 'No Image';
                }
            }
        },
                { data: 'status', name: 'status' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false, 
                    searchable: false,
                    render: function(data, type, full, meta) {
                        
                        console.log('render');
                        console.log(full);
                        var leaveId = full.id;
                        // Construct the URLs for approve and decline actions
                        var approveRoute = "{{ route('staff.approveLeave', ':id') }}".replace(':id', leaveId);
                        var declineRoute = "{{ route('staff.declineLeave', ':id') }}".replace(':id', leaveId);
                        // Return the buttons as HTML
                        if(full.status !== 0){
                            var buttons = '<form action="' + approveRoute + '" method="POST">' + '{{ csrf_field() }}' +
                                '<button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button></form>';
                  buttons += '<form action="' + declineRoute + '" method="POST">' + '{{ csrf_field() }}' +
                             '<button type="submit" class="btn btn-danger mt-1"><i class="fa fa-times" aria-hidden="true"></i></button></form>';
                  return buttons;
              }
                        }

                }
            ],
            rowCallback: function(row, data) {
                $(row).data('id', data.id); // Set the data-id attribute for each row
            }
        });
    });



</script>
@endsection
