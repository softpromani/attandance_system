@extends('frontend.includes.main')

@section('content')
    <div class="pt-3">
        <div class="card card-style">
            <div class="content">
                <h5 class="text-center pt-2 mb-1">Forgot Password</h5>
                <form method="POST" action="{{ route('forgotlink') }}">
                    @csrf
                    <div class="input-style has-borders input-style-always-active has-icon validate-field mb-4">
                        <i class="fa fa-user"></i>
                        <input type="email" name="email" class="form-control validate-name @error('email') is-invalid @enderror" id="form1a" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                        <label for="form1a" class="color-blue-dark font-10 mt-1">Enter Your Email</label>
                    </div>
                    <button type="submit" class="btn btn-m rounded-sm btn-full bg-green-dark text-uppercase font-900">Verify and Forgot</button>
                </form>
            </div>
        </div>
    </div>
@endsection


