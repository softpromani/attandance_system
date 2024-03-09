<!DOCTYPE HTML>
<html lang="en">
@extends('frontend.includes.head')

<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default">
@extends('frontend.includes.loader')
<div id="page">
<div class="header header-fixed header-logo-center">
{{-- <a href="#" class="header-title">Sticky Mobile</a> --}}
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
<form method="POST" action="{{ url('/login') }}">
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


<div id="menu-settings" class="menu menu-box-bottom menu-box-detached">
<div class="menu-title mt-0 pt-0"><h1>Settings</h1><p class="color-highlight">Flexible and Easy to Use</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
<div class="divider divider-margins mb-n2"></div>
<div class="content">
<div class="list-group list-custom-small">
<a href="#" data-toggle-theme="" data-trigger-switch="switch-dark-mode" class="pb-2 ms-n1">
<i class="fa font-12 fa-moon rounded-s bg-highlight color-white me-3"></i>
<span>Dark Mode</span>
<div class="custom-control scale-switch ios-switch">
<input data-toggle-theme="" type="checkbox" class="ios-input" id="switch-dark-mode">
<label class="custom-control-label" for="switch-dark-mode"></label>
</div>
<i class="fa fa-angle-right"></i>
</a>
</div>
<div class="list-group list-custom-large">
<a data-menu="menu-highlights" href="#">
<i class="fa font-14 fa-tint bg-green-dark rounded-s"></i>
<span>Page Highlight</span>
<strong>16 Colors Highlights Included</strong>
<span class="badge bg-highlight color-white">HOT</span>
<i class="fa fa-angle-right"></i>
</a>
<a data-menu="menu-backgrounds" href="#" class="border-0">
<i class="fa font-14 fa-cog bg-blue-dark rounded-s"></i>
<span>Background Color</span>
<strong>10 Page Gradients Included</strong>
<span class="badge bg-highlight color-white">NEW</span>
<i class="fa fa-angle-right"></i>
</a>
</div>
</div>
</div>

<div id="menu-highlights" class="menu menu-box-bottom menu-box-detached">
<div class="menu-title"><h1>Highlights</h1><p class="color-highlight">Any Element can have a Highlight Color</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
<div class="divider divider-margins mb-n2"></div>
<div class="content">
<div class="highlight-changer">
<a href="#" data-change-highlight="blue"><i class="fa fa-circle color-blue-dark"></i><span class="color-blue-light">Default</span></a>
<a href="#" data-change-highlight="red"><i class="fa fa-circle color-red-dark"></i><span class="color-red-light">Red</span></a>
<a href="#" data-change-highlight="orange"><i class="fa fa-circle color-orange-dark"></i><span class="color-orange-light">Orange</span></a>
<a href="#" data-change-highlight="pink2"><i class="fa fa-circle color-pink2-dark"></i><span class="color-pink-dark">Pink</span></a>
<a href="#" data-change-highlight="magenta"><i class="fa fa-circle color-magenta-dark"></i><span class="color-magenta-light">Purple</span></a>
<a href="#" data-change-highlight="aqua"><i class="fa fa-circle color-aqua-dark"></i><span class="color-aqua-light">Aqua</span></a>
<a href="#" data-change-highlight="teal"><i class="fa fa-circle color-teal-dark"></i><span class="color-teal-light">Teal</span></a>
<a href="#" data-change-highlight="mint"><i class="fa fa-circle color-mint-dark"></i><span class="color-mint-light">Mint</span></a>
<a href="#" data-change-highlight="green"><i class="fa fa-circle color-green-light"></i><span class="color-green-light">Green</span></a>
<a href="#" data-change-highlight="grass"><i class="fa fa-circle color-green-dark"></i><span class="color-green-dark">Grass</span></a>
<a href="#" data-change-highlight="sunny"><i class="fa fa-circle color-yellow-light"></i><span class="color-yellow-light">Sunny</span></a>
<a href="#" data-change-highlight="yellow"><i class="fa fa-circle color-yellow-dark"></i><span class="color-yellow-light">Goldish</span></a>
<a href="#" data-change-highlight="brown"><i class="fa fa-circle color-brown-dark"></i><span class="color-brown-light">Wood</span></a>
<a href="#" data-change-highlight="night"><i class="fa fa-circle color-dark-dark"></i><span class="color-dark-light">Night</span></a>
<a href="#" data-change-highlight="dark"><i class="fa fa-circle color-dark-light"></i><span class="color-dark-light">Dark</span></a>
<div class="clearfix"></div>
</div>
<a href="#" data-menu="menu-settings" class="mb-3 btn btn-full btn-m rounded-sm bg-highlight shadow-xl text-uppercase font-900 mt-4">Back to Settings</a>
</div>
</div>

