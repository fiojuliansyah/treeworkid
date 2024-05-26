@extends('layouts.main')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <div class="me-7 mb-4">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img src="{{ $user->profile['avatar_url'] ?? '/assets/media/avatars/blank.png' }}" alt="image" />
                                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-2">
                                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $user->name }}</a>
                                            <a href="#">
                                                <i class="ki-outline ki-verify fs-1 text-primary"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                            <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    {{ $v }}
                                                @endforeach
                                            @endif
                                            </a>
                                            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                            <i class="ki-outline ki-geolocation fs-4 me-1"></i>{{ $user->site['name'] ?? 'belum ada site' }}</a>
                                            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                            <i class="ki-outline ki-sms fs-4"></i>{{ $user->email }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap flex-stack">
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <div class="d-flex flex-wrap">
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-solid ki-star fs-3 text-warning me-2"></i>
                                                    <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="4500">0</div>
                                                </div>
                                                <div class="fw-semibold fs-6 text-gray-500">Rating</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index-account') }}">Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index-profile') }}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('index-document') }}">Documents</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Documents</h3>
                        </div>
                    </div>
                    <div id="kt_account_settings_profile_details" class="collapse show">
                            <div class="card-body border-top p-9">
                                <div class="card-body tab-content">
                                    <div>
                                        <div class="row gx-9 gy-6">
                                            @foreach ($documents as $document)  
                                            <div class="col-xl-6" data-kt-billing-element="card">
                                                <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                                                    <div class="d-flex flex-column py-2">
                                                        <div class="d-flex align-items-center fs-4 fw-bold mb-5">
                                                        <span class="badge badge-light-success fs-7 ms-2">{{ $document->name }}</span></div>
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold">{{ $document->description ?? 'Tanpa keterangan' }}</div>
                                                                <div class="fs-6 fw-semibold text-gray-500">Document expires at {{ $document->validate ?? 'Tanpa keterangan' }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center py-2">
                                                        <button class="btn btn-sm btn-light btn-active-light-primary me-3" data-kt-billing-action="card-delete">
                                                            <span class="indicator-label">Delete</span>
                                                            <span class="indicator-progress">Please wait... 
                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                        </button>
                                                        <button class="btn btn-sm btn-light btn-active-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_show{{ $document->id }}">show</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="kt_modal_show{{ $document->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h2>Show Document</h2>
                                                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                                <i class="ki-outline ki-cross fs-1"></i>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                            <img src="{{ $document->file_url }}" width="500px"/>                                       
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="col-xl-6">
                                                <!--begin::Notice-->
                                                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed h-lg-100 p-6">
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                                        <!--begin::Content-->
                                                        <div class="mb-3 mb-md-0 fw-semibold">
                                                            <h4 class="text-gray-900 fw-bold">PERHATIAN PENTING!</h4>
                                                            <div class="fs-6 text-gray-700 pe-7">Mohon baca
                                                            <a href="#" class="fw-bold me-1"  data-bs-toggle="modal" data-bs-target="#kt_modal_perhatian">Cara menambahkan</a>
                                                            <br />Dokumen anda</div>
                                                        </div>
                                                        <!--end::Content-->
                                                        <!--begin::Action-->
                                                        <a href="#" class="btn btn-primary px-6 align-self-center text-nowrap" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">Tambah</a>
                                                        <!--end::Action-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                                <!--end::Notice-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="kt_modal_perhatian" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2>PERHATIAN !!!</h2>
                                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                        <i class="ki-outline ki-cross fs-1"></i>
                                    </div>
                                </div>
                                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                    <p>Hanya menerima hasil <strong>SCAN</strong> <i class="fas fa-check-circle text-success"></i> dan tidak menerima hasil <strong>FOTO</strong> <i class="fas fa-times-circle text-danger"></i></p>
                                    <img src="/assets/media/stock/not.png" width="500px"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="kt_modal_new_card" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Add New Documents</h2>
                                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                        <i class="ki-outline ki-cross fs-1"></i>
                                    </div>
                                </div>
                                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                    <p>Hanya menerima hasil <strong>SCAN</strong> <i class="fas fa-check-circle text-success"></i> dan tidak menerima hasil <strong>FOTO</strong> <i class="fas fa-times-circle text-danger"></i></p>
                                    <form id="form-submit" class="form" action="{{ route('store-document') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Document Type</span>
                                                <span class="ms-1" data-bs-toggle="tooltip" title="Specify a card holder's name">
                                                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                </span>
                                            </label>
                                            <select class="form-select form-control-lg form-control-solid" name="name" data-placeholder="Select an option">
                                                <option>Pilih</option>
                                                <option value="KTP">KTP</option>
                                                <option value="SIM">SIM</option>
                                                <option value="NPWP">NPWP</option>
                                                <option value="IJAZAH">IJAZAH</option>
                                                <option value="KARTU KELUARGA">KARTU KELUARGA</option>
                                                <option value="PAKLARING">PAKLARING</option>
                                                <option value="CERTIFICATE">CERTIFICATE</option>
                                            </select>                                        
                                        </div>
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                <span>Document Name</span>
                                                <small>&nbsp; (opsional)</small>
                                            </label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Nama Seritifikat / Nama Perusahaan" name="description"/>
                                        </div>
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                <span>Expired Date</span>
                                                <small>&nbsp; (opsional)</small>
                                            </label>
                                            <input type="date" class="form-control form-control-solid" name="validate"/>
                                        </div>
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Document File</span>
                                                <span class="ms-1" data-bs-toggle="tooltip" title="Specify a card holder's name">
                                                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                </span>
                                            </label>
                                            <!-- File input triggered by Jscanify -->
                                            <input type="file" id="fileInput" accept="image/*" class="form-control form-control-solid">
                                            <div id="result" style="margin-top: 50px; display: none">
                                                <div style="display: flex; flex-wrap: wrap;" id="results">
                                                  <div style="display: none;">
                                                    <h3>Original image</h3>
                                                    <img id="orig" />
                                                  </div>
                                                  <div id="highlighted" style="display: none;">
                                                    <h3>Highlighted Paper</h3>
                                                  </div>
                                                  <div id="extracted">
                                                  </div>
                                                  <div id="cornerPts" style="display: none;">
                                                    <h3>Corner Points</h3>
                                                    <pre style="font-family: monospace"></pre>
                                                  </div>
                                                </div>
                                            </div>
                                            <input type="file" name="file" id="resultExtracted" style="display: none">
                                        </div>
                                        <div class="text-center pt-15">
                                            <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                                                <span class="indicator-label">Submit</span>
                                                <span class="indicator-progress">Please wait... 
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://docs.opencv.org/4.7.0/opencv.js" async></script>
<script src="https://cdn.jsdelivr.net/gh/ColonelParrot/jscanify@master/src/jscanify.min.js"></script>
<script>
    window.addEventListener("load", function () {
      const scanner = new jscanify();
      fileInput.addEventListener("change", function (e) {
        if (e.target.files.length) {
          const image = e.target.files[0];
          orig.src = URL.createObjectURL(image);
          clearData();
          result.style.display = "block";

          orig.onload = function () {
            const highlightedCanvas = scanner.highlightPaper(orig);
            highlighted.appendChild(highlightedCanvas);

            const extractedCanvas = scanner.extractPaper(orig, 350, 350);
            extracted.appendChild(extractedCanvas);

            const contour = scanner.findPaperContour(cv.imread(orig));
            const cornerPoints = scanner.getCornerPoints(contour);
            cornerPts.querySelector("pre").textContent = JSON.stringify(
              cornerPoints,
              null,
              4
            );

            // Convert extracted canvas to Blob and set it to resultExtracted input
            extractedCanvas.toBlob(function(blob) {
              const file = new File([blob], "document.png", { type: "image/png" });
              const dataTransfer = new DataTransfer();
              dataTransfer.items.add(file);
              document.querySelector("#resultExtracted").files = dataTransfer.files;
            }, "image/png");
          };
        }
      });
    });

    function clearData() {
      highlighted.querySelector("canvas")?.remove();
      extracted.querySelector("canvas")?.remove();
      cornerPts.querySelector("pre").textContent = "";
    }
</script>    
@endpush