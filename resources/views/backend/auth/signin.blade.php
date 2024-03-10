<!DOCTYPE HTML>
<html lang="en">
@extends('frontend.includes.head')

<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default">
@extends('frontend.includes.loader')
<div id="page">
<div class="header header-fixed header-logo-center">
     <p class="header-title">School Management</p>
     <a href="#" data-back-button="" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
     <a href="#" data-toggle-theme="" class="header-icon header-icon-4"><i class="fas fa-lightbulb"></i></a>
</div>
@extends('frontend.includes.footer')
     <div class="page-content header-clear-medium">
          <div class="card card-style">
               <div class="content mt-4 mb-1">
                    <h1 class="text-center font-800 font-40 pt-2 mb-1">Sign In</h1>
                    <p class="color-highlight text-center font-12 mb-3">Let's get you logged in</p>
                         <form method="POST" action="{{ route('login') }}">
                          @csrf
<div class="input-style no-borders has-icon validate-field mb-4">
<i class="fa fa-user"></i>
<input type="name" name="email" class="form-control validate-name" id="form1a" placeholder="Email">
<label for="form1a" class="color-blue-dark font-10 mt-1">Email</label>
<i class="fa fa-times disabled invalid color-red-dark"></i>
<i class="fa fa-check disabled valid color-green-dark"></i>
<em>(required)</em>
</div>
<div class="input-style no-borders has-icon validate-field mb-4">
<i class="fa fa-lock"></i>
<input type="password" name="password" class="form-control validate-password" id="form3a" placeholder="Password">
<label for="form3a" class="color-blue-dark font-10 mt-1">Password</label>
<i class="fa fa-times disabled invalid color-red-dark"></i>
<i class="fa fa-check disabled valid color-green-dark"></i>
<em>(required)</em>
</div>
<input type="submit" class="btn btn-m rounded-sm mt-4 mb-4 btn-full bg-green-dark text-uppercase font-900">
{{--  <a href="#" class="btn btn-m rounded-sm mt-4 mb-4 btn-full bg-green-dark text-uppercase font-900">Login</a>  --}}
<div class="divider"></div>
</form>

<div class="divider mt-4 mb-3"></div>
<div class="d-flex">
<div class="w-50 font-11 pb-2 color-theme opacity-60 pb-3 text-end"><a href="page-forgot-1.html" class="color-theme">Forgot Credentials</a></div>
</div>
</div>
</div>
</div>





</div>
@extends('frontend.includes.foot')
</body>
</html>