<div id="menu-backgrounds" class="menu menu-box-bottom menu-box-detached">
<div class="menu-title"><h1>Backgrounds</h1><p class="color-highlight">Change Page Color Behind Content Boxes</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
<div class="divider divider-margins mb-n2"></div>
<div class="content">
<div class="background-changer">
<a href="#" data-change-background="default"><i class="bg-theme"></i><span class="color-dark-dark">Default</span></a>
<a href="#" data-change-background="plum"><i class="body-plum"></i><span class="color-plum-dark">Plum</span></a>
<a href="#" data-change-background="magenta"><i class="body-magenta"></i><span class="color-dark-dark">Magenta</span></a>
<a href="#" data-change-background="dark"><i class="body-dark"></i><span class="color-dark-dark">Dark</span></a>
<a href="#" data-change-background="violet"><i class="body-violet"></i><span class="color-violet-dark">Violet</span></a>
<a href="#" data-change-background="red"><i class="body-red"></i><span class="color-red-dark">Red</span></a>
<a href="#" data-change-background="green"><i class="body-green"></i><span class="color-green-dark">Green</span></a>
<a href="#" data-change-background="sky"><i class="body-sky"></i><span class="color-sky-dark">Sky</span></a>
<a href="#" data-change-background="orange"><i class="body-orange"></i><span class="color-orange-dark">Orange</span></a>
<a href="#" data-change-background="yellow"><i class="body-yellow"></i><span class="color-yellow-dark">Yellow</span></a>
<div class="clearfix"></div>
</div>
<a href="#" data-menu="menu-settings" class="mb-3 btn btn-full btn-m rounded-sm bg-highlight shadow-xl text-uppercase font-900 mt-4">Back to Settings</a>
</div>
</div>

<div id="menu-share" class="menu menu-box-bottom menu-box-detached">
<div class="menu-title mt-n1"><h1>Share the Love</h1><p class="color-highlight">Just Tap the Social Icon. We'll add the Link</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
<div class="content mb-0">
<div class="divider mb-0"></div>
<div class="list-group list-custom-small list-icon-0">
<a href="auto_generated" class="shareToFacebook external-link">
<i class="font-18 fab fa-facebook-square color-facebook"></i>
<span class="font-13">Facebook</span>
<i class="fa fa-angle-right"></i>
</a>
<a href="auto_generated" class="shareToTwitter external-link">
<i class="font-18 fab fa-twitter-square color-twitter"></i>
<span class="font-13">Twitter</span>
<i class="fa fa-angle-right"></i>
</a>
<a href="auto_generated" class="shareToLinkedIn external-link">
<i class="font-18 fab fa-linkedin color-linkedin"></i>
<span class="font-13">LinkedIn</span>
<i class="fa fa-angle-right"></i>
</a>
<a href="auto_generated" class="shareToWhatsApp external-link">
<i class="font-18 fab fa-whatsapp-square color-whatsapp"></i>
<span class="font-13">WhatsApp</span>
<i class="fa fa-angle-right"></i>
</a>
<a href="auto_generated" class="shareToMail external-link border-0">
<i class="font-18 fa fa-envelope-square color-mail"></i>
<span class="font-13">Email</span>
<i class="fa fa-angle-right"></i>
</a>
</div>
</div>
</div>
</div>
@extends('frontend.includes.foot')
</body>
</html>
