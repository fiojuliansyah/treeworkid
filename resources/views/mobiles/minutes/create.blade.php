@extends('mobiles.layouts.module')

@section('content')
<div class="page-content">
    <div class="page-title page-title-small">
        <h2 style="color: black"><a href="#" data-back-button><i class="fa fa-arrow-left" style="color: black"></i></a></h2>
        <div class="divider"></div>
    </div>
    <div class="content mt-0 mb-0">
        <form id="formStore" method="POST" action="{{ route('minute.store') }}" enctype="multipart/form-data">
            @csrf
                <div class="content mb-0"> 
                    <div class="mt-5">
                        <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4">
                            <select name="type" class="form-control">
                                <option value="default" disabled selected>pilih</option>
                                <option value="clockin">Clock IN</option>
                                <option value="clockout">Clock OUT</option>
                            </select>
                            <label for="form2" class="color-highlight font-400 font-13">Tipe</label>
                            <em><i class="fa fa-angle-down"></i></em>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4">
                            <input type="date" name="date" class="form-control">
                            <label for="form2" class="color-highlight font-400 font-13">Tanggal</label>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4">
                            <input type="time" name="clock" class="form-control">
                            <label class="color-highlight font-400 font-13">Jam</label>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span>Tambah Gambar</span>
                        <br>
                        <label for="file-upload" class="float-right btn btn-xs bg-highlight rounded-xl shadow-xl text-uppercase font-900 mt-2 font-11"><i class="fas fa-camera" style="color: white;"></i> Upload</label>  
                        <input type="file" id="file-upload" name="image" style="display: none;" onchange="previewImage()">
                        <img id="image-preview" src="/assets/mobiles/images/empty.png" alt="Preview" class="preload-img img-fluid bottom-20 mt-3">
                    </div>
                    <div class="mt-5">
                        <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4">
                            <textarea name="remark" class="form-control"></textarea>
                            <label for="form2" class="color-highlight font-400 font-13">Remark</label>
                        </div>
                    </div>
                    <input type="hidden" name="latlong" id="latlongInput">
                </div> 
        </form>
    </div>
    <div class="ad-300x50 ad-300x50-fixed">
        <a href="#" onclick="submitFormWithLocation(event)" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight">
            Submit
        </a>
    </div>
</div>

@endsection

@push('js')
<script>
    function previewImage() {
      var input = document.getElementById('file-upload');
      var imageContainer = document.getElementById('image-preview');
      var files = input.files;
      var file = files[files.length - 1];

      var reader = new FileReader();

      reader.onload = function(e) {
        imageContainer.src = e.target.result;
      };

      reader.readAsDataURL(file);
    }

    function submitFormWithLocation(event) {
        event.preventDefault();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latlong = `${position.coords.latitude},${position.coords.longitude}`;
                document.getElementById('latlongInput').value = latlong;
                document.getElementById('formStore').submit();
            }, function(error) {
                console.error('Error getting location:', error);
                alert('Could not get your location. Please enable location services.');
            });
        } else {
            alert('Geolocation is not supported by your browser.');
        }
    }
</script>
@endpush
