@extends('frontend.includes.main')
@section('content')
<div class="content ">
<div class="row">
    <div class="col">
    <h2 class="">Student Bill</h2>
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
            <div class="table-responsive">
            <table class="table table-borderless text-center rounded-sm shadow-l" style="overflow: hidden;">
                <thead>
                    <tr  style="background-color:#2F539B;">
                        <th scope="col" class="color-white">Sr. No</th>
                        <th scope="col" class="color-white">Ammount</th>
                        <th scope="col" class="color-white">Description</th>
                        <th scope="col" class="color-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bills as $bill)
                    <tr style="color:#2F539B;">
                        <th>{{ $loop->index + 1 }}</th>
                        <th>{{$bill->amount ??'' }}</th>
                        <th>{{ $bill->desc??'' }}</th>
                        <th>
                            <a href="{{ route('staff.student-bill.show' , $bill->id) }}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                        </th>
                    </tr>
                    @empty
                        <th style="color:red;text-align:center;">No Data Found</th>
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
        $(document).on('change', '.active', function() {
            var statusId = $(this).data('id');
            var isActive = $(this).is(':checked');
            var newurl = "{{ url('admin/changeStatus') }}/" + statusId;
           alert(newurl);
            $.ajax({
                url: newurl,
                type: 'get',
            });
        });
    });
</script>
@endsection
