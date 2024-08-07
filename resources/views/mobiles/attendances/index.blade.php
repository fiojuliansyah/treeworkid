@extends('mobiles.layouts.module')


@section('content')
<div class="page-content">  
    <div class="page-title page-title-small" style="margin-top: 50px">
        <a href="{{ route('mobile.home') }}" class="btn rounded-xl" style="background-color: #f9584f">
            <span style="display: block; text-align: center;">
                <i class="fa fa-arrow-left" style="font-size: 12px">&nbsp</i>
            </span>
        </a>
    </div>
    <div class="card header-card">
        <a href="#" class="get-location btn btn-full btn-m bg-red2-dark rounded-sm text-uppercase shadow-l font-900" style="display: none">Show My Location</a>
        <p class="location-coordinates" style="display: none"></p>
        <div id="map" style="height: 400px"></div>
    </div>
    <div class="content" style="margin-top: 360px">
        <div class="row">
            <div class="col-2 pt-2">
                <a href="{{ route('attendance.index') }}" class="btn rounded-xl bg-green-dark">
                    <span style="display: block; text-align: center;">
                        <i class="fa fa-sign-in" style="font-size: 12px">&nbsp</i>
                    </span>
                </a>
            </div>
            <div class="col-10">
                <strong id="date" style="color: black"></strong>
                <br>
                <strong id="clock"></strong>
            </div>
        </div>
        <div style="border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; box-sizing: border-box;">
            <div class="row">
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
                    @if ($clockInStatus)
                        <span class="badge bg-success">clock out</span>   
                    @else
                        <span class="badge bg-success">clock in</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="mb-2 pt-1">
            <h4 class="pb-4">Absen Terakhir</h4>
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
                        <td><a href="#" data-menu="menu-maps-in" class="color-green1-dark">{{ $log->clock_in ?? '' }}</a></td>
                        <td><a href="#" data-menu="menu-maps-out" class="color-red1-dark">{{ $log->clock_out ?? '' }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="ad-300x50 ad-300x50-fixed">
        <div class="content">
            @if ($clockOutStatus)
                
            @else
                @if ($clockInStatus)
                    <a href="{{ route('attendance.clockout') }}" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight clock-out-btn">
                        <i class="fas fa-camera">&nbsp;</i>Clock OUT
                    </a>
                @else
                    <a href="{{ route('attendance.clockin') }}" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight clock-in-btn">
                        <i class="fas fa-camera">&nbsp;</i>Clock IN
                    </a>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection

@push('js')
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
        function geoLocate() {
            const locationCoordinates = document.querySelector('.location-coordinates');
            const clockInButton = document.querySelectorAll('.clock-in-btn');
            const clockOutButton = document.querySelectorAll('.clock-out-btn');
            const disableButton = document.querySelectorAll('.bg-highlight');
            const userLat = @json(Auth::user()->site['lat']);
            const userLong = @json(Auth::user()->site['long']);
            const radius = @json(Auth::user()->site['radius']);
            const mobileDepartment = @json(Auth::user()->department_id);

            function success(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                locationCoordinates.innerHTML = '<strong>Longitude:</strong> ' + longitude + '<br><strong>Latitude:</strong> ' + latitude;

                const map = L.map('map', {
                zoomControl: false 
                }).setView([latitude, longitude], 16);

                L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }).addTo(map);

                L.control.zoom({
                position: 'bottomright'
                }).addTo(map);

                if (mobileDepartment == '2') {
                    const customIcon = L.icon({
                        iconUrl: 'https://img.icons8.com/?size=256&id=114446&format=png',
                        iconSize: [48],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });

                    L.marker([latitude, longitude], { icon: customIcon }).addTo(map)
                        .bindPopup('Status absensi anda bisa dimana saja!')
                        .openPopup();

                } else {
                    const customIcon = L.icon({
                        iconUrl: 'https://img.icons8.com/?size=256&id=13783&format=png',
                        iconSize: [48],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });

                    L.marker([latitude, longitude], { icon: customIcon }).addTo(map)
                        .bindPopup('Pastikan anda dalam radius absen!')
                        .openPopup();

                    L.circle([userLat, userLong], {
                        color: 'red',
                        fillColor: '#f03',
                        fillOpacity: 0.5,
                        radius: radius
                    }).addTo(map);
                }

                const distance = haversineDistance(latitude, longitude, userLat, userLong) * 1000;

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

        function haversineDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius of the Earth in km
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
    </script>
@endpush