@extends('frontend.includes.main')
@section('content')
<div class="page-content ">
    <div class="card card-style">
        <div class="content">
            <h1 class="text-center font-800 font-40 pt-2 mb-1">Change Password</h1>
            <p class="color-highlight text-center font-12 mb-3">{{Auth::user()->name}}</p>
            <form method="POST" action="{{route('admin.change.password')}}">
                @csrf
                <div class="input-style no-borders has-icon validate-field mb-4">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" class="form-control validate-password" id="form3a"
                        placeholder="Current Password">
                    <label for="form3a" class="color-blue-dark font-10 mt-1">Cureent Password</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(required)</em>
                </div>
                <div class="input-style no-borders has-icon validate-field mb-4">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="new_password" class="form-control validate-password" id="form3a"
                        placeholder="New Password">
                    <label for="form3a" class="color-blue-dark font-10 mt-1">New Password</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(required)</em>
                </div>
                <div class="input-style no-borders has-icon validate-field mb-4">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="cnf_new_password" class="form-control validate-password" id="form3a"
                        placeholder="Confirm New Password">
                    <label for="form3a" class="color-blue-dark font-10 mt-1">Confirm New Password</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(required)</em>
                </div>
                <input type="submit"
                    class="btn btn-m rounded-sm mt-4 mb-4 btn-full bg-green-dark text-uppercase font-900">
                {{--  <a href="#" class="btn btn-m rounded-sm mt-4 mb-4 btn-full bg-green-dark text-uppercase font-900">Login</a>  --}}
                {{-- <div class="divider"></div> --}}
            </form>

            <div class="divider mt-4 mb-3"></div>
            <div class="d-flex">
                <div class="w-50 font-11 pb-2 color-theme opacity-60 pb-3 text-end"><a href="page-forgot-1.html"
                        class="color-theme">Forgot Credentials</a></div>
            </div>
        </div>
    </div>
</div>
@endsection
