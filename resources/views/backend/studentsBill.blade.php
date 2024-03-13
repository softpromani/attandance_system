@extends('frontend.includes.main')
@section('content')
<div class="content ">
<div class="row">
    <div class="col">
    <h2 class="">Student Bill</h2>
    </div>
     <div class="text-end col">
        <a href="{{route('student-bill.index')}}">
        <button type="button" class="btn btn-success" title="Create QR"><i class="fas fa-qrcode"></i></button>
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
                        <th scope="col" class="color-white">Student Name</th>
                        <th scope="col" class="color-white">Quantiny</th>
                        <th scope="col" class="color-white">Fee</th>
                        <th scope="col" class="color-white">Description</th>
                        <th scope="col" class="color-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bills as $bill)
                    <tr style="color:#2F539B;">
                        <th>{{ $loop->index + 1 }}</th>
                        <th>{{$bill->student->student_name ??'' }}</th>
                        <th>{{$bill->quantity??''}}</th>
                        <th>{{ $bill->fee??'' }}</th>
                        <th>{{ $bill->desc??'' }}</th>
                        <th>
                            <a href="{{ route('student-bill.show' , $bill->id) }}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                        </th>

                    {{--  <th>
                        <div class="d-flex">
                            <a href="{{ route('admin.qr.edit',encrypt($bill->id)) }}" title="Edit"><i class="fa fa-edit me-2" style="color:blue; font-size:15px;"></i></a>
                            <form action="{{route('admin.qr.destroy',$bill->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border: none; background: none; " title="Delete">
                                    <i class="fa fa-trash" style="color: red; font-size: 15px;"></i>
                                </button>
                            </form>

                        </div>

                    </th>  --}}
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
