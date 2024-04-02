@extends('frontend.includes.main')

@section('content')
    <div class="pt-3">
        <div class="card card-style">
            <div class="content">
                <h1 class="text-center font-800 font-40 pt-2 mb-1">Sign In</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-style no-borders has-icon validate-field mb-4">
                        <i class="fa fa-user"></i>
                        <input type="name" name="email" class="form-control validate-name" id="form1a"
                            placeholder="Email">
                        <label for="form1a" class="color-blue-dark font-10 mt-1">Email</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    </div>
                    <div class="input-style no-borders has-icon validate-field">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" class="form-control validate-password" id="form3a"
                            placeholder="Password">
                        <label for="form3a" class="color-blue-dark font-10 mt-1">Password</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    
                                <a href="#" class=" color-highlight font-11 ">Forgot Credentials</a>
                    </div>
                    <div class=" mb-4 ">
                        
                    <input type="checkbox" name="remember" id="rememberThis" style="opacity: 1 !important;">
                    <label for="rememberThis" style="opacity: 1 !important;" class="">Remember Me</label>
                    </div>
                    <input type="submit" class="btn btn-m rounded-sm btn-full bg-green-dark text-uppercase font-900">
                </form>
                
                <div class="divider mt-3 mb-3"></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
