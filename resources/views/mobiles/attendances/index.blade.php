@extends('mobiles.layouts.module')


@section('content')
<div class="page-content">  
    <div class="page-title page-title-small" style="margin-top: 50px">
        <a href="{{ route('mobile.home') }}" class="btn rounded-xl" style="background-color: #1CB3CA">
            <span style="display: block; text-align: center;">
                <i class="fa fa-arrow-left" style="font-size: 12px">&nbsp</i>
            </span>
        </a>
    </div>
    <div class="card header-card first">
        <a href="#" class="get-location btn btn-full btn-m bg-red2-dark rounded-sm text-uppercase shadow-l font-900" style="display: none">Show My Location</a>
        <p class="location-coordinates" style="display: none"></p>
        <div id="map" style="height: 400px"></div>
    </div>
    <div class="content" style="margin-top: 360px">
        <div class="row">
            <div class="col-2 pt-2">
                <div class="btn rounded-xl bg-blue-dark">
                    <span style="display: block; text-align: center;">
                        <i class="fas fa-calendar-check" style="font-size: 15px"></i>
                    </span>
                </div>
            </div>
            <div class="col-8">
                <strong id="date" style="color: black"></strong>
                <br>
                <strong id="clock"></strong>
            </div>
            <div class="col-2 pt-2 second">
                <a href="#" onclick="refreshMap()" class="btn rounded-xl bg-yellow-dark">
                    <span style="display: block; text-align: center;">
                        <i class="fas fa-map-marker-alt" style="font-size: 15px"></i>
                    </span>
                </a>
            </div>
        </div>
        <div style="border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; box-sizing: border-box;">
            <div class="row third">
                <div class="col-4">
                    <strong style="color: black">Judul Shift</strong>
                    <br>
                    <strong style="color: black">Lokasi</strong>
                    <br>
                    <strong style="color: black">Waktu Kerja</strong>
                    <br>
                    <strong style="color: black">status</strong>
                </div>
                <div class="col-8">
                    <small style="color: black">No shift information available</small>
                    <br>
                    <small style="color: black">{{ Auth::user()->site['name'] }}</small>
                    <br>
                    <small style="color: black">No shift information available</small>
                    <br>
                    @if ($latestAttendance && $latestAttendance->clock_out == Null)
                        <span class="badge bg-success">clock out</span>   
                    @else
                        <span class="badge bg-success">clock in</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="mb-2 pt-1 mt-2">
            <h5 class="font-16 font-500">Absen Terakhir</h5>
            <div class="clearfix"></div>
            <table class="table table-borderless text-center rounded-sm" style="overflow: hidden;">
                <thead>
                    <tr class="bg-blue1-dark">
                        <th scope="col" class="color-theme">Tanggal</th>
                        <th scope="col" class="color-theme">Clock In</th>
                        <th scope="col" class="color-theme">Clock Out</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)     
                    <tr>
                        <th scope="row">{{ $log->date->format('d-M-Y') ?? '' }}</th>
                        <td>
                            <a href="#" data-menu="menu-maps-in" class="color-green1-dark">
                                @if($log->clock_in)
                                    {{ $log->clock_in->format('H:i') }}
                                @else
                                    --:--
                                @endif
                            </a>
                        </td>
                        <td>
                            <a href="#" data-menu="menu-maps-out" class="color-red1-dark">
                                @if($log->clock_out)
                                    {{ $log->clock_out->format('H:i') }}
                                @else
                                    --:--
                                @endif
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="ad-300x50 ad-300x50-fixed">
        <div class="content fiveth">
            @if ($latestClockOut)
            @else
                @if ($latestClockIn)
                    <a href="{{ route('attendance.clockout') }}" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight clock-out-btn">
                        <i class="fas fa-camera">&nbsp;</i>Pulang
                    </a>
                @else
                    @if ($latestAttendance && $latestAttendance->clock_out == Null)
                        <a href="{{ route('attendance.clockout') }}" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight clock-out-btn">
                            <i class="fas fa-camera">&nbsp;</i>Pulang
                        </a>
                    @else
                        <a href="{{ route('attendance.clockin') }}" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight clock-in-btn">
                            <i class="fas fa-camera">&nbsp;</i>Masuk
                        </a>
                    @endif
                @endif
            @endif
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    introJs().setOptions({
            steps:[{
            title: 'Selamat Datang',
            intro: 'Tutorial ini akan membantu Anda memahami fitur-fitur penting yang tersedia.'
        },
        {
            element: document.querySelector('.first'),
            title: 'Absensi',
            intro: 'Di sini Anda dapat melihat radius untuk melakukan absen pada MAP.'
        },
        {
            element: document.querySelector('.second'),
            title: 'MAP',
            intro: 'Gunakan fitur ini untuk mengkalibrasi map anda jika terjadi gangguan.'
        },
        {
            element: document.querySelector('.third'),
            title: 'Absensi',
            intro: 'Di bagian ini, adalah informasi terkait jadwal masuk dan pulang Anda.'
        },
        {
            element: document.querySelector('.fourth'),
            title: 'Absensi',
            intro: 'Fitur ini digunakan ketika anda tidak mempunyai jadwal libur dan bisa melakukan secara manual.'
        },
        {
            element: document.querySelector('.fiveth'),
            title: 'Absensi',
            intro: 'Tombol ini digunakan untuk anda melakukan absen masuk dan absen pulang.'
        }],
            dontShowAgain: true,
        }).start();
