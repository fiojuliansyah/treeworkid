@extends('layouts.main')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="row g-5 g-xl-8">
                    <div class="col-xl-3">
                        <a href="{{ route('careers.index') }}" class="card bg-light hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <i class="ki-duotone ki-briefcase text-white fs-2x ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">{{ $career }}</div>
                                <div class="fw-semibold text-gray-400">Total Openings</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <a href="{{ route('applicants.index') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <i class="ki-duotone ki-bookmark text-white fs-2x ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">{{ $applicant }}</div>
                                <div class="fw-semibold text-gray-400">Applicant</div>
                            </div>
                        </a>
                    </div>
                    @foreach ($statuses as $status) 
                        <div class="col-xl-3">
                            <a href="{{ route('statuses.show',$status->name) }}" target="_blank" class="card bg-{{ $status->color }} hoverable card-xl-stretch mb-xl-8">
                                <div class="card-body position-relative">
                                    <i class="ki-duotone ki-bookmark text-white fs-2x ms-n1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        @if ($status->unapprovedApplicants() && $status->unapprovedApplicants()->count() > 0)  
                                        <div class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $status->unapprovedApplicants()->count() }}</div>
                                        @endif
                                    </i>
                                    <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">
                                        {{ $applicantCounts[$status->id] }}
                                    </div>
                                    <div class="fw-semibold text-gray-100">{{ $status->name }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->
    <div id="kt_app_footer" class="app-footer">
        <!--begin::Footer container-->
        <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
            <!--begin::Copyright-->
            <div class="text-gray-900 order-2 order-md-1">
                <span class="text-muted fw-semibold me-1">2024&copy;</span>
                <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
            </div>
            <!--end::Copyright-->
            <!--begin::Menu-->
            <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                <li class="menu-item">
                    <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
                </li>
                <li class="menu-item">
                    <a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
                </li>
                <li class="menu-item">
                    <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
                </li>
            </ul>
            <!--end::Menu-->
        </div>
        <!--end::Footer container-->
    </div>
    <!--end::Footer-->
</div>
@endsection
