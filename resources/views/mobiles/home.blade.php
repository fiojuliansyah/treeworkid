@extends('mobiles.layouts.app')


@section('content')
    <div class="page-content">
        <div class="card header-card shape-rounded" data-card-height="250">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-bg preload-img" data-src="{{ asset('') }}mobile/images/pictures/18s.jpg"></div>
        </div>
        <div class="page-title page-title-small" style="margin-top: 50px">
            <div class="d-flex content mb-1">
                <div class="flex-grow-1 mt-2">
                    <h1 class="font-700" style="color: white">{{ Auth::user()->name ?? 'Guest' }}</h1>
                    <p class="mb-2" style="color: white">
                        {{ Auth::user()->email ?? 'Guest' }}
                    </p>
                </div>
                <a href="{{ route('mobile.setting') }}">
                    <img src="{{ Auth::user()->profile['avatar_url'] ?? '/assets/media/avatars/blank.png' }}" width="70"
                        height="70" class="bg-highlight rounded-circle shadow-xl">
                </a>
            </div>
        </div>
        <div class="card card-style">
            <div class="content">
                <div class="row">
                    <div class="col-9" style="color: black">
                        <strong id="clock"></strong> &nbsp; | &nbsp;
                        <strong id="date"></strong>
                        <div>
                            <strong><i class="fa fa-map-pin">&nbsp&nbsp</i>{{ Auth::user()->site['name'] ?? 'Guest' }}
                            </strong>
                            <p>No shift information available</p>
                        </div>
                    </div>
                    <div class="col-3 pt-2">
                        <div class="text-center">
                            @if ($clockOutStatus)

                            @else
                                @if ($clockInStatus)
                                    <a href="{{ route('attendance.index') }}" class="btn rounded-xl bg-highlight">
                                        <span style="display: block; text-align: center;">
                                            <i class="fa fa-sign-out" style="font-size: 12px">&nbsp</i>
                                        </span>
                                    </a>
                                    <p style="color: black">Clock Out</p>
                                @else
                                    <a href="{{ route('attendance.index') }}" class="btn rounded-xl bg-highlight">
                                        <span style="display: block; text-align: center;">
                                            <i class="fa fa-sign-in" style="font-size: 12px">&nbsp</i>
                                        </span>
                                    </a>
                                    <p style="color: black">Clock In</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        @if ($clockInStatus)
                        <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight">
                            <span style="display: block; text-align: center;">
                                START TIME
                            </span>
                            <span style="display: block; text-align: center;">
                                {{ \Carbon\Carbon::parse($latestAttendance->clock_in)->format('H:i') ?? '- - : - -' }}
                            </span>
                        </a>
                        @else
                        <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-secondary">
                            <span style="display: block; text-align: center;">
                                START TIME
                            </span>
                            <span style="display: block; text-align: center;">
                                - - : - -
                            </span>
                        </a>
                        @endif
                    </div>
                    <div class="col-6">
                        @if ($clockOutStatus)
                        <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight">
                            <span style="display: block; text-align: center;">
                                END TIME
                            </span>
                            <span style="display: block; text-align: center;">
                                {{ \Carbon\Carbon::parse($latestAttendance->clock_out)->format('H:i') ?? '- - : - -' }}
                            </span>
                        </a>
                        @else
                        <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-secondary">
                            <span style="display: block; text-align: center;">
                                END TIME
                            </span>
                            <span style="display: block; text-align: center;">
                                - - : - -
                            </span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="content" style="margin-top: 60px">
            <h5 class="float-start font-16 font-600">Happy Customers</h5>
            <div class="clearfix"></div>
        </div> --}}
        <div class="row me-0 ms-0 mb-0" style="margin-top: 20px; padding-left: 20px; padding-right: 20px">
            <div class="col-3 ps-0 pe-0">
                <a href="{{ route('attendance.index') }}" class="icon-user"
                    style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <img src="https://img.icons8.com/?size=256&id=dAfquhWBFKe3&format=png" alt="" width="50px"
                        style="margin-bottom: 5px; border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; margin: 5px; box-sizing: border-box;">
                    <div style="display: flex; align-items: center;">
                        <p style="margin: 0;">Presensi</p>
                    </div>
                </a>       
            </div>
            <div class="col-3 pe-0 ps-0">
                <a href="{{ route('overtime.index') }}" class="icon-user"
                    style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <img src="https://img.icons8.com/fluency/48/hourglass-sand-bottom.png" alt="" width="50px"
                        style="margin-bottom: 5px; border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; margin: 5px; box-sizing: border-box;">
                    <div style="display: flex; align-items: center;">
                        <p style="margin: 0;">Lembur</p>
                    </div>
                </a>       
            </div>
            <div class="col-3 pe-0 ps-0">
                <a href="{{ route('minute.index') }}" class="icon-user"
                    style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <img src="https://img.icons8.com/color-glass/48/task.png" alt="" width="50px"
                        style="margin-bottom: 5px; border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; margin: 5px; box-sizing: border-box;">
                    <div style="display: flex; align-items: center;">
                        <p style="margin: 0;">Berita Acara</p>
                    </div>
                </a>      
            </div>
            <div class="col-3 pe-0 ps-0">
                <a href="{{ route('leave.index') }}" class="icon-user"
                    style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <img src="https://img.icons8.com/color-glass/48/exit.png" alt="" width="50px"
                        style="margin-bottom: 5px; border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; margin: 5px; box-sizing: border-box;">
                    <div style="display: flex; align-items: center;">
                        <p style="margin: 0;">Cuti</p>
                    </div>
                </a>       
            </div>
        </div>
        <div class="row me-0 ms-0 mb-0" style="margin-top: 10px; padding-left: 20px; padding-right: 20px">
            <div class="col-3 ps-0 pe-0">
                <a href="{{ route('reliver.index') }}" class="icon-user"
                    style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <img src="https://img.icons8.com/?size=256&id=23282&format=png" alt="" width="50px"
                        style="margin-bottom: 5px; border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; margin: 5px; box-sizing: border-box;">
                    <div style="display: flex; align-items: center;">
                        <p style="margin: 0;">Reliver</p>
                    </div>
                </a>       
            </div>
        </div>
        <div class="content mb-2">
            <h5 class="float-start font-16 font-500">App Module &nbsp;</h5><span class="badge bg-danger">soon</span>
            <a class="float-end font-12 color-highlight mt-n1" href="#">View All</a>
            <div class="clearfix"></div>
        </div>

        <div class="splide double-slider visible-slider slider-no-arrows slider-no-dots" id="double-slider-1">
            <div class="splide__track">
                <div class="splide__list">
                    <div class="splide__slide ps-3">
                        <div class="bg-theme rounded-m shadow-m text-center">
                        <img src="https://img.icons8.com/?size=256&id=12850&format=png" alt="" width="80px"" class="mt-3">
                        <h5 class="font-16">Cleaning</h5>
                        <p class="line-height-s font-11 pb-4">
                            Built with care and <br>every detail in mind
                        </p>
                        </div>
                    </div>
                    <div class="splide__slide ps-3">
                        <div class="bg-theme rounded-m shadow-m text-center">
                        <img src="https://img.icons8.com/?size=256&id=jOAIkIGgvYmp&format=png" alt="" width="80px"" class="mt-3">
                        <h5 class="font-16">Digital Patrol</h5>
                        <p class="line-height-s font-11 pb-4">
                            Built with care and <br>every detail in mind
                        </p>
                        </div>
                    </div>
                    <div class="splide__slide ps-3">
                        <div class="bg-theme rounded-m shadow-m text-center">
                        <img src="https://img.icons8.com/?size=256&id=PEIZi5jOSErg&format=png" alt="" width="80px"" class="mt-3">
                        <h5 class="font-16">Civil</h5>
                        <p class="line-height-s font-11 pb-4">
                            Built with care and <br>every detail in mind
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function getServerTime() {
            return $.ajax({
                async: false
            }).getResponseHeader('Date');
        }

        function realtimeClock() {
            var rtClock = new Date();

            var hours = rtClock.getHours();
            var minutes = rtClock.getMinutes();
            var seconds = rtClock.getSeconds();
            var day = rtClock.toLocaleDateString('id-ID', {
                weekday: 'long'
            });
            var date = rtClock.toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            hours = ("0" + hours).slice(-2);
            minutes = ("0" + minutes).slice(-2);
            seconds = ("0" + seconds).slice(-2);

            document.getElementById("clock").innerHTML =
                hours + " : " + minutes + " : " + seconds;
            document.getElementById("date").innerHTML =
                day + ", " + date;

            var jamnya = setTimeout(realtimeClock, 500);
        }

        window.onload = function() {
            realtimeClock();
        };
    </script>
@endpush
