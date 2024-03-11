<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    @include('frontend.includes.head')
    @yield('style')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default">
    <div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    <div id="page">

    <!-- BEGIN: Header-->
    @include('frontend.includes.header')
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="page-content header-clear-small">
            {{-- @include('layout.breadcrumb') --}}
                @yield('content')
            </div>

    <!-- END: Content-->
    <!-- BEGIN: Footer-->
    @include('frontend.includes.footer')
    <!-- END: Footer-->

    <!-- BEGIN: script-->
    @include('frontend.includes.foot')

    <!-- END: script-->
    @yield('script')
    </div>
</body>
<!-- END: Body-->

</html>