</script>
<script>
    function getServerTime() {
        return $.ajax({ async: false }).getResponseHeader('Date');
    }

    function realtimeClock() {
        var rtClock = new Date();

        var hours = rtClock.getHours();
        var minutes = rtClock.getMinutes();
        var seconds = rtClock.getSeconds();
        var day = rtClock.toLocaleDateString('id-ID', { weekday: 'long' });
        var date = rtClock.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });

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
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map;
    var userLat = @json(Auth::user()->site['lat']);
    var userLong = @json(Auth::user()->site['long']);
    var radius = @json(Auth::user()->site['radius']);
    var mobileDepartment = @json(Auth::user()->department_id);

    function geoLocate() {
        const locationCoordinates = document.querySelector('.location-coordinates');
        const clockInButton = document.querySelectorAll('.clock-in-btn');
        const clockOutButton = document.querySelectorAll('.clock-out-btn');
        const disableButton = document.querySelectorAll('.bg-highlight');

        function success(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            locationCoordinates.innerHTML = '<strong>Longitude:</strong> ' + longitude + '<br><strong>Latitude:</strong> ' + latitude;

            if (!map) {
                map = L.map('map', {
                    zoomControl: false
                }).setView([latitude, longitude], 16);

                L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }).addTo(map);

                // Add initial marker and circle
                addMapMarkersAndCircles(latitude, longitude);

            } else {
                // Update map view without recreating the map
                map.setView([latitude, longitude], 16);
                updateMapMarkersAndCircles(latitude, longitude);
            }

            const distance = haversineDistance(latitude, longitude, userLat, userLong) * 1000;

            updateButtonStates(distance);
            document.querySelector('.get-location').setAttribute('href', `https://www.google.com/maps?q=${latitude},${longitude}&z=16`);
        }

        function error() {
            locationCoordinates.textContent = 'Unable to retrieve your location';
        }

        if (!navigator.geolocation) {
            locationCoordinates.textContent = 'Geolocation is not supported by your browser';
        } else {
            locationCoordinates.textContent = 'Locating…';
            navigator.geolocation.getCurrentPosition(success, error);
        }
    }

    function addMapMarkersAndCircles(lat, lon) {
        if (mobileDepartment == '2') {
            const customIcon = L.icon({
                iconUrl: 'https://img.icons8.com/?size=256&id=114446&format=png',
                iconSize: [48],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });
            L.marker([lat, lon], { icon: customIcon }).addTo(map)
                .bindPopup('Status absensi anda bisa dimana saja!')
                .openPopup();
        } else {
            const customIcon = L.icon({
                iconUrl: 'https://img.icons8.com/?size=256&id=13783&format=png',
                iconSize: [48],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });
            L.marker([lat, lon], { icon: customIcon }).addTo(map)
                .bindPopup('Pastikan anda dalam radius absen!')
                .openPopup();

            L.circle([userLat, userLong], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        }
    }

    function updateMapMarkersAndCircles(lat, lon) {
        map.eachLayer(function (layer) {
            if (layer instanceof L.Marker || layer instanceof L.Circle) {
                map.removeLayer(layer);
            }
        });
        addMapMarkersAndCircles(lat, lon);
    }

    function updateButtonStates(distance) {
        const clockInButton = document.querySelectorAll('.clock-in-btn');
        const clockOutButton = document.querySelectorAll('.clock-out-btn');
        const disableButton = document.querySelectorAll('.bg-highlight');

        clockInButton.forEach(button => {
            if (mobileDepartment == '2' || distance <= radius) {
                button.classList.remove('btn-secondary');
                button.classList.add('bg-highlight');
                button.style.pointerEvents = 'auto';
            } else {
                button.classList.remove('bg-highlight');
                button.classList.add('btn-secondary');
                button.style.pointerEvents = 'none';
            }
        });

        clockOutButton.forEach(button => {
            if (mobileDepartment == '2' || distance <= radius) {
                button.classList.remove('btn-secondary');
                button.classList.add('bg-highlight');
                button.style.pointerEvents = 'auto';
            } else {
                button.classList.remove('bg-highlight');
                button.classList.add('btn-secondary');
                button.style.pointerEvents = 'none';
            }
        });

        disableButton.forEach(button => {
            if (mobileDepartment == '2' || distance <= radius) {
                button.classList.remove('btn-secondary');
                button.classList.add('bg-highlight');
                button.style.pointerEvents = 'auto';
            } else {
                button.classList.remove('bg-highlight');
                button.classList.add('btn-secondary');
                button.style.pointerEvents = 'none';
            }
        });
    }

    function haversineDistance(lat1, lon1, lat2, lon2) {
        const R = 6371;
        const dLat = (lat2 - lat1) * (Math.PI / 180);
        const dLon = (lon2 - lon1) * (Math.PI / 180);
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    document.addEventListener('DOMContentLoaded', function() {
        geoLocate();
    });

    function refreshMap() {
        geoLocate();
    }
</script>
@endpush