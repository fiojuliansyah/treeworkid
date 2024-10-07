@extends('mobiles.layouts.module')

@section('content')
<div class="page-content" style="position: relative; width: 100%; height: 100vh; overflow: hidden;">
    <!-- Page Title -->
    <div class="page-title page-title-small" style="position: absolute; top: 0; left: 0; width: 100%; z-index: 10; padding: 10px;">
        <h2>
            <a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>
            <span>PULANG</span>
        </h2>
    </div>

    <!-- Camera Container -->
    <div class="camera-container" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden;">
        <video id="cameraFeed" autoplay playsinline style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transform: scaleX(-1);"></video>

        <!-- Transparent Image -->
    </div>

    <!-- Capture Button -->
    <div style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 20; padding: 10px;">
        <button id="captureButton" style="padding: 10px 20px; font-size: 16px; background-color: #00B5CC; color: white; border: none; border-radius: 5px; cursor: pointer;">
            <i class="fas fa-camera"></i>
        </button>
    </div>
    <form class="form" action="{{ route('clockout.store') }}" method="POST" id="attendanceForm">
        @csrf
        <input type="hidden" name="image" id="imageInput">
    </form>

    <!-- Canvas for capturing the image -->
    <canvas id="captureCanvas" style="display: none;"></canvas>

    <!-- Loader -->
    <div id="loader" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 30;">
        <div class="spinner" style="border: 8px solid #f3f3f3; border-top: 8px solid #00B5CC; border-radius: 50%; width: 60px; height: 60px; animation: spin 1s linear infinite;"></div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const video = document.getElementById('cameraFeed');
        const captureButton = document.getElementById('captureButton');
        const canvas = document.getElementById('captureCanvas');
        const context = canvas.getContext('2d');
        const imageInput = document.getElementById('imageInput');
        const attendanceForm = document.getElementById('attendanceForm');
        const loader = document.getElementById('loader');
        let captureButtonEnabled = true;

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

        function captureImageAndSubmit() {
            if (captureButtonEnabled) {
                captureButtonEnabled = false;
                loader.style.display = 'block';
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageData = canvas.toDataURL('image/png');
                imageInput.value = imageData;
                attendanceForm.submit(); // Submit form setelah gambar diambil
            }
        }

        captureButton.addEventListener('click', function(event) {
            event.preventDefault();
            captureImageAndSubmit();
        });
    });
</script>

@endpush
