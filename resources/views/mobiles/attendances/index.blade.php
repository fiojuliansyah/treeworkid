@extends('mobiles.layouts.module')


@section('content')
<div class="page-content">
    <div class="page-title page-title-small" style="margin-top: 50px">
        <h2><a href="{{ route('mobile.home') }}"><i class="fa fa-arrow-left"></i></a><span>Live Attendance</span></h2>
        <center class="pt-4">
            <h1 id="clock" style="color: white"></h1>
        </center>
        <center>
            <h6 id="date" style="color: white"></h6>
        </center>
    </div>

    <div class="card header-card" data-card-height="450">
        <div class="card-overlay bg-highlight opacity-90"></div>
        <div class="card-bg preload-img" data-src="{{ asset('') }}mobile/images/pictures/18s.jpg"></div>
    </div>

    <div class="card card-style" style="margin-top: 30px">
        <div class="content">
            <center>
            <h6>Schedule :</h6>
            </center>
            <div class="text-center">
                <p>No shift information available</p>
            </div>
            <a href="#" class="get-location btn btn-full btn-m bg-red2-dark rounded-sm text-uppercase shadow-l font-900">Show My Location</a>
            <p class="location-coordinates" style="display: none"></p>
            <div id="map" style="height: 200px"></div>
            <div class="row mb-0 pt-4">
                <div class="col-6">
                    @if ($clockInStatus)
                        <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl btn-secondary">
                            <i class="fas fa-camera">&nbsp;</i>Clock IN
                        </a>
                    @else
                        <a href="{{ route('attendance.clockin') }}" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl btn-primary clock-in-btn">
                            <i class="fas fa-camera">&nbsp;</i>Clock IN
                        </a>
                    @endif
                </div>

                <div class="col-6">
                    @if ($clockOutStatus)
                        <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl btn-secondary">
                            <i class="fas fa-camera">&nbsp;</i>Clock OUT
                        </a>
                    @else
                        <a href="{{ route('attendance.clockout') }}" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl btn-primary clock-out-btn">
                            <i class="fas fa-camera">&nbsp;</i>Clock OUT
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <div class="content mb-2 pt-1">
        <h4 class="pb-4">Attendance Log</h4>
        <div class="clearfix"></div>
        <table class="table table-borderless text-center rounded-sm shadow-l" style="overflow: hidden;">
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
                    <th scope="row">{{ $log->date->format('d-M-Y') }}</th>
                    <td><a href="#" data-menu="menu-maps-in" class="color-green1-dark">{{ $log->clock_in }}</a></td>
                    <td><a href="#" data-menu="menu-maps-out" class="color-red1-dark">{{ $log->clock_out }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
        const clockInButton = document.querySelector('.clock-in-btn');
        const clockOutButton = document.querySelector('.clock-out-btn');
        const userLat = @json(Auth::user()->site['lat']);
        const userLong = @json(Auth::user()->site['long']);
        const radius = @json(Auth::user()->site['radius']);
        const mobileDepartment = @json(Auth::user()->department_id);

        function success(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            locationCoordinates.innerHTML = '<strong>Longitude:</strong> ' + longitude + '<br><strong>Latitude:</strong> ' + latitude;

            const map = L.map('map').setView([latitude, longitude], 16);

            L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                    maxZoom: 20,
                    subdomains:['mt0','mt1','mt2','mt3']
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

            if (mobileDepartment == '2') {
                clockInButton.classList.remove('btn-secondary');
                clockInButton.classList.add('btn-primary');
                clockInButton.setAttribute('href', '{{ route('attendance.clockin') }}');
                clockInButton.style.pointerEvents = 'auto';
                
                clockOutButton.classList.remove('btn-secondary');
                clockOutButton.classList.add('btn-primary');
                clockOutButton.setAttribute('href', '{{ route('attendance.clockout') }}');
                clockOutButton.style.pointerEvents = 'auto';
            } else {
                if (distance > radius) {
                    clockInButton.classList.remove('btn-primary');
                    clockInButton.classList.add('btn-secondary');
                    clockInButton.setAttribute('href', '#');
                    clockInButton.style.pointerEvents = 'none';

                    locationCoordinates.innerHTML += '<br><strong>Anda berada di luar radius absen.</strong>';
                    
                    clockOutButton.classList.remove('btn-primary');
                    clockOutButton.classList.add('btn-secondary');
                    clockOutButton.setAttribute('href', '#');
                    clockOutButton.style.pointerEvents = 'none';
                } else {
                    clockInButton.classList.remove('btn-secondary');
                    clockInButton.classList.add('btn-primary');
                    clockInButton.setAttribute('href', '{{ route('attendance.clockin') }}');
                    clockInButton.style.pointerEvents = 'auto';
                    
                    clockOutButton.classList.remove('btn-secondary');
                    clockOutButton.classList.add('btn-primary');
                    clockOutButton.setAttribute('href', '{{ route('attendance.clockout') }}');
                    clockOutButton.style.pointerEvents = 'auto';
                }
            }

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
</script>

@endpush