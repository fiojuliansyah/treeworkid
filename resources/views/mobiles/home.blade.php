@extends('mobiles.layouts.app')


@section('content')
    <div class="page-content">
        <div class="card header-card shape-rounded" data-card-height="250">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-bg preload-img" data-src="/assets/mobiles/images/pictures/18s.jpg"></div>
        </div>
        <div class="page-title page-title-small">
            <div class="d-flex content mb-1">
                <div class="flex-grow-1 mt-2 mb-1">
                    <h1 class="font-700" style="color: black">{{ Auth::user()->name ?? 'Guest' }}</h1>
                    <p class="mb-2" style="color: black">
                        @if (!empty(Auth::user()->getRoleNames()))
                            @foreach (Auth::user()->getRoleNames() as $v)
                                {{ $v }}
                            @endforeach
                        @endif
                    </p>
                </div>
                <a href="{{ route('mobile.setting') }}" class="fourth">
                    <img src="{{ Auth::user()->profile['avatar_url'] ?? '/assets/media/avatars/blank.png' }}" width="70"
                        height="70" class="bg-highlight rounded-circle shadow-xl">
                </a>
            </div>
        </div>
        <marquee behavior="" direction="left">
            <h6>Pastikan Anda Absen Hari ini!</h6>
        </marquee>
        <div class="card card-style first">
            <div class="content">
                <strong id="clock"></strong> &nbsp; | &nbsp;
                <strong id="date"></strong>
                <div>
                    <strong><i class="fa fa-map-pin">&nbsp&nbsp</i>{{ Auth::user()->site['name'] ?? 'Guest' }}
                    </strong>
                    <p>No shift information available</p>
                </div>
                <br>
                @if ($latestAttendance && $latestAttendance->type == 'shift_off')
                    <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-red-dark">
                        <span style="display: block; text-align: center;">
                            LIBUR
                        </span>
                    </a>
                @else
                    <div class="row mb-2">
                        <div class="col-6">
                            @if ($latestClockIn)
                                <a href="{{ route('attendance.index') }}"
                                    class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl
                                    @if ($latestAttendance && $latestAttendance->clock_in) bg-green-dark
                                    @else
                                    bg-secondary @endif
                                    ">
                                    <span style="display: block; text-align: center; color: black">
                                        MASUK
                                    </span>
                                    <span style="display: block; text-align: center; color: black">
                                        @if ($latestAttendance && $latestAttendance->clock_in)
                                            {{ $latestAttendance->clock_in->format('H:i') }}
                                        @else
                                            - - : - -
                                        @endif
                                    </span>
                                </a>
                            @else
                                @if ($latestAttendance && $latestAttendance->clock_in == null)
                                    <a href="{{ route('attendance.index') }}"
                                        class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight
                                        ">
                                        <span style="display: block; text-align: center; color: black">
                                            MASUK
                                        </span>
                                        <span style="display: block; text-align: center; color: black">
                                            - - : - -
                                        </span>
                                    </a>
                                @else
                                    <a href="{{ route('attendance.index') }}"
                                        class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl
                                        @if ($latestAttendance && $latestAttendance->clock_in) bg-green-dark
                                        @else
                                        bg-highlight @endif
                                        ">
                                        <span style="display: block; text-align: center; color: black">
                                            MASUK
                                        </span>
                                        <span style="display: block; text-align: center; color: black">
                                            @if ($latestAttendance && $latestAttendance->clock_in)
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
                            <a href="#"
                                class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl
                                @if ($latestAttendance && $latestAttendance->clock_out != null) bg-green-dark
                                @else
                                bg-highlight @endif
                                ">
                                <span style="display: block; text-align: center; color: black">
                                    PULANG
                                </span>
                                <span style="display: block; text-align: center; color: black">
                                    @if ($latestAttendance && $latestAttendance->clock_out != null)
                                        {{ $latestAttendance->clock_out->format('H:i') }}
                                    @else
                                        - - : - -
                                    @endif
                                </span>
                            </a>
                        </div>
                    </div>
                @endif
                <div class="row mb-2 mt-4">
                    @if ($latestLeave)
                        @if ($latestLeave->image_url == null)
                            <div class="col-3" style="position: relative;">
                                <a href="{{ route('leave.show', $latestLeave->id) }}"
                                    class="btn btn-xs rounded-s text-uppercase font-900 bg-yellow-dark fourth">
                                    <p style="color: black; margin: 0;">SAKIT</p>
                                </a>
                                <span
                                    style="background-color: red; width: 10px; height: 10px; border-radius: 50%; position: absolute; top: 0px; right: 9px;"></span>
                            </div>
                        @else
                            <div class="col-3" style="position: relative;">
                                <a href="#" data-menu="menu-sakit"
                                    class="btn btn-xs rounded-s text-uppercase font-900 bg-yellow-dark fourth">
                                    <p style="color: black; margin: 0;">SAKIT</p>
                                </a>
                            </div>
                        @endif

                    @else
                    <div class="col-3" style="position: relative;">
                        <a href="#" data-menu="menu-sakit"
                            class="btn btn-xs rounded-s text-uppercase font-900 bg-yellow-dark fourth">
                            <p style="color: black; margin: 0;">SAKIT</p>
                        </a>
                    </div>
                    @endif
                    <div class="col-3" style="position: relative;">
                        <a href="#" data-menu="menu-ijin"
                            class="btn btn-xs rounded-s text-uppercase font-900 bg-yellow-dark fourth">
                            <p style="color: black; margin: 0;">IJIN</p>
                        </a>
                    </div>
                    <div class="col-3" style="position: relative;">
                        <a href="#" data-menu="menu-cuti"
                            class="btn btn-xs rounded-s text-uppercase font-900 bg-yellow-dark fourth">
                            <p style="color: black; margin: 0;">CUTI</p>
                        </a>
                    </div>
                    <div class="col-3" style="position: relative;">
                        <a href="#" data-menu="menu-confirm"
                            class="btn btn-xs rounded-s text-uppercase font-900 bg-red-dark fourth">
                            LIBUR
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @if ($latestLeave)
            @if ($latestLeave->image_url == null)
                <div class="alert me-31 ms-3 rounded-s bg-red-dark " role="alert">
                    <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                    <h4 class="text-uppercase color-white">Peringatan</h4>
                    <strong class="alert-icon-text">
                        <marquee behavior="" direction="left">Anda belum memasukan lampiran! batas maksimal upload H+3
                        </marquee>
                    </strong>
                    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert"
                        aria-label="Close">&times;</button>
                </div>
                {{-- <div class="content" style="margin-top: 60px">
                <h5 class="float-start font-16 font-600">Happy Customers</h5>
                <div class="clearfix"></div>
            </div> --}}
            @else
            @endif
        @endif
        @can('attendance-module')
            <div class="row me-0 ms-0 mb-0 third" style="margin-top: 20px;">
                <div class="col-3 ps-0 pe-0">
                    <a href="{{ route('reliver.index') }}" class="icon-user"
                        style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                        <img src="/assets/mobiles/images/icons/reliver.png" alt="" width="50px"
                            style="margin-bottom: 5px; border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; margin: 5px; box-sizing: border-box;">
                        <div style="display: flex; align-items: center;">
                            <p style="margin: 0;">Reliver</p>
                        </div>
                    </a>
                </div>
                <div class="col-3 pe-0 ps-0">
                    <a href="{{ route('overtime.index') }}" class="icon-user"
                        style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                        <img src="/assets/mobiles/images/icons/overtime.png" alt="" width="50px"
                            style="margin-bottom: 5px; border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; margin: 5px; box-sizing: border-box;">
                        <div style="display: flex; align-items: center;">
                            <p style="margin: 0;">Lembur</p>
                        </div>
                    </a>
                </div>
                <div class="col-3 pe-0 ps-0">
                    <a href="{{ route('minute.index') }}" class="icon-user"
                        style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                        <img src="/assets/mobiles/images/icons/form.png" alt="" width="50px"
                            style="margin-bottom: 5px; border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; margin: 5px; box-sizing: border-box;">
                        <div style="display: flex; align-items: center;">
                            <p style="margin: 0;">Berita Acara</p>
                        </div>
                    </a>
                </div>
                <div class="col-3 ps-0 pe-0">
                    <a href="{{ route('attendance.logs') }}" class="icon-user"
                        style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                        <img src="/assets/mobiles/images/icons/history.png" alt="" width="50px"
                            style="margin-bottom: 5px; border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; margin: 5px; box-sizing: border-box;">
                        <div style="display: flex; align-items: center;">
                            <p style="margin: 0;">Riwayat</p>
                        </div>
                    </a>
                </div>
            </div>
        @endcan
        {{-- @can('work-module') 
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
        @endcan --}}
    </div>
