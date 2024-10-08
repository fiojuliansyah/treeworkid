@extends('mobiles.layouts.module')

@section('content')
<div class="page-content">
        
    <div class="page-title page-title-small">
        <h2 style="color: black"><a href="{{ route('mobile.home') }}"><i class="fa fa-arrow-left" style="color: black"></i></a>Ketidak Hadiran</h2>
        <div class="divider"></div>
    </div>
    {{-- <div class="card header-card" data-card-height="80">
        <div class="card-overlay bg-highlight opacity-95"></div>
        <div class="card-overlay dark-mode-tint"></div>
        <div class="card-bg preload-img" data-src="images/pictures/20s.jpg"></div>
    </div> --}}
    <div class="content mt-0 mb-0">
        <div class="list-group list-custom-large">
            @foreach ($leaves as $leave)    
                <a href="{{ route('leave.show', $leave->id) }}">
                    <i class="fas fa-file-alt font-20 color-green-dark"></i>
                    <span>{{ $leave->type['name'] }} ( {{ $leave->reason }} )</span>
                    <strong>{{ $leave->start_date }} - {{ $leave->end_date }}</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            @endforeach
        </div>
    </div>
    <div class="ad-300x50 ad-300x50-fixed">
        <a href="{{ route('leave.create') }}" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight">
            <i class="fas fa-plus">&nbsp;</i>Buat Pengajuan
        </a>
    </div>
</div>  
@endsection