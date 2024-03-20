@extends('frontend.includes.main')
@section('title', 'mark')
@section('content')
<div class="content ">
    <div class="row">
        <div class="col">
            <h2 class="">Setup Leave</h2>
        </div>
        <div class="text-end col">
            <a href="{{ route('admin.leave-set-up.create') }}">
                <div class="text-end mb-2">
                    <button type="button" class="btn btn-primary" title="Add Teacher"><i
                            class="fas fa-chalkboard-teacher"></i></button>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="card card-style">
    <div class="content mb-1 ">
        <div class="table-responsive">
            <table class="table table-borderless rounded-sm shadow-l datatables" style="overflow: hidden;">
                <thead>
                    <tr style="background-color:#2F539B;">
                        <th scope="col" class="color-white">Sr. No</th>
                        <th scope="col" class="color-white">Leave Type</th>
                        <th scope="col" class="color-white">Year</th>
                        <th scope="col" class="color-white">Paid Leave</th>
                        <th scope="col" class="color-white">Unpaid Leave</th>
                        <th scope="col" class="color-white">Action</th>
                    </tr>
                </thead>
                    {{-- <tbody> --}}
                        {{-- @foreach ($leave as $dt) --}}
                            {{-- <tr class=""> --}}
                                {{-- <th scope="row">{{ $loop->index + 1 }}</th> --}}

                                {{-- <th scope="row">{{ $dt->type }}</th> --}}
                                {{-- <th scope="row">{{ $dt->years }}</th> --}}
                                {{-- <th scope="row">{{ $dt->paid_leave }}</th> --}}
                                {{-- <th scope="row">{{ $dt->unpaid_leave }}</th> --}}
                                {{-- <th scope="row"> <a href="{{ route('admin.leave-set-up.edit', $dt->id) }}" --}}
                                        {{-- class="btn btn-primary mb-1" href="#"><i class="fas fa-edit"></i></a></th> --}}

                            {{-- </tr> --}}
                        {{-- @endforeach --}}

                {{-- </tbody> --}}
                <tbody></tbody>
            </table>
            {{-- <div class="card-footer">
                @if (isset($leave))
                    {!! $leave->links('pagination::bootstrap-5') !!}
                @endif

            </div> --}}

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
            ajax: "{{ route('admin.leave-set-up.index') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'type',
                    name: 'type',
                },
                {
                    data: 'years',
                    name: 'years',
                },
                {
                    data: 'paid_leave',
                    name: 'paid_leave',
                },
                {
                    data: 'unpaid_leave',
                    name: 'unpaid_leave',
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ]
        });
    });
</script>
@endsection