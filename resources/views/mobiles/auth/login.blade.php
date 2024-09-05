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
                <input type="text" name="login" class="form-control validate-name" placeholder="Email atau Employee NIK">
                <label class="color-blue-dark font-10 mt-1">Email atau Employee NIK</label>
                @error('login')
                <em style="color: red">{{ $message }}</em>
                @enderror
            </div>
            <div class="row">
                <div class="col-10">
                    <div class="input-style no-borders has-icon validate-field mb-4">
                        <input type="password" name="password" id="password" class="form-control validate-password" placeholder="Password">
                        <label class="color-blue-dark font-10 mt-1">Password</label>
                    </div>
                </div>
                <div class="col-2 d-flex align-items-center justify-content-center">
                    <span class="cursor-pointer" onclick="togglePasswordVisibility()">
                        <i id="eye-icon" class="fa fa-eye-slash"></i>
                    </span>
                </div>
                @error('password')
                <em style="color: red">{{ $message }}</em>
                @enderror
            </div>
        </form>

        <a href="#" onclick="event.preventDefault(); document.getElementById('login-form').submit();" class="btn btn-m mt-4 mb-4 btn-full bg-highlight rounded-sm text-uppercase font-900">Login</a>
    </div>
</div>
@endsection

@push('js')
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }

    window.history.forward()

</script>
@endpush
