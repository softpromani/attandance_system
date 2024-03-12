@extends('frontend.includes.main')
@section('content')
<div class="content ">
<div class="row">
    <div class="col">
    <h2 class="">Generate QR</h2>
    </div>
     <div class="text-end col">
        <a href="{{route('admin.qr.create')}}">
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
                        <th scope="col" class="color-white">QR Code</th>
                        <th scope="col" class="color-white">Valid From</th>
                        <th scope="col" class="color-white">Valid To</th>
                        <th scope="col" class="color-white">Is Active</th>
                        <th scope="col" class="color-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($qrDatas as $qr)
                    <tr style="color:#2F539B;">
                        <th>{{ $loop->index + 1 }}</th>
                        <th>{{ $qr->qr_code??'' }}</th>
                        <th>{{$qr->valid_from??''}}</th>
                        <th>{{ $qr->valid_to??'' }}</th>
                    <th>
                            <div class="form-check form-switch">
                            <input class="form-check-input active" data-id="{{$qr->id}}" type="checkbox"  name="is_active" id="switch-dark-mode-a{{$qr->id}}" {{ $qr->is_active ? 'checked' : '' }}>
                            {{-- <label class="custom-control-label" for="switch-dark-mode-a{{$qr->id}}"></label> --}}
                            </div>
                    </th>
                    <th>
                        <div class="d-flex">
                            <a href="{{ route('admin.qr.edit',encrypt($qr->id)) }}" title="Edit"><i class="fa fa-edit me-2" style="color:blue; font-size:15px;"></i></a> 
                            <form action="{{route('admin.qr.destroy',$qr->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border: none; background: none; " title="Delete">
                                    <i class="fa fa-trash" style="color: red; font-size: 15px;"></i>
                                </button>
                            </form>

                        </div>
                       
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