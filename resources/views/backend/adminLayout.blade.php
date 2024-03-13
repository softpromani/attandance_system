<!DOCTYPE HTML>
<html lang="en">
@extends('frontend.includes.head')
{{--  {{$teach}}  --}}


    <div id="page">
        <div class="header header-fixed header-logo-center header-auto-show">
            <a href="index.html" class="header-title">Sticky Mobile</a>
            <a href="#" data-back-button="" class="header-icon header-icon-1"><i
                    class="fas fa-arrow-left"></i></a>
            <a href="#" data-toggle-theme="" class="header-icon header-icon-4"><i
                    class="fas fa-lightbulb"></i></a>
        </div>
        <div class="page-content">
            <div class="content notch-clear">
                <div class="d-flex py-2">
                    <div class="align-self-center me-auto">
                        <strong class="text-uppercase opacity-60 font-11">Welcome Back</strong>
                        <h1 class="mt-n2 font-27">{{ Auth::user()->name ?? '' }}</h1>
                    </div>
                    <div class="align-self-center ms-auto">
                        <a href="#" class="d-block" data-menu="menu-events"><img
                                src="images/pictures/faces/2s.png" class="img-fluid shadow-xl rounded-circle"
                                width="52"></a>
                    </div>
                </div>
            </div>
            <div class="content mt-0">
                <div class="row mb-n3">

                    <div class="col-6 ps-2">
                        <a href="{{ route('teacherRegisterData') }}">
                            <div class="card card-style gradient-green shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Teacher's</h3>
                                </div>
                                <div class="card-bottom p-3">

                                    <h1 class="color-white mb-n1 font-28">{{ $teach }}</h1>

                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-6 ps-2">
                        <a href="{{ route('student.index') }}">
                            <div class="card card-style gradient-red shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Student's</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $stdnt }}</h1>

                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 pe-2">
                        <a href="#">
                            <div class="card card-style gradient-yellow shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block pt-1">Student's Bill</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">35</h1>
                                    <i class="color-white font-10 fa fa-arrow-up"></i>
                                    <span class="color-white font-10 font-700">1 New</span>
                                    <span class="color-white font-10 opacity-60"> vs last 7 days</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 ps-2">
                        <a href="{{ route('leave-set-up.index') }}">
                            <div class="card card-style gradient-blue shadow-bg shadow-bg-m mx-0 mb-3"
                                data-card-height="130">
                                <div class="card-top p-3">
                                    <h3 class="color-white d-block  pt-1">Leave SetUp</h3>
                                </div>
                                <div class="card-bottom p-3">
                                    <h1 class="color-white mb-n1 font-28">{{ $leave }}</h1>
                                    <span class="color-white font-10 opacity-60">No new Meetings</span>
                                </div>
                            </div>
                    </div>

                </div>
                </a>
            </div>
            {{--  <div class="card card-style">
<div class="content mb-0">
<div class="row mb-2 mt-n2">
<div class="col-6 text-start">
<h4 class="font-700 text-uppercase font-12 opacity-50">You Projects</h4>
</div>
<div class="col-6 text-end">
<a href="#" class="font-12">View All</a>
</div>
</div>
<div class="divider mb-3"></div>
<a href="#" class="d-flex mb-4">
<div class="align-self-center">
<span class="icon icon-l gradient-blue shadow-bg shadow-bg-s rounded-m color-white me-3"><i class="fa fa-cog"></i></span>
</div>
<div class="align-self-center w-100">
<h5>Website Launch</h5>
<div class="progress mt-2 mb-1" style="height:3px;">
<div class="progress-bar border-0 bg-blue-dark text-start ps-2" role="progressbar" style="width: 40%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
</div>
</div>
<div class="row mb-0">
<div class="col-6 text-start">
<p class="mb-n1 font-12 opacity-60">Developing</p>
</div>
<div class="col-6 text-end">
<p class="mb-n1 font-12 opacity-60">2/6</p>
</div>
</div>
</div>
</a>
<a href="#" class="d-flex mb-4">
<div class="align-self-center">
<span class="icon icon-l gradient-green shadow-bg shadow-bg-s rounded-m color-white me-3"><i class="fa fa-power-off"></i></span>
</div>
<div class="align-self-center w-100">
<h5>Application Update</h5>
<div class="progress mt-2 mb-1" style="height:3px;">
<div class="progress-bar border-0 bg-green-dark text-start ps-2" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
</div>
</div>
<div class="row mb-0">
<div class="col-6 text-start">
<p class="mb-n1 font-12 opacity-60">Complete</p>
</div>
<div class="col-6 text-end">
<p class="mb-n1 font-12 opacity-60">10/10</p>
</div>
</div>
</div>
</a>
<a href="#" class="d-flex mb-4">
<div class="align-self-center">
<span class="icon icon-l icon-l gradient-red shadow-bg shadow-bg-s rounded-m color-white me-3"><i class="fa fa-server"></i></span>
</div>
<div class="align-self-center w-100">
<h5>Server Data Transfer</h5>
<div class="progress mt-2 mb-1" style="height:3px;">
<div class="progress-bar border-0 bg-red-dark text-start ps-2" role="progressbar" style="width: 20%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
</div>
</div>
<div class="row mb-0">
<div class="col-6 text-start">
<p class="mb-n1 font-12 opacity-60">Canceled</p>
</div>
<div class="col-6 text-end">
<p class="mb-n1 font-12 opacity-60">3/5</p>
</div>
</div>
</div>
</a>
<a href="#" class="d-flex mb-4">
<div class="align-self-center">
<span class="icon icon-l icon-l gradient-yellow shadow-bg shadow-bg-s rounded-m color-white me-3"><i class="fa fa-sync"></i></span>
</div>
<div class="align-self-center w-100">
<h5>Project Assignment</h5>
<div class="progress mt-2 mb-1" style="height:3px;">
<div class="progress-bar border-0 bg-yellow-dark text-start ps-2" role="progressbar" style="width: 70%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
</div>
</div>
<div class="row mb-0">
<div class="col-6 text-start">
<p class="mb-n1 font-12 opacity-60">On hold</p>
</div>
<div class="col-6 text-end">
<p class="mb-n1 font-12 opacity-60">16/23</p>
</div>
</div>
</div>
</a>
</div>
</div>
<div class="card card-style">
<div class="content">
<h4 class="font-700 text-uppercase font-12 opacity-50 mt-n2">Project Attachements</h4>
<div class="divider mb-n1"></div>
</div>
<a href="#">
<div class="d-flex px-3 mb-3">
<div class="align-self-center">
<span class="icon icon-m rounded-m gradient-blue shadow-bg shadow-bg-s text-center color-white me-3"><i class="fa fa-file-archive font-20"></i></span>
</div>
<div class="align-self-center me-auto">
<h4 class="font-14 mb-n1">Project Update.</h4>
<p class="mb-0 mt-n2"><a href="#" class="color-theme opacity-30 font-11 font-400">315kb, ZIP Archive</a></p>
</div>
<div class="align-self-center ms-auto">
<i class="fa fa-download font-16 opacity-30"></i>
</div>
</div>
</a>
<a href="#">
<div class="d-flex px-3 mb-3">
<div class="align-self-center">
<span class="icon icon-m rounded-m gradient-red shadow-bg shadow-bg-s text-center color-white me-3"><i class="fa fa-file-pdf font-20"></i></span>
</div>
<div class="align-self-center me-auto">
<h4 class="font-14 mb-n1">Customer Briefing.</h4>
<p class="mb-0 mt-n2"><a href="#" class="color-theme opacity-30 font-11 font-400">315kb, ZIP Archive</a></p>
</div>
<div class="align-self-center ms-auto">
<i class="fa fa-download font-16 opacity-30"></i>
</div>
</div>
</a>
<a href="#">
<div class="d-flex px-3 mb-3">
<div class="align-self-center">
<span class="icon icon-m rounded-m gradient-yellow shadow-bg shadow-bg-s text-center color-white me-3"><i class="fa fa-file-alt font-20"></i></span>
</div>
<div class="align-self-center me-auto">
<h4 class="font-14 mb-n1">Product Licenses</h4>
<p class="mb-0 mt-n2"><a href="#" class="color-theme opacity-30 font-11 font-400">315kb, ZIP Archive</a></p>
</div>
<div class="align-self-center ms-auto">
<i class="fa fa-download font-16 opacity-30"></i>
</div>
</div>
</a>
<a href="#">
<div class="d-flex px-3 mb-3">
<div class="align-self-center">
<span class="icon icon-m rounded-m gradient-green shadow-bg shadow-bg-s text-center color-white me-3"><i class="fa fa-file-image font-20"></i></span>
</div>
<div class="align-self-center me-auto">
<h4 class="font-14 mb-n1">Screenshot Design.</h4>
<p class="mb-0 mt-n2"><a href="#" class="color-theme opacity-30 font-11 font-400">315kb, ZIP Archive</a></p>
</div>
<div class="align-self-center ms-auto">
<i class="fa fa-download font-16 opacity-30"></i>
</div>
</div>
</a>
</div> --}}
            <div class="footer card card-style">
                <p href="#" class="footer-title"><span class="color-highlight">Attandance Managment
                        Application</span></p>
                <p class="footer-text"><span>Made with <i class="fa fa-heart color-highlight font-16 ps-2 pe-2"></i> by
                        Enabled</span><br><br>Powered by the best Mobile Website Developer on Envato Market. Elite
                    Quality. Elite Products.</p>
                <div class="text-center mb-3">
                    <a href="#" class="icon icon-xs rounded-sm shadow-l me-1 bg-facebook"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="#" class="icon icon-xs rounded-sm shadow-l me-1 bg-twitter"><i
                            class="fab fa-twitter"></i></a>
                    <a href="#" class="icon icon-xs rounded-sm shadow-l me-1 bg-phone"><i
                            class="fa fa-phone"></i></a>
                    <a href="#" data-menu="menu-share"
                        class="icon icon-xs rounded-sm me-1 shadow-l bg-red-dark"><i class="fa fa-share-alt"></i></a>
                    <a href="#" class="back-to-top icon icon-xs rounded-sm shadow-l bg-dark-light"><i
                            class="fa fa-angle-up"></i></a>
                </div>
                <p class="footer-copyright">Copyright &copy; Inovation Trove <span id="copyright-year">2024</span>. All
                    Rights Reserved.</p>
                <p class="footer-links"><a href="#" class="color-highlight">Privacy Policy</a> | <a href="#"
                        class="color-highlight">Terms and Conditions</a> | <a href="#"
                        class="back-to-top color-highlight"> Back to Top</a></p>
                <div class="clear"></div>
            </div>
        </div>


        <div id="menu-settings" class="menu menu-box-bottom menu-box-detached">
            <div class="menu-title mt-0 pt-0">
                <h1>Settings</h1>
                <p class="color-highlight">Flexible and Easy to Use</p><a href="#" class="close-menu"><i
                        class="fa fa-times"></i></a>
            </div>
            <div class="divider divider-margins mb-n2"></div>
            <div class="content">
                <div class="list-group list-custom-small">
                    <a href="#" data-toggle-theme="" data-trigger-switch="switch-dark-mode"
                        class="pb-2 ms-n1">
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
            <div class="menu-title">
                <h1>Highlights</h1>
                <p class="color-highlight">Any Element can have a Highlight Color</p><a href="#"
                    class="close-menu"><i class="fa fa-times"></i></a>
            </div>
            <div class="divider divider-margins mb-n2"></div>
            <div class="content">
                <div class="highlight-changer">
                    <a href="#" data-change-highlight="blue"><i class="fa fa-circle color-blue-dark"></i><span
                            class="color-blue-light">Default</span></a>
                    <a href="#" data-change-highlight="red"><i class="fa fa-circle color-red-dark"></i><span
                            class="color-red-light">Red</span></a>
                    <a href="#" data-change-highlight="orange"><i
                            class="fa fa-circle color-orange-dark"></i><span
                            class="color-orange-light">Orange</span></a>
                    <a href="#" data-change-highlight="pink2"><i
                            class="fa fa-circle color-pink2-dark"></i><span class="color-pink-dark">Pink</span></a>
                    <a href="#" data-change-highlight="magenta"><i
                            class="fa fa-circle color-magenta-dark"></i><span
                            class="color-magenta-light">Purple</span></a>
                    <a href="#" data-change-highlight="aqua"><i class="fa fa-circle color-aqua-dark"></i><span
                            class="color-aqua-light">Aqua</span></a>
                    <a href="#" data-change-highlight="teal"><i class="fa fa-circle color-teal-dark"></i><span
                            class="color-teal-light">Teal</span></a>
                    <a href="#" data-change-highlight="mint"><i class="fa fa-circle color-mint-dark"></i><span
                            class="color-mint-light">Mint</span></a>
                    <a href="#" data-change-highlight="green"><i
                            class="fa fa-circle color-green-light"></i><span
                            class="color-green-light">Green</span></a>
                    <a href="#" data-change-highlight="grass"><i
                            class="fa fa-circle color-green-dark"></i><span class="color-green-dark">Grass</span></a>
                    <a href="#" data-change-highlight="sunny"><i
                            class="fa fa-circle color-yellow-light"></i><span
                            class="color-yellow-light">Sunny</span></a>
                    <a href="#" data-change-highlight="yellow"><i
                            class="fa fa-circle color-yellow-dark"></i><span
                            class="color-yellow-light">Goldish</span></a>
                    <a href="#" data-change-highlight="brown"><i
                            class="fa fa-circle color-brown-dark"></i><span class="color-brown-light">Wood</span></a>
                    <a href="#" data-change-highlight="night"><i class="fa fa-circle color-dark-dark"></i><span
                            class="color-dark-light">Night</span></a>
                    <a href="#" data-change-highlight="dark"><i class="fa fa-circle color-dark-light"></i><span
                            class="color-dark-light">Dark</span></a>
                    <div class="clearfix"></div>
                </div>
                <a href="#" data-menu="menu-settings"
                    class="mb-3 btn btn-full btn-m rounded-sm bg-highlight shadow-xl text-uppercase font-900 mt-4">Back
                    to Settings</a>
            </div>
        </div>

        <div id="menu-backgrounds" class="menu menu-box-bottom menu-box-detached">
            <div class="menu-title">
                <h1>Backgrounds</h1>
                <p class="color-highlight">Change Page Color Behind Content Boxes</p><a href="#"
                    class="close-menu"><i class="fa fa-times"></i></a>
            </div>
            <div class="divider divider-margins mb-n2"></div>
            <div class="content">
                <div class="background-changer">
                    <a href="#" data-change-background="default"><i class="bg-theme"></i><span
                            class="color-dark-dark">Default</span></a>
                    <a href="#" data-change-background="plum"><i class="body-plum"></i><span
                            class="color-plum-dark">Plum</span></a>
                    <a href="#" data-change-background="magenta"><i class="body-magenta"></i><span
                            class="color-dark-dark">Magenta</span></a>
                    <a href="#" data-change-background="dark"><i class="body-dark"></i><span
                            class="color-dark-dark">Dark</span></a>
                    <a href="#" data-change-background="violet"><i class="body-violet"></i><span
                            class="color-violet-dark">Violet</span></a>
                    <a href="#" data-change-background="red"><i class="body-red"></i><span
                            class="color-red-dark">Red</span></a>
                    <a href="#" data-change-background="green"><i class="body-green"></i><span
                            class="color-green-dark">Green</span></a>
                    <a href="#" data-change-background="sky"><i class="body-sky"></i><span
                            class="color-sky-dark">Sky</span></a>
                    <a href="#" data-change-background="orange"><i class="body-orange"></i><span
                            class="color-orange-dark">Orange</span></a>
                    <a href="#" data-change-background="yellow"><i class="body-yellow"></i><span
                            class="color-yellow-dark">Yellow</span></a>
                    <div class="clearfix"></div>
                </div>
                <a href="#" data-menu="menu-settings"
                    class="mb-3 btn btn-full btn-m rounded-sm bg-highlight shadow-xl text-uppercase font-900 mt-4">Back
                    to Settings</a>
            </div>
        </div>

        <div id="menu-share" class="menu menu-box-bottom menu-box-detached">
            <div class="menu-title mt-n1">
                <h1>Share the Love</h1>
                <p class="color-highlight">Just Tap the Social Icon. We'll add the Link</p><a href="#"
                    class="close-menu"><i class="fa fa-times"></i></a>
            </div>
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
  @endsection

