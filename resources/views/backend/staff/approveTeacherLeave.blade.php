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
        <table class="table table-borderless text-center rounded-sm shadow-l" style="overflow: hidden;">
            <thead>
                <tr style="background-color:#2F539B; color:white;">
                <th scope="col">SR.NO.</th>
                <th scope="col">Subject</th>
                <th scope="col">Description</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">File</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody style="color:#2F539B;">
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
                </td>

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
    // Get references to the buttons
    const approveButton = document.getElementById('approveButton');
    const declineButton = document.getElementById('declineButton');

    // Add click event listeners to the buttons
    approveButton.addEventListener('click', function() {
        // Disable the "Decline" button
        declineButton.disabled = true;

        // You can also update the server using AJAX if needed
        // Example: make an AJAX request to update the status to "approve"
    });

    declineButton.addEventListener('click', function() {
        // Nothing needs to be done here
        // The "Decline" button will remain enabled
    });
</script>
@endsection