@endsection
@section('modal')
    <div id="menu-sakit" class="menu menu-box-modal rounded-m" data-menu-height="200" data-menu-width="320">
        <h1 class="text-center font-700 mt-3 pb-1">Buat surat Sakit?</h1>
        <p class="boxed-text-l">
            Jika ingin melanjutkan, pastikan Anda benar-benar yakin untuk menyetujui!
        </p>
        <div class="row me-3 ms-3 mb-0">
            <div class="col-6">
                <a href="{{ route('leave.create.main', ['slug' => 'sakit']) }}"
                    class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-green-dark">IYA</a>
            </div>
            <div class="col-6">
                <a href="#"
                    class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-red-dark">TUTUP</a>
            </div>
        </div>
    </div>
    <div id="menu-ijin" class="menu menu-box-modal rounded-m" data-menu-height="200" data-menu-width="320">
        <h1 class="text-center font-700 mt-3 pb-1">Buat surat Ijin?</h1>
        <p class="boxed-text-l">
            Jika ingin melanjutkan, pastikan Anda benar-benar yakin untuk menyetujui!
        </p>
        <div class="row me-3 ms-3 mb-0">
            <div class="col-6">
                <a href="{{ route('leave.create.main', ['slug' => 'ijin']) }}"
                    class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-green-dark">IYA</a>
            </div>
            <div class="col-6">
                <a href="#"
                    class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-red-dark">TUTUP</a>
            </div>
        </div>
    </div>
    <div id="menu-cuti" class="menu menu-box-modal rounded-m" data-menu-height="200" data-menu-width="320">
        <h1 class="text-center font-700 mt-3 pb-1">Buat surat Cuti?</h1>
        <p class="boxed-text-l">
            Jika ingin melanjutkan, pastikan Anda benar-benar yakin untuk menyetujui!
        </p>
        <div class="row me-3 ms-3 mb-0">
            <div class="col-6">
                <a href="{{ route('leave.create.main', ['slug' => 'cuti']) }}"
                    class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-green-dark">IYA</a>
            </div>
            <div class="col-6">
                <a href="#"
                    class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-red-dark">TUTUP</a>
            </div>
        </div>
    </div>
    <div id="menu-confirm" class="menu menu-box-modal rounded-m" data-menu-height="200" data-menu-width="320">
        <h1 class="text-center font-700 mt-3 pb-1">Apakah kamu yakin?</h1>
        <p class="boxed-text-l">
            Jika ingin melanjutkan, pastikan Anda benar-benar yakin untuk menyetujui!
        </p>
        <div class="row me-3 ms-3 mb-0">
            <form class="form" action="{{ route('attendance.off') }}" method="POST" id="attendanceOff">
                @csrf
            </form>
            <div class="col-6">
                <a href="#" onclick="event.preventDefault(); document.getElementById('attendanceOff').submit();"
                    class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-green-dark">IYA</a>
            </div>
            <div class="col-6">
                <a href="#"
                    class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-red-dark">TUTUP</a>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        introJs().setOptions({
            steps: [{
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
                }
            ],
            dontShowAgain: true,
        }).start();
    </script>
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
