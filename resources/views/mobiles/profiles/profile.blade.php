@extends('mobiles.layouts.module')


@section('content')
<div class="page-content">
        
    <div class="page-title page-title-small">
        <h2 style="color: black"><a href="{{ route('mobile.setting') }}"><i class="fa fa-arrow-left" style="color: black"></i></a>Profilku</h2>
        <div class="divider"></div>
    </div>
    <div class="content mb-0">
        <form id="profile-update" class="form" action="{{ route('mobile.update.profile') }}" method="POST">
            @csrf
        <div class="mt-2 mb-4">
            <span>Tambah Avatar</span>
            <br>
            <label for="file-upload" class="float-right btn btn-xs bg-highlight rounded-xl shadow-xl text-uppercase font-900 mt-2 font-11"><i class="fas fa-camera" style="color: white;"></i> Upload</label>  
            <input type="file" id="file-upload" name="avatar" style="display: none;" onchange="previewImage()">
            <img id="image-preview" src="{{ $user->profile['avatar_url'] ?? '/assets/mobiles/images/empty.png' }}" alt="Preview" class="preload-img img-fluid bottom-20 mt-3">
        </div>
        <div class="input-style has-borders hnoas-icon input-style-always-active mb-4">
            <input type="name" name="employee_nik" class="form-control" value="{{ $user->profile['employee_nik'] }}" disabled>
            <label for="form1" class="color-highlight font-400 font-13">NIK Karyawan</label>
        </div>
        <div class="input-style has-borders hnoas-icon input-style-always-active mb-4">
            <textarea name="address" class="form-control">{{ $user->profile['address'] }}</textarea>
            <label for="form1" class="color-highlight font-400 font-13">Alamat</label>
        </div>
        <div class="input-style has-borders hnoas-icon input-style-always-active mb-4">
            <select name="gender" class="form-select">
                <option value="" disabled>Pilih</option>
                <option value="laki-laki" {{ $user->profile['gender'] == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="perempuan" {{ $user->profile['gender'] == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <label for="form1" class="color-highlight font-400 font-13">Jenis Kelamin</label>
        </div>
        <div class="input-style has-borders hnoas-icon input-style-always-active mb-4">
            <input type="name" name="birth_place" class="form-control" value="{{ $user->profile['birth_place'] }}">
            <label for="form1" class="color-highlight font-400 font-13">Tempat Lahir</label>
        </div>
        <div class="input-style has-borders hnoas-icon input-style-always-active mb-4">
            <input type="date" name="birth_date" class="form-control" value="{{ $user->profile['birth_date'] }}">
            <label for="form1" class="color-highlight font-400 font-13">Tanggal Lahir</label>
        </div>
        <div class="input-style has-borders hnoas-icon input-style-always-active mb-4">
            <input type="name" name="mother_name" class="form-control" value="{{ $user->profile['mother_name'] }}">
            <label for="form1" class="color-highlight font-400 font-13">Nama Ibu Kandung</label>
        </div>
        <div class="input-style has-borders hnoas-icon input-style-always-active mb-4">
            <select name="marriage_status" class="form-select">
                <option value="" disabled>Pilih</option>
                @if($user->profile && isset($user->profile['marriage_status']))
                <option value="TK-0" {{ $user->profile['marriage_status'] == 'TK-0' ? 'selected' : '' }}>TK-0 : Tidak Kawin (lajang/janda/duda)</option>
                <option value="TK-1" {{ $user->profile['marriage_status'] == 'TK-1' ? 'selected' : '' }}>TK-1 : Duda/Janda (punya anak 1)</option>
                <option value="TK-2" {{ $user->profile['marriage_status'] == 'TK-2' ? 'selected' : '' }}>TK-2 : Duda/Janda (punya anak 2)</option>
                <option value="TK-3" {{ $user->profile['marriage_status'] == 'TK-3' ? 'selected' : '' }}>TK-3 : Duda/Janda (punya anak 3)</option>
                <option value="K-0" {{ $user->profile['marriage_status'] == 'K-0' ? 'selected' : '' }}>K-0 : Kawin</option>
                <option value="K-1" {{ $user->profile['marriage_status'] == 'K-1' ? 'selected' : '' }}>K-1 : Kawin (punya anak 1)</option>
                <option value="K-2" {{ $user->profile['marriage_status'] == 'K-2' ? 'selected' : '' }}>K-2 : Kawin (punya anak 2)</option>
                <option value="K-3" {{ $user->profile['marriage_status'] == 'K-3' ? 'selected' : '' }}>K-3 : Kawin (punya anak 3)</option>
                @else
                <option value="TK-0">TK-0 : Tidak Kawin (lajang/janda/duda)</option>
                <option value="TK-1">TK-1 : Duda/Janda (punya anak 1)</option>
                <option value="TK-2">TK-2 : Duda/Janda (punya anak 2)</option>
                <option value="TK-3">TK-3 : Duda/Janda (punya anak 3)</option>
                <option value="K-0">K-0 : Kawin</option>
                <option value="K-1">K-1 : Kawin (punya anak 1)</option>
                <option value="K-2">K-2 : Kawin (punya anak 2)</option>
                <option value="K-3">K-3 : Kawin (punya anak 3)</option>
                @endif
            </select>
            <label for="form1" class="color-highlight font-400 font-13">Status Pernikahan</label>
        </div>
        <div class="input-style has-borders hnoas-icon input-style-always-active mb-4 mt-4">
            <input type="name" name="npwp_number" class="form-control" value="{{ $user->profile['npwp_number'] }}">
            <label for="form1" class="color-highlight font-400 font-13">No NPWP</label>
        </div>
        </form>                      
    </div>
    <a href="#" onclick="event.preventDefault(); document.getElementById('profile-update').submit();" class="btn btn-full btn-margins bg-highlight rounded-sm shadow-xl btn-m text-uppercase font-900">Save Information</a>
    
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