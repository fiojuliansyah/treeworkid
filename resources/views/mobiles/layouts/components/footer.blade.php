<div id="footer-bar" class="footer-bar-1">
    {{-- <a href="{{ route('mobile.inbox') }}" class="{{ request()->is('mobile.inbox') ? 'active-nav' : '' }}"><i class="fas fa-chalkboard-teacher"></i><span>Activity</span><em class="badge bg-red1-dark">
        @if($countRecords > 0)
        {{ $countRecords }}
        @else
        @endif
    </em></a> --}}
    {{-- <a href="{{ route('mobile.team') }}" class="{{ request()->is('mobile.team') ? 'active-nav' : '' }}"><i class="fas fa-users"></i><span>Teams</span></a> --}}
    <a href="{{ route('mobile.home') }}" class="{{ request()->routeIs('mobile.home') ? 'active-nav' : '' }}"><i class="fa fa-home"></i><span>Beranda</span></a> 
    <a href="#"><i class="fas fa-bullhorn"></i><span>Announce</span></a>
    <a href="{{ route('mobile.setting') }}" class="{{ request()->routeIs('mobile.setting') ? 'active-nav' : '' }}"><i class="fa fa-user"></i><span>Setting</span></a>
</div>  