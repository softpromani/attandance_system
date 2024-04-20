@extends('frontend.includes.main')
@section('title', 'Push-Notification')
@section('content')
<form action="{{ route('admin.firebaseNoti') }}" method="post">
    @csrf
    <div class="page-content ">
        <div class="card card-style">
            <div class="content">
    <div class="input-style has-borders input-style-always-active validate-field mb-4">
        <input type="text" name="title" class="form-control" id="form3a" placeholder="Title">
        <label for="form3a" class="color-blue-dark font-10 mt-1">Title</label>
        <i class="fa fa-times disabled invalid color-red-dark"></i>
        <i class="fa fa-check disabled valid color-green-dark"></i>
        <em>(required)</em>
    </div>
    <div class="input-style has-borders input-style-always-active validate-field mb-4">
        <input type="text" name="body" class="form-control" id="form3b" placeholder="body">
        <label for="form3b" class="color-blue-dark font-10 mt-1">Body</label>
        <i class="fa fa-times disabled invalid color-red-dark"></i>
        <i class="fa fa-check disabled valid color-green-dark"></i>
        <em>(required)</em>
    </div>
    <button type="submit" class="btn btn-sm btn-success">Send</button>
            </div>
        </div>
    </div>
</form>
@endsection