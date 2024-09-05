@extends('mobiles.layouts.module')


@section('content')
<div class="page-content">
        
    <div class="page-title page-title-small">
        <h2 style="color: black"><a href="#" data-back-button><i class="fa fa-arrow-left" style="color: black"></i></a>Akun</h2>
        <div class="divider"></div>
    </div>
    <div class="content mb-0">
        <form id="account-update" class="form" action="{{ route('mobile.update.account') }}" method="POST">
            @csrf
        <div class="input-style has-borders hnoas-icon input-style-always-active validate-field mb-4">
            <input type="name" name="name" class="form-control validate-name" value="{{ $user->name }}">
            <label for="form1" class="color-highlight font-400 font-13">Name</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
            <em>(required)</em>
        </div>
        <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4">
            <input type="email" name="email" class="form-control validate-email" value="{{ $user->email }}"">
            <label for="form2" class="color-highlight font-400 font-13">Email</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
            <em>(required)</em>
        </div>
        <div class="input-style has-borders hnoas-icon input-style-always-active validate-field mb-4">
            <input type="name" name="nik" class="form-control validate-name" value="{{ $user->nik }}">
            <label for="form1" class="color-highlight font-400 font-13">NIK KTP</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
            <em>(required)</em>
        </div>
        <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4">
            <input type="tel" name="phone" class="form-control validate-tel" value="{{ $user->phone }}">
            <label for="form3" class="color-highlight font-400 font-13">Phone Number</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
            <em>(required)</em>
        </div>
        <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4">
            <input type="passord" name="password" class="form-control validate-passord" id="form4" placeholder="******">
            <label for="form4" class="color-highlight font-400 font-13">Password</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
            <em>(required)</em>
        </div>
        </form>                      
    </div>
    <a href="#" onclick="event.preventDefault(); document.getElementById('account-update').submit();" class="btn btn-full btn-margins bg-highlight rounded-sm shadow-xl btn-m text-uppercase font-900">Save Information</a>
    
</div> 

@endsection