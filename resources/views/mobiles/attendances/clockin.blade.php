@extends('mobiles.layouts.module')

@section('content')
<div class="page-content" style="position: relative; width: 100%; height: 100vh; overflow: hidden;">
    <!-- Page Title -->
    <div class="page-title page-title-small" style="position: absolute; top: 0; left: 0; width: 100%; z-index: 10; padding: 10px;">
        <h2>
            <a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>
            <span>MASUK</span>
        </h2>
    </div>

    <!-- Camera Container -->
    <div class="camera-container" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden;">
        <video id="cameraFeed" autoplay playsinline style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transform: scaleX(-1);"></video>
    </div>
    

    <!-- Capture Button -->
    <div style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 20; padding: 10px;">
        <button id="captureButton" style="padding: 10px 20px; font-size: 16px; background-color: #00B5CC; color: white; border: none; border-radius: 5px; cursor: pointer;">
            <i class="fas fa-camera"></i>
        </button>
    </div>
    <form class="form" action="{{ route('clockin.store') }}" method="POST" id="attendanceForm">
        @csrf
        <input type="hidden" name="image" id="imageInput">
        <input type="hidden" name="latlong" id="latlongInput">
    </form>

    <!-- Canvas for capturing the image -->
    <canvas id="captureCanvas" style="display: none;"></canvas>

    <!-- Loader -->
    <div id="loader" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 30;">
        <svg viewBox="0 0 200 200" width="200" height="200" xmlns="http://www.w3.org/2000/svg">
            <!-- Wajah berbentuk lingkaran -->
            <circle cx="100" cy="100" r="50" stroke="blue" stroke-width="4" fill="none" />
            
            <!-- Garis pengenalan wajah -->
            <rect x="50" y="50" width="100" height="100" fill="none" stroke="green" stroke-width="2" stroke-dasharray="5 5">
              <animate attributeName="stroke-dashoffset" from="0" to="100" dur="2s" repeatCount="indefinite" />
            </rect>
            
            <!-- Titik-titik wajah -->
            <circle cx="80" cy="80" r="3" fill="red">
              <animate attributeName="r" from="3" to="5" dur="0.5s" repeatCount="indefinite" />
            </circle>
            <circle cx="120" cy="80" r="3" fill="red">
              <animate attributeName="r" from="3" to="5" dur="0.5s" repeatCount="indefinite" />
            </circle>
            <circle cx="100" cy="120" r="3" fill="red">
              <animate attributeName="r" from="3" to="5" dur="0.5s" repeatCount="indefinite" />
            </circle>
          
            <!-- Garis fokus di sekitar wajah -->
            <line x1="50" y1="50" x2="30" y2="50" stroke="green" stroke-width="2">
              <animate attributeName="x2" from="30" to="50" dur="1s" repeatCount="indefinite" />
            </line>
            <line x1="50" y1="50" x2="50" y2="30" stroke="green" stroke-width="2">
              <animate attributeName="y2" from="30" to="50" dur="1s" repeatCount="indefinite" />
            </line>
            
            <line x1="150" y1="50" x2="170" y2="50" stroke="green" stroke-width="2">
              <animate attributeName="x2" from="170" to="150" dur="1s" repeatCount="indefinite" />
            </line>
            <line x1="150" y1="50" x2="150" y2="30" stroke="green" stroke-width="2">
              <animate attributeName="y2" from="30" to="50" dur="1s" repeatCount="indefinite" />
            </line>
            
            <line x1="50" y1="150" x2="30" y2="150" stroke="green" stroke-width="2">
              <animate attributeName="x2" from="30" to="50" dur="1s" repeatCount="indefinite" />
            </line>
            <line x1="50" y1="150" x2="50" y2="170" stroke="green" stroke-width="2">
              <animate attributeName="y2" from="170" to="150" dur="1s" repeatCount="indefinite" />
            </line>
            
            <line x1="150" y1="150" x2="170" y2="150" stroke="green" stroke-width="2">
              <animate attributeName="x2" from="170" to="150" dur="1s" repeatCount="indefinite" />
            </line>
            <line x1="150" y1="150" x2="150" y2="170" stroke="green" stroke-width="2">
              <animate attributeName="y2" from="170" to="150" dur="1s" repeatCount="indefinite" />
            </line>
          </svg>          
        {{-- <div class="spinner" style="border: 8px solid #f3f3f3; border-top: 8px solid #00B5CC; border-radius: 50%; width: 60px; height: 60px; animation: spin 1s linear infinite;"></div> --}}
    </div>
</div>
<!-- Loader CSS -->
<style>
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endsection

@push('js')
<script>
    let captureButtonEnabled = true;

    document.addEventListener('DOMContentLoaded', function() {
        const video = document.getElementById('cameraFeed');
        const captureButton = document.getElementById('captureButton');
        const canvas = document.getElementById('captureCanvas');
        const context = canvas.getContext('2d');
        const imageInput = document.getElementById('imageInput');
        const latlongInput = document.getElementById('latlongInput');
        const attendanceForm = document.getElementById('attendanceForm');
        const loader = document.getElementById('loader');

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } })
                .then(function(stream) {
                    video.srcObject = stream;
                })
                .catch(function(error) {
                    console.error('Error accessing the camera:', error);
                });
        } else {
            console.error('getUserMedia is not supported by this browser.');
        }

        function captureImage() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/png');
            imageInput.value = imageData;
        }

        function getLocationAndSubmit() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latlong = `${position.coords.latitude},${position.coords.longitude}`;
                    latlongInput.value = latlong;
                    attendanceForm.submit();
                }, function(error) {
                    console.error('Error getting location:', error);
                    alert('Could not get your location. Please enable location services.');
                    captureButton.disabled = false;
                    captureButtonEnabled = true;
                });
            } else {
                console.error('Geolocation is not supported by this browser.');
                alert('Geolocation is not supported by your browser.');
                captureButton.disabled = false;
                captureButtonEnabled = true;
            }
        }

        captureButton.addEventListener('click', function(event) {
            event.preventDefault();
            if (captureButtonEnabled) {
                captureButtonEnabled = false;
                captureButton.disabled = true;
                loader.style.display = 'block';
                captureImage();
                getLocationAndSubmit();
            }
        });
    });
</script>
@endpush
