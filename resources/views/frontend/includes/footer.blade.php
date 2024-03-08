<div id="footer-bar" class="footer-bar-1">
    <a href="{{url('backend-admin-page')}}" class="active-nav"><i class="fa fa-home"></i><span>Home</span></a>
    <a href="{{route('TeacherRegester')}}"><i class="fa fa-registered"></i><span>Rgistration</span></a>
    <a href="index-components.html"><i class="fa fa-star"></i><span>Features</span></a>
    <a href="index-pages.html"><i class="fa fa-heart"></i><span>Pages</span></a>
    {{--  <a href="index-search.html"><i class="fa fa-search"></i><span>Search</span></a>  --}}
    <a href="#" data-menu="menu-settings"><i class="fa fa-cog"></i><span>Settings</span></a>
    @if(auth()->check())
    <a href="{{route('logout')}}" ><i class="fa fa-power-off"></i><span>Logout</span></a>
    @endif
    </div>
