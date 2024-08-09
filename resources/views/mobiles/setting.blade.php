@extends('mobiles.layouts.module')


@section('content')
<div class="page-content">
        
    <div class="page-title page-title-small">
        <h2 style="color: black"><a href="{{ route('mobile.home') }}"><i class="fa fa-arrow-left" style="color: black"></i></a>Pengaturan</h2>
        <div class="divider"></div>
    </div>
    {{-- <div class="card header-card" data-card-height="80">
        <div class="card-overlay bg-highlight opacity-95"></div>
        <div class="card-overlay dark-mode-tint"></div>
        <div class="card-bg preload-img" data-src="images/pictures/20s.jpg"></div>
    </div> --}}
    <div class="content">
        <div class="d-flex">
            <div>
                <img src="{{ Auth::user()->profile['avatar_url'] ?? '/assets/media/avatars/blank.png' }}" width="50" class="me-3 bg-highlight rounded-xl">
            </div>
            <div>
                <h1 class="mb-0 pt-1">{{ Auth::user()->name }}</h1>
                <p class="color-highlight font-11 mt-n2 mb-3">{{ Auth::user()->email }} <br> {{ Auth::user()->phone }}</p>
            </div>
            <div style="margin-left: 10px; padding-top: 5px;">
                <a href="{{ route('mobile.account') }}">
                    <i class="fas fa-pencil-alt" style="color: black"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="content mb-2">
        <h5 class="float-start font-16 font-500">Informasi Akun</h5>
        <div class="clearfix"></div>
    </div>
    <div class="content mt-0 mb-0">
        <div class="list-group list-custom-large me-2">
            <a href="{{ route('mobile.profile') }}">
                <i class="fas fa-address-card font-20" style="color: black"></i>
                <span>Profil</span>
                <strong>Profile</strong>
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="{{ route('mobile.bank') }}">
                <i class="fa fa-bank font-20" style="color: black"></i>
                <span>Informasi BANK</span>
                <strong>BANK Information</strong>
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="{{ route('mobile.esign') }}">
                <i class="fas fa-signature font-20" style="color: black"></i>
                <span>Tanda tangan digital</span>
                <strong>Digital signature</strong>
                <span class="badge bg-red-dark me-2">NEW</span>
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="#">
                <i class="fas fa-user-shield font-20" style="color: black"></i>
                <span>PIN</span>
                <strong>PIN</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </div>  
    </div>
    <div class="content mb-2 mt-5">
        <h5 class="float-start font-16 font-500">Info lainnya</h5>
        <div class="clearfix"></div>
    </div>
    <div class="content mt-0 mb-0">
        <div class="list-group list-custom-large me-2">
            <a data-menu="menu-task-item" href="#">
                <i class="fas fa-shield-alt font-20" style="color: black"></i>
                <span>Kebijakan Privasi</span>
                <strong>Privacy Police</strong>
                <i class="fa fa-angle-right"></i>
            </a>
            <a data-menu="menu-task-item" href="#">
                <i class="fas fa-book font-20" style="color: black"></i>
                <span>Cara Penggunaan Aplikasi</span>
                <strong>How to User</strong>
                <i class="fa fa-angle-right"></i>
            </a>
            <a data-menu="menu-task-item" href="#">
                <i class="fas fa-bug font-20" style="color: black"></i>
                <span>Lapor Error</span>
                <strong>Report Bug</strong>
                <i class="fa fa-angle-right"></i>
            </a>
            <a data-menu="menu-task-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt font-20" style="color: black"></i>
                <span>Keluar</span>
                <strong>Logout</strong>
            </a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>
        </div>  
    </div>
</div>  
@endsection