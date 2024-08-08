@extends('mobiles.layouts.module')

@section('content')
<div class="page-content">
    <div class="card card-style" style="margin-top: 50px">
        <div class="page-title page-title-small">
            <h2><a href="{{ route('leave.index') }}"><i class="fa fa-arrow-left" style="color: black;">&nbsp;&nbsp;&nbsp;</i><span><img src="{{ $leave->site->company['logo_url'] }}" width="150px"></span></h2>
        </div>
        <div class="content">
            <div class="divider mt-n4 mb-3"></div>
            <center>
                <h6>FORM PENGAJUAN CUTI</h6>
            </center>
            <br>
            <div class="row">
                <div class="col-6">
                    <p class="color-theme font-15 font-800">Tanggal Dibuat</p>
                </div>
                <div class="col-6">
                    <p class="color-theme font-15 font-800 text-right">Tanggal Pengajuan</p>
                </div>

                <div class="col-12 mb-n4 mt-n4"></div>

                <div class="col-6">
                    <p class="line-height-s">{{ $leave->created_at->format('d-M-Y') }}</p>
                </div>
                <div class="col-6">
                    <p class="line-height-s text-right">{{ $leave->start_date->format('d-M-Y') }}</p>
                </div>

                <div class="col-12 mb-3"></div>
                <div class="col-6">
                    <p class="color-theme font-15 font-800">Dibuat Oleh</p>
                </div>
                <div class="col-6">
                    <p class="color-theme font-15 font-800 text-right">Selesai</p>
                </div>

                <div class="col-12 mb-n4 mt-n4"></div>

                <div class="col-6">
                    <p class="line-height-s">{{ $leave->user['name'] }}</p>
                </div>
                <div class="col-6">
                    <p class="line-height-s text-right">{{ $leave->end_date->format('d-M-Y') }}</p>
                </div>

                <div class="col-12 mb-3"></div>
                <div class="col-6">
                    <p class="color-theme font-15 font-800">Area</p>
                </div>
                <div class="col-6">
                    <p class="color-theme font-15 font-800 text-right">Jabatan</p>
                </div>

                <div class="col-12 mb-n4 mt-n4"></div>

                <div class="col-6">
                    <p class="line-height-s">{{ $leave->user->site['name'] }}</p>
                </div>
                <div class="col-6">
                    @if (!empty($leave->user->getRoleNames()))
                        @foreach ($leave->user->getRoleNames() as $v)
                            <p class="line-height-s text-right">{{ $v }}</p>
                        @endforeach
                    @endif
                </div>

            </div>
            <center class="mb-4">
                <img src="{{ $leave->image_url }}" alt="" width="100px">
            </center>
            <h4 class="mb-n1">Deskripsi</h4>
            <p>
                {{ $leave->reason }}
            </p>

            <div class="divider"></div>
            <div class="col-12 mb-5 mt-5"></div>
            <div class="row">
                <div class="col-12 mb-3"></div>
                <div class="col-6">
                    <div class="divider mt-1 mb-1"></div>
                    <p class="color-theme">{{ $leave->user->leader['name'] }}</p>
                </div>
                @if ($leave->user->leader->leader)   
                <div class="col-6">
                    <div class="divider mt-1 mb-1"></div>
                    <p class="color-theme text-right">{{ $leave->user->leader->leader['name'] }}</p>
                </div>
                @else
                @endif

                <div class="col-12 mb-n4 mt-n4"></div>

                <div class="col-6">
                    @if (!empty($leave->user->leader->getRoleNames()))
                        @foreach ($leave->user->leader->getRoleNames() as $v)
                            <p class="line-height-s font-15 font-800">{{ $v }}</p>
                        @endforeach
                    @endif
                </div>
                @if ($leave->user->leader->leader)    
                <div class="col-6">
                    @if (!empty($leave->user->leader->leader->getRoleNames()))
                        @foreach ($leave->user->leader->leader->getRoleNames() as $v)
                            <p class="line-height-s font-15 font-800 text-right">{{ $v }}</p>
                        @endforeach
                    @endif
                </div>
                @else
                @endif

                <div class="col-12 mb-n4 mt-n4"></div>

                <div class="col-6">
                    <p class="color-theme font-15 font-800">Menyetujui</p>
                </div>
                @if ($leave->user->leader->leader) 
                <div class="col-6">
                    <p class="color-theme font-15 font-800 text-right">Menyetujui</p>
                </div>    
                @else
                @endif
            </div>
        </div>
    </div>

    <a href="#" class="btn btn-full btn-margins  bg-highlight btn-m text-uppercase font-900 rounded-s shadow-xl">
        <i class="fas fa-cloud-download-alt">&nbsp;</i>Download Form
     </a>
</div>

@endsection