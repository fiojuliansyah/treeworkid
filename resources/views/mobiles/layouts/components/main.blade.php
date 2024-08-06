<div class="menu-header">
    <a href="#" data-toggle-theme class="border-right-0"><i class="fa font-12 color-yellow1-dark fa-lightbulb"></i></a>
    {{-- <a href="#" data-menu="menu-highlights" class="border-right-0"><i class="fa font-12 color-green1-dark fa-brush"></i></a>
    <a href="#" data-menu="menu-share" class="border-right-0"><i class="fa font-12 color-red2-dark fa-share-alt"></i></a>
    <a href="#" class="border-right-0"><i class="fa font-12 color-blue2-dark fa-cog"></i></a> --}}
    <a href="#" class="border-right-0"><i class="fa font-12 color-red2-dark fa-times"></i></a>
</div>

<div class="menu-logo text-center">
    <a href="#"><img class="rounded-circle bg-highlight" width="80" src=""></a>
    <h5 class="pt-3 font-800 font-20 text-uppercase">{{ Auth::user()->name }}</h5>
    <p class="font-11 mt-n2">{{ Auth::user()->site->company['name'] ?? '' }}</p>
</div>

<div class="menu-items">
    <h5 class="text-uppercase opacity-20 font-12 pl-3">Menu</h5>
    {{-- <div id="sub-contact" class="submenu">
        <a href="contact.html" id="nav-contact"><i class="fa fa-envelope color-blue2-dark font-16 opacity-30"></i><span>Email</span><i class="fa fa-circle"></i></a>
        <a href="#"><i class="fa fa-phone color-green1-dark font-16 opacity-50"></i><span>Phone</span><i class="fa fa-circle"></i></a>
        <a href="#"><i class="fab fa-whatsapp color-whatsapp font-16 opacity-30"></i><span>WhatsApp</span><i class="fa fa-circle"></i></a>
    </div>
    <a id="nav-settings" href="settings.html">
        <i data-feather="settings" data-feather-line="1" data-feather-size="16" data-feather-color="gray2-dark" data-feather-bg="gray2-fade-dark"></i>
        <span>Settings</span>
        <i class="fa fa-circle"></i>
    </a> --}}
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i data-feather="x" data-feather-line="3" data-feather-size="16" data-feather-color="red2-dark" data-feather-bg="red2-fade-dark"></i>
        <span>Logout</span>
        <i class="fa fa-circle"></i>
    </a>
    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>
</div>

<div class="text-center pt-2">
    {{-- <a href="#" class="icon icon-xs mr-1 rounded-s bg-facebook"><i class="fab fa-facebook"></i></a>
    <a href="#" class="icon icon-xs mr-1 rounded-s bg-twitter"><i class="fab fa-twitter"></i></a>
    <a href="#" class="icon icon-xs mr-1 rounded-s bg-instagram"><i class="fab fa-instagram"></i></a>
    <a href="#" class="icon icon-xs mr-1 rounded-s bg-linkedin"><i class="fab fa-linkedin-in"></i></a>
    <a href="#" class="icon icon-xs rounded-s bg-whatsapp"><i class="fab fa-whatsapp"></i></a> --}}
    <img src="{{ asset('') }}admin/images/logo-light-mobile.png" alt="" height="30">
    <p class="mb-0 pt-3 font-10 opacity-30">Copyright <span class="copyright-year"></span> Useit. All rights reserved</p>
</div>
