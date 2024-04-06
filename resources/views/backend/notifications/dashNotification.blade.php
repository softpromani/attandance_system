@extends('frontend.includes.main')
@section('content')
@section('style')
<style>
 .card-style {
    position: relative; 
}

.scrollable-content {
    max-height: 500px; 
    overflow-y: auto; 
    overflow-x: hidden; 
}
.fixed-bottom {
    position: absolute; 
    bottom: 0; 
    left: 0; 
    z-index: 1; 
}
</style>
@endsection
<div class="content ">
    <div class="row">
        <div class="col">
            <h2 class="">Notification`s</h2>
        </div>
    </div>
</div>

<div class="card card-style">
    <div class="content mb-5 scrollable-content">
            @forelse ( auth()->user()->notifications as $notification )
                <div class="list-item d-flex align-items-start">
                    <div class="me-1">
                        <div class="avatar">
                            <span class="bg-{{ $notification->data['type'] }} rounded-circle d-inline-block text-center" style="width: 40px; height: 40px; line-height: 40px; color:white;">{{ isset($notification->data['name'])?substr($notification->data['name'], 0, 2):'N' }}</span>
                        </div>
                    </div>
                    <div class="list-item-body flex-grow-1 m-0">
                        <h6 class="">Name: {{ $notification->data['name']  }}</h6>
                        <h7>ID: {{ $notification->data['id']??'No ID'  }}</h7><br>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="flex-shrink-0 dropdown-notifications-actions alert">
                        @if (!$notification->read_at)
                        <a href="#" class="btn btn-sm btn-primary mark-as-read" data-id="{{ $notification->id }}">Mark Read</a>
                       @endif
                      </div>
                </div>
            @empty
            <p>No Notification</p>
          @endforelse
        <a class="btn btn-primary w-100 fixed-bottom" id="mark-all" href="#">Read all
            notifications</a>
    </div>
</div>        
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function sendMarkRequest(id = null) {

        let csrfToken = "{{ csrf_token() }}";

        return $.ajax("{{ route('admin.markread') }}", {
            method: 'POST',
            data: {
                _token: csrfToken,
                id
            }
        });
    }
    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('div.alert').remove();
            });
        });
        $('#mark-all').click(function() {
            let request = sendMarkRequest();
            request.done(() => {
                $('div.alert').remove();
            })
        });
    });
    </script>
@endsection