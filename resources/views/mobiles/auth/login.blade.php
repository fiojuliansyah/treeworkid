@extends('mobiles.layouts.module')

@section('content')
<div class="page-content d-flex flex-column justify-content-center min-vh-100">

    <div class="page-title page-title-small">
        <img src="/assets/media/logos/logo-dark.png" width="200px">
        <h5 class="font-32 font-500 mt-5">Selamat datang</h5>
        <h5 class="font-16 font-300">Ayo jelajahi treework!</h5>
    </div>
    <div class="content mb-0 text-center">
        <form id="login-form" class="form w-100" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-style no-borders has-icon validate-field mb-4">
                <input type="email" name="email" class="form-control validate-name" placeholder="Email">
                <label class="color-blue-dark font-10 mt-1">Email</label>
                @error('email')
                <em style="color: red">{{ $message }}</em>
                @enderror
            </div>
            <div class="input-style no-borders has-icon validate-field mb-4">
                <input type="password" name="password" class="form-control validate-password" placeholder="Password">
                <label class="color-blue-dark font-10 mt-1">Password</label>
                @error('password')
                <em style="color: red">{{ $message }}</em>
                @enderror
            </div>
        </form>

        <a href="#" onclick="event.preventDefault(); document.getElementById('login-form').submit();" class="btn btn-m mt-4 mb-4 btn-full bg-highlight rounded-sm text-uppercase font-900">Login</a>
    </div>
</div>
@endsection