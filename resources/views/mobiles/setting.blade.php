@extends('mobiles.layouts.app')


@section('content')
<div class="page-content">
        
    <div class="page-title page-title-small">
        <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>Pengaturan</h2>
    </div>
    <div class="card header-card" data-card-height="80">
        <div class="card-overlay bg-highlight opacity-95"></div>
        <div class="card-overlay dark-mode-tint"></div>
        <div class="card-bg preload-img" data-src="images/pictures/20s.jpg"></div>
    </div>
    <div class="content mb-2 mt-5">
        <h5 class="float-start font-16 font-500">Informasi Akun</h5>
        <div class="clearfix"></div>
    </div>
    <div class="content mt-0 mb-0">
        <div class="list-group list-custom-large me-2">
            <a data-menu="menu-task-item" href="#">
                {{-- <i class="fa fa-user color-red-dark font-20"></i> --}}
                <span>Update Akun</span>
                <strong>Account Update</strong>
                {{-- <span class="badge bg-red-dark me-2">VIP</span> --}}
                <i class="fa fa-angle-right"></i>
            </a>
            <a data-menu="menu-task-item" href="#">
                <span>Update Profil</span>
                <strong>Profile Update</strong>
                <i class="fa fa-angle-right"></i>
            </a>
            <a data-menu="menu-task-item" href="#">
                <span>Update Dokumen</span>
                <strong>Document Update</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </div>  
    </div>
    <div class="content mb-2 mt-5">
        <h5 class="float-start font-16 font-500">General</h5>
        <div class="clearfix"></div>
    </div>
    <div class="content mt-0 mb-0">
        <div class="list-group list-custom-large me-2">
            <a data-menu="menu-task-item" href="#">
                <span>Cara Penggunaan Aplikasi</span>
                <strong>How to User</strong>
                <i class="fa fa-angle-right"></i>
            </a>
            <a data-menu="menu-task-item" href="#">
                <span>Lapor Error</span>
                <strong>Report Bug</strong>
                <i class="fa fa-angle-right"></i>
            </a>
            <a data-menu="menu-task-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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