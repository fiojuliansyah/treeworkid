@extends('mobiles.layouts.app')


@section('content')
    <div class="page-content">
        <div class="card header-card shape-rounded" data-card-height="250">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-bg preload-img" data-src="/assets/mobiles/images/pictures/18s.jpg"></div>
        </div>
        <div class="page-title page-title-small" style="margin-top: 50px">
            <div class="d-flex content mb-1">
                <div class="flex-grow-1 mt-2">
                    <h1 class="font-700" style="color: white">{{ Auth::user()->name ?? 'Guest' }}</h1>
                    <p class="mb-2" style="color: white">
                        {{ Auth::user()->email ?? 'Guest' }}
                    </p>
                </div>
                <a href="{{ route('mobile.setting') }}" class="fourth">
                    <img src="{{ Auth::user()->profile['avatar_url'] ?? '/assets/media/avatars/blank.png' }}" width="70"
                        height="70" class="bg-highlight rounded-circle shadow-xl">
                </a>
            </div>
        </div>
        <div class="card card-style first">
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
                    <div class="col-3 pt-2 second">
                        <div class="text-center">
                            @if ($latestAttendance && $latestAttendance->clock_out != null)     
                                <a href="{{ route('attendance.index') }}" class="btn rounded-xl bg-highlight">
                                    <span style="display: block; text-align: center;">
                                        <i class="fa fa-sign-in" style="font-size: 12px">&nbsp</i>
                                    </span>
                                </a>
                                <p style="color: black">Masuk</p>
                            @else
                                @if ($latestClockIn)
                                    <a href="{{ route('attendance.index') }}" class="btn rounded-xl bg-highlight">
                                        <span style="display: block; text-align: center;">
                                            <i class="fa fa-sign-out" style="font-size: 12px">&nbsp</i>
                                        </span>
                                    </a>
                                    <p style="color: black">Pulang</p>
                                @else
                                    @if ($latestAttendance && $latestAttendance->clock_out == null)
                                        <a href="{{ route('attendance.index') }}" class="btn rounded-xl bg-highlight">
                                            <span style="display: block; text-align: center;">
                                                <i class="fa fa-sign-out" style="font-size: 12px">&nbsp</i>
                                            </span>
                                        </a>
                                        <p style="color: black">Pulang</p>
                                    @else
                                        <a href="{{ route('attendance.index') }}" class="btn rounded-xl bg-highlight">
                                            <span style="display: block; text-align: center;">
                                                <i class="fa fa-sign-in" style="font-size: 12px">&nbsp</i>
                                            </span>
                                        </a>
                                        <p style="color: black">Masuk</p>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                @if ($latestAttendance && $latestAttendance->type == 'shift_off')
                <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-red-dark">
                    <span style="display: block; text-align: center;">
                        LIBUR
                    </span>
                </a>
                @else
                    <strong>Last Attendance</strong
                    <br>
                    <p class="mb-2">
                        @if($latestAttendance && $latestAttendance->date)
                        {{ $latestAttendance->date->format('d M Y') }}
                        @endif
                        @if ($latestAttendance && $latestAttendance->clock_out)
                        - 
                        {{ $latestAttendance->clock_out->format('d M Y') }}</p>
                        @else
                        @endif
                    <div class="row mb-2">
                        <div class="col-6">
                            @if ($latestClockIn)
                                <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl
                                    @if($latestAttendance && $latestAttendance->clock_in)
                                    bg-highlight
                                    @else
                                    bg-secondary
                                    @endif
                                    ">
                                    <span style="display: block; text-align: center;">
                                        START TIME
                                    </span>
                                    <span style="display: block; text-align: center;">
                                        @if($latestAttendance && $latestAttendance->clock_in)
                                        {{ $latestAttendance->clock_in->format('H:i') }}
                                        @else
                                            - - : - -
                                        @endif
                                    </span>
                                </a>
                            @else
                                @if ($latestAttendance && $latestAttendance->clock_in == null)
                                    <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-secondary
                                        ">
                                        <span style="display: block; text-align: center;">
                                            START TIME
                                        </span>
                                        <span style="display: block; text-align: center;">
                                                - - : - -
                                        </span>
                                    </a>
                                @else
                                    <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl
                                        @if($latestAttendance && $latestAttendance->clock_in)
                                        bg-highlight
                                        @else
                                        bg-secondary
                                        @endif
                                        ">
                                        <span style="display: block; text-align: center;">
                                            START TIME
                                        </span>
                                        <span style="display: block; text-align: center;">
                                            @if($latestAttendance && $latestAttendance->clock_in)
                                            {{ $latestAttendance->clock_in->format('H:i') }}
                                            @else
                                                - - : - -
                                            @endif
                                        </span>
                                    </a>
                                @endif
                            @endif
                        </div>
                        <div class="col-6">
                            <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl
                                @if($latestAttendance && $latestAttendance->clock_out != null)
                                bg-highlight
                                @else
                                bg-secondary
                                @endif
                                ">
                                <span style="display: block; text-align: center;">
                                    END TIME
                                </span>
                                <span style="display: block; text-align: center;">
                                    @if($latestAttendance && $latestAttendance->clock_out != null)
                                    {{ $latestAttendance->clock_out->format('H:i') }}
                                    @else
                                        - - : - -
                                    @endif
                                </span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        {{-- <div class="content" style="margin-top: 60px">
            <h5 class="float-start font-16 font-600">Happy Customers</h5>
            <div class="clearfix"></div>
        </div> --}}
        @can('attendance-module')
            <div class="row me-0 ms-0 mb-0 third" style="margin-top: 20px;">
                <div class="col-3 ps-0 pe-0">
                    <a href="{{ route('attendance.logs') }}" class="icon-user"
                        style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                        <img src="https://img.icons8.com/?size=256&id=IYGgeCVcNuB1&format=png" alt="" width="50px"
                            style="margin-bottom: 5px; border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; margin: 5px; box-sizing: border-box;">
                        <div style="display: flex; align-items: center;">
                            <p style="margin: 0;">Riwayat</p>
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
                            <p style="margin: 0;">Ketidakhadiran</p>
                        </div>
                    </a>       
                </div>
                <div class="col-3 ps-0 pe-0 pt-3">
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
        @endcan

        @can('work-module') 
            <div class="content mb-2">
                <h5 class="float-start font-16 font-500">App Module &nbsp;</h5><span class="badge bg-danger">soon</span>
                <a class="float-end font-12 color-highlight mt-n1" href="#">View All</a>
                <div class="clearfix"></div>
            </div>
            <div class="splide double-slider visible-slider slider-no-arrows slider-no-dots" id="double-slider-1">
                <div class="splide__track">
                    <div class="splide__list">
                        @can('cleaning-app') 
                            <div class="splide__slide ps-3">
                                <div class="bg-theme rounded-m shadow-m text-center">
                                <img src="https://img.icons8.com/?size=256&id=12850&format=png" alt="" width="80px"" class="mt-3">
                                <h5 class="font-16">Cleaning</h5>
                                <p class="line-height-s font-11 pb-4">
                                    Built with care and <br>every detail in mind
                                </p>
                                </div>
                            </div>
                        @endcan
                        @can('security-app')
                        <div class="splide__slide ps-3">
                            <div class="bg-theme rounded-m shadow-m text-center">
                            <img src="https://img.icons8.com/?size=256&id=jOAIkIGgvYmp&format=png" alt="" width="80px"" class="mt-3">
                            <h5 class="font-16">Digital Patrol</h5>
                            <p class="line-height-s font-11 pb-4">
                                Built with care and <br>every detail in mind
                            </p>
                            </div>
                        </div>
                        @endcan
                        @can('civil-app')
                        <div class="splide__slide ps-3">
                            <div class="bg-theme rounded-m shadow-m text-center">
                            <img src="https://img.icons8.com/?size=256&id=PEIZi5jOSErg&format=png" alt="" width="80px"" class="mt-3">
                            <h5 class="font-16">Civil</h5>
                            <p class="line-height-s font-11 pb-4">
                                Built with care and <br>every detail in mind
                            </p>
                            </div>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection
@push('js')
    <script data-navigate-track>
        introJs().setOptions({
            steps:[{
            title: 'Selamat Datang',
            intro: 'Selamat datang di sistem kami! Tutorial ini akan membantu Anda memahami fitur-fitur penting yang tersedia.'
        },
        {
            element: document.querySelector('.first'),
            title: 'Absensi',
            intro: 'Di sini Anda dapat melihat status absensi Anda, termasuk kehadiran harian dan riwayat cuti.'
        },
        {
            element: document.querySelector('.second'),
            title: 'Absensi',
            intro: 'Gunakan fitur ini untuk mencatat waktu masuk dan pulang kerja secara real-time dengan mudah.'
        },
        {
            element: document.querySelector('.third'),
            title: 'Modul Fitur',
            intro: 'Di bagian ini, Anda akan menemukan berbagai modul yang dapat digunakan untuk mengelola informasi dan laporan terkait pekerjaan Anda.'
        },
        {
            element: document.querySelector('.fourth'),
            title: 'Informasi',
            intro: 'Di bagian ini, Anda bisa melihat informasi akun terkait pekerjaan Anda.'
        }],
            dontShowAgain: true,
        }).start();
    </script>
    <script data-navigate-track>
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
