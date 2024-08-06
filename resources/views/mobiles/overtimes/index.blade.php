@extends('mobiles.layouts.app')


@section('content')
<div class="page-content">
    <div class="page-title page-title-small" style="margin-top: 50px">
        <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a><span>Live Attendance</span></h2>
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

    <div class="card card-style">
        <div class="content">
            <a href="#" class="get-location btn btn-full btn-m bg-red2-dark rounded-sm text-uppercase shadow-l font-900">Show My Location</a>
            <p class="location-coordinates" style="display: none"></p>
            <div id="map" style="height: 200px"></div>
            @if ($latestOvertime != null && $latestOvertime->clock_in !== null)
            <div class="row mb-0 pt-4">
                <div class="col-6">
                    <a href="#"
                        class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight">
                        <span style="display: block; text-align: center;">
                            START TIME
                        </span>
                        <span style="display: block; text-align: center;">
                            {{ \Carbon\Carbon::parse($latestOvertime->clock_in)->format('H:i') ?? '- - : - -' }}
                        </span>
                    </a>
                </div>

                <div class="col-6">
                    @if ($clockOutStatus)
                        <a href="#"
                            class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight">
                            <span style="display: block; text-align: center;">
                                END TIME
                            </span>
                            <span style="display: block; text-align: center;">
                                {{ \Carbon\Carbon::parse($latestOvertime->clock_out)->format('H:i') ?? '- - : - -' }}
                            </span>
                        </a>
                    @else
                        <form id="overtime-clockout" method="POST" action="{{ route('overtime.clockout') }}"
                            style="display: none;">
                            @csrf
                            <input type="hidden" name="latlong" id="latlongInput">
                        </form>
                        <a href="#"  onclick="event.preventDefault(); document.getElementById('overtime-clockout').submit();"
                            class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl btn-primary">
                            FINISH
                        </a>
                    @endif
                </div>
            </div>
            @else
            <div class="content" id="tab-group-1">
                <div class="tab-controls tabs-small tabs-rounded" data-highlight="bg-highlight">
                    <a href="#" data-active data-bs-toggle="collapse" data-bs-target="#tab-1">
                        <span style="display: block; text-align: center;">
                            <i class="fas fa-clock">&nbsp</i> LEMBUR
                        </span>
                    </a>
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#tab-2">
                        <span style="display: block; text-align: center;">
                            <i class="fa fa-rotate-right">&nbsp</i> BACKUP
                        </span>
                    </a>
                </div>
                <div class="clearfix mb-3"></div>
                <div data-bs-parent="#tab-group-1" class="collapse show" id="tab-1">
                    <form id="overtime-clockin-lembur" method="POST" action="{{ route('overtime.clockin') }}">
                        @csrf
                        <input type="hidden" name="latlong" id="latlongInput">
                        <input type="text" class="form-control" name="reason"
                                placeholder="Tulis Tujuan Lembur Disini!!">
                    </form>
                    <div class="pt-4">
                        <a href="#"  onclick="event.preventDefault(); document.getElementById('overtime-clockin-lembur').submit();"
                            class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl btn-primary clock-in-btn">
                            START IN
                        </a>
                    </div>
                </div>
                <div data-bs-parent="#tab-group-1" class="collapse" id="tab-2">
                    <form id="overtime-clockin-backup" method="POST" action="{{ route('overtime.clockin') }}">
                        @csrf
                        <select class="form-control" name="backup_id">
                            <option value="default" disabled selected>Pilih yang akan di Backup</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <input type="text" class="form-control" name="reason"
                            placeholder="Tulis Tujuan Lembur Disini!!">   
                        <input type="hidden" name="latlong" id="latlongInput">
                    </form>
                    <div class="pt-4">
                        <a href="#"  onclick="event.preventDefault(); document.getElementById('overtime-clockin-backup').submit();"
                            class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl btn-primary clock-in-btn">
                            START IN
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="content mb-2 pt-3">
        <h4 class="pb-4">Overtime Log</h4>
        <div class="clearfix"></div>
        <table class="table table-borderless text-center rounded-sm shadow-l" style="overflow: hidden;">
            <thead>
                <tr class="bg-blue1-dark">
                    <th scope="col" class="color-theme">Tanggal</th>
                    <th scope="col" class="color-theme">Waktu</th>
                    <th scope="col" class="color-theme">Validasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <th scope="row">{{ $log->attendance['date'] }}</th>
                        <td>
                            @if (isset($log->duration))
                                <span>{{ $log->duration }}</span>
                            @else
                                <span>Belum ada durasi</span>
                            @endif
                        </td>
                        <td class="color-green1-dark">Approve</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="loader" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 30;">
        <div class="spinner" style="border: 8px solid #f3f3f3; border-top: 8px solid #f84e45; border-radius: 50%; width: 60px; height: 60px; animation: spin 1s linear infinite;"></div>
    </div>
</div>
<style>
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
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
            const clockInButtons = document.querySelectorAll('.clock-in-btn');
            const clockOutButtons = document.querySelectorAll('.clock-out-btn');
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

                clockInButtons.forEach(button => {
                    if (mobileDepartment == '2' || distance <= radius) {
                        button.classList.remove('btn-secondary');
                        button.classList.add('btn-primary');
                        button.setAttribute('href', '{{ route('attendance.clockin') }}');
                        button.style.pointerEvents = 'auto';
                    } else {
                        button.classList.remove('btn-primary');
                        button.classList.add('btn-secondary');
                        button.setAttribute('href', '#');
                        button.style.pointerEvents = 'none';
                        locationCoordinates.innerHTML += '<br><strong>Anda berada di luar radius absen.</strong>';
                    }
                });

                clockOutButtons.forEach(button => {
                    if (mobileDepartment == '2' || distance <= radius) {
                        button.classList.remove('btn-secondary');
                        button.classList.add('btn-primary');
                        button.setAttribute('href', '{{ route('attendance.clockout') }}');
                        button.style.pointerEvents = 'auto';
                    } else {
                        button.classList.remove('btn-primary');
                        button.classList.add('btn-secondary');
                        button.setAttribute('href', '#');
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const geolocationButton = document.getElementById('geolocationButton');
            const latlongInput = document.getElementById('latlongInput');
            const attendanceForm = document.getElementById('attendanceForm');
            const loader = document.getElementById('loader');
    
            function getLocationAndSubmit() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const latlong = `${position.coords.latitude},${position.coords.longitude}`;
                        latlongInput.value = latlong;
                        attendanceForm.submit();
                    }, function(error) {
                        console.error('Error getting location:', error);
                        alert('Could not get your location. Please enable location services.');
                    });
                } else {
                    console.error('Geolocation is not supported by this browser.');
                    alert('Geolocation is not supported by your browser.');
                }
            }
    
            geolocationButton.addEventListener('click', function(event) {
                event.preventDefault();
                loader.style.display = 'block';
                getLocationAndSubmit();
            });
        });
    </script>
@endpush