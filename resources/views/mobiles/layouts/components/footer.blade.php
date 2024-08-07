<div id="footer-bar" class="footer-bar-1">
    <a href="{{ route('mobile.home') }}" class="{{ request()->routeIs('mobile.home') ? 'active-nav' : '' }}"><i class="fa fa-home"></i><span>Beranda</span></a> 
    <a href="#"><i class="fas fa-bullhorn"></i><span>Announce</span></a>
    <a href="{{ route('mobile.setting') }}" class="{{ request()->routeIs('mobile.setting') ? 'active-nav' : '' }}"><i class="fa fa-user"></i><span>Setting</span></a>
</div>  