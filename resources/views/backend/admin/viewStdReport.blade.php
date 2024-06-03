@extends('frontend.includes.main')
@section('title', 'STD_Report')
@section('content')

<div class="card card-style">
    <div class="content mb-1">
        <div class="table-responsive">
            <table class="table table-bordered rounded-sm datatables " style="overflow: hidden;">
                <thead>
                    <tr class="bg-success">
                        <th scope="col" class="color-white">Class</th>
                        <th scope="col" class="color-white">Section</th>
                        <th scope="col" class="color-white">Girls</th>
                        <th scope="col" class="color-white">Boys</th>
                        <th scope="col" class="color-white">Total</th>
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
        var dataTable = $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.viewstudentreport') }}",
            columns: [
                
                {
                    data: 'class',
                    name: 'class',
                },
                {
                    data: 'section',
                    name: 'section',
                },
                {
                    data: 'girls',
                    name: 'girls',
                },
                {
                    data: 'boys',
                    name: 'boys',
                },
                {
                    data: 'total',
                    name: 'total',
                },
               
            ]
        });
    });
</script>
@endsection