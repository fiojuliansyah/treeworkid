@extends('mobiles.layouts.module')

@section('content')
<div class="page-content">
    <div class="page-title page-title-small">
        <h2>
            <a href="#"><i class="fa fa-arrow-left" style="color: black;">&nbsp;&nbsp;&nbsp;</i><span><img src="{{ $leave->site->company['logo_url'] }}" width="150px"></span></a>
        </h2>
    </div>
    <div class="card card-style" style="margin-top: 50px">
        <div class="content">
            <div class="divider mt-n4 mb-3"></div>
            <center>
                <h6>FORM PENGAJUAN CUTI</h6>
            </center>
            <br>
            <div class="row">
                <div class="col-6">
                    <p class="color-theme font-15 font-800">Tanggal Dibuat</p>
                </div>
                <div class="col-6">
                    <p class="color-theme font-15 font-800 text-right">Tanggal Pengajuan</p>
                </div>

                <div class="col-12 mb-n4 mt-n4"></div>

                <div class="col-6">
                    <p class="line-height-s">{{ $leave->created_at->format('d-M-Y') }}</p>
                </div>
                <div class="col-6">
                    <p class="line-height-s text-right">{{ $leave->start_date->format('d-M-Y') }}</p>
                </div>

                <div class="col-12 mb-3"></div>
                <div class="col-6">
                    <p class="color-theme font-15 font-800">Dibuat Oleh</p>
                </div>
                <div class="col-6">
                    <p class="color-theme font-15 font-800 text-right">Selesai</p>
                </div>

                <div class="col-12 mb-n4 mt-n4"></div>

                <div class="col-6">
                    <p class="line-height-s">{{ $leave->user['name'] }}</p>
                </div>
                <div class="col-6">
                    <p class="line-height-s text-right">{{ $leave->end_date->format('d-M-Y') }}</p>
                </div>

                <div class="col-12 mb-3"></div>
                <div class="col-6">
                    <p class="color-theme font-15 font-800">Area</p>
                </div>
                <div class="col-6">
                    <p class="color-theme font-15 font-800 text-right">Jabatan</p>
                </div>

                <div class="col-12 mb-n4 mt-n4"></div>

                <div class="col-6">
                    <p class="line-height-s">{{ $leave->user->site['name'] }}</p>
                </div>
                <div class="col-6">
                    @if (!empty($leave->user->getRoleNames()))
                        @foreach ($leave->user->getRoleNames() as $v)
                            <p class="line-height-s text-right">{{ $v }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <h4 class="mb-n1">Deskripsi</h4>
            <p>
                {{ $leave->reason }}
            </p>

            <div class="divider"></div>
            <div class="col-12 mb-5 mt-5"></div>
            <div class="row">
                <div class="col-12 mb-3"></div>
                <div class="col-6">
                    <div class="divider mt-1 mb-1"></div>
                    <p class="color-theme">{{ $leave->user->leader['name'] }}</p>
                </div>
                @if ($leave->user->leader->leader)   
                <div class="col-6">
                    <div class="divider mt-1 mb-1"></div>
                    <p class="color-theme text-right">{{ $leave->user->leader->leader['name'] }}</p>
                </div>
                @else
                @endif

                <div class="col-12 mb-n4 mt-n4"></div>

                <div class="col-6">
                    @if (!empty($leave->user->leader->getRoleNames()))
                        @foreach ($leave->user->leader->getRoleNames() as $v)
                            <p class="line-height-s font-15 font-800">{{ $v }}</p>
                        @endforeach
                    @endif
                </div>
                @if ($leave->user->leader->leader)    
                <div class="col-6">
                    @if (!empty($leave->user->leader->leader->getRoleNames()))
                        @foreach ($leave->user->leader->leader->getRoleNames() as $v)
                            <p class="line-height-s font-15 font-800 text-right">{{ $v }}</p>
                        @endforeach
                    @endif
                </div>
                @else
                @endif

                <div class="col-12 mb-n4 mt-n4"></div>

                <div class="col-6">
                    <p class="color-theme font-15 font-800">Menyetujui</p>
                </div>
                @if ($leave->user->leader->leader) 
                <div class="col-6">
                    <p class="color-theme font-15 font-800 text-right">Menyetujui</p>
                </div>    
                @else
                @endif
            </div>
            <br>    
        </div>
    </div>
    <div class="content">
        <img id="image-preview" src="/assets/mobiles/images/empty.png" alt="Preview" class="preload-img img-fluid bottom-20 mt-3">
    </div>
    
    <!-- Form untuk upload file -->
    <form id="upload-form" action="{{ route('leave.update', $leave->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Mengganti metode form menjadi PUT -->
    
        <label for="file-upload" id="upload-label" class="btn btn-full btn-margins bg-highlight btn-m text-uppercase font-900 rounded-s shadow-xl">
            <i class="fas fa-upload" style="color: white;"></i> Upload Image
        </label>  
        <input type="file" id="file-upload" name="image" style="display: none;" onchange="previewImage()">
    
        <button id="submit-button" type="submit" class="btn btn-full btn-margins bg-success btn-m text-uppercase font-900 rounded-s shadow-xl" style="display: none;">
            <i class="fas fa-paper-plane" style="color: white;"></i> Submit
        </button>
    </form>
</div>

@endsection

@push('js')
<script>
    function previewImage() {
        var input = document.getElementById('file-upload');
        var imageContainer = document.getElementById('image-preview');
        var files = input.files;

        if (files.length === 0) return; // Jika tidak ada file, keluar dari fungsi

        var file = files[0]; // Ambil file pertama

        // Periksa apakah file adalah gambar
        if (!file.type.startsWith('image/')) {
            alert('Please upload a valid image file.');
            input.value = ''; // Reset input file jika tidak valid
            return;
        }

        var reader = new FileReader();

        reader.onload = function(e) {
            imageContainer.src = e.target.result;
        };

        reader.readAsDataURL(file); // Tampilkan preview gambar

        // Ganti tombol upload dengan tombol submit
        document.getElementById('upload-label').style.display = 'none';
        document.getElementById('submit-button').style.display = 'block';
    }
</script>
@endpush