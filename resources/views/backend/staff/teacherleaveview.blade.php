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
    <div class="card card-style">
        <div class="content mb-1 ">
            <div class="table-responsive">
        <table class="table table-borderless text-center rounded-sm shadow-l datatables" style="overflow: hidden;">
            <thead>
                <tr style="background-color:#2F539B; color:white;">
                <th scope="col">SR.NO.</th>
                <th scope="col">Subject</th>
                <th scope="col">Description</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">File</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody style="color:#2F539B;">
            @forelse($teacherleaves as $teacherleave)
            <tr>

            </tr>
            @empty
            teacher leaves not found
            @endforelse
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
            ajax: "{{ route('staff.teacher-leaves.create') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'subject', name: 'subject' },
                { data: 'description', name: 'description' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                {
                    data: 'file',
                    name: 'file',
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            return '<img src="' + data + '" width="100">';
                        }
                        return data;
                    }
                },
                { data: 'status', name: 'status' }, // Include the status column
                { data: 'action', name: 'action' }, // Action column for edit
                { data: 'delete', name: 'delete' } // New column for delete
            ]
        });
    });
    </script>
@endsection

