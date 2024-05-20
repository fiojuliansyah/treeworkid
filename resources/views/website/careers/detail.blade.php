@extends('website.layouts.app')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <br>
        <br>
        <br>
        <br>
        <br>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="position-relative mb-17">
                    <!--begin::Overlay-->
                    <div class="overlay overlay-show">
                        <!--begin::Image-->
                        <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px" style="background-image:url('/assets/media/stock/1600x800/img-1.jpg')"></div>
                        <!--end::Image-->
                        <!--begin::layer-->
                        <div class="overlay-layer rounded bg-black" style="opacity: 0.4"></div>
                        <!--end::layer-->
                    </div>
                    <!--end::Overlay-->
                    <!--begin::Heading-->
                    <div class="position-absolute text-white mb-8 ms-10 bottom-0">
                        <h3 class="text-white fs-2qx fw-bold mb-3 m">{{ $career->name }}</h3>
                        <div class="fs-5 fw-semibold">{{ $career->department }}</div>
                    </div>
                    <!--end::Heading-->
                </div>
                <div class="d-flex flex-column flex-lg-row mb-17">
                    <div class="flex-lg-row-fluid me-0 me-lg-20">
                        <div class="mb-10 mb-lg-0">
                            <div class="m-0">
                               {!! $career->description !!}
                            </div>
                        </div>
                        <div class="d-flex flex-wrap mb-5">
                            <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                <div class="fw-semibold text-gray-500">Graduate</div>
                                <div class="fs-6 fw-bold text-gray-900">{{ $career->graduate }}</div>
                            </div>
                            <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                <div class="fw-semibold text-gray-500">Salary</div>
                                <div class="fs-6 fw-bold text-success">{{ $career->salary }}</div>
                            </div>
                            <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                <div class="fw-semibold text-gray-500">Need</div>
                                <div class="fs-6 fw-bold text-gray-900">{{ $career->candidate }}</div>
                            </div>
                        </div>
                        {{-- <form action="m-0" class="form mb-15" method="post" id="kt_careers_form">
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-semibold mb-2">First Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="first_name" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--end::Label-->
                                    <label class="required fs-5 fw-semibold mb-2">Last Name</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="last_name" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-semibold mb-2">Email</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="" name="email" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--end::Label-->
                                    <label class="fs-5 fw-semibold mb-2">Mobile No</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="mobileno" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-semibold mb-2">Age</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="age" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--end::Label-->
                                    <label class="required fs-5 fw-semibold mb-2">City</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="city" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                    <span class="required">Position</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Your payment statements may very based on selected position">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select name="position" data-control="select2" data-placeholder="Select a position..." class="form-select form-select-solid">
                                    <option value="Web Developer">Web Developer</option>
                                    <option value="Web Designer">Web Designer</option>
                                    <option value="Art Director">Art Director</option>
                                    <option value="Finance Manager">Finance Manager</option>
                                    <option value="Project Manager">Project Manager</option>
                                    <option value="System Administrator">System Administrator</option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-semibold mb-2">Expected Salary</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="salary" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--end::Label-->
                                    <label class="required fs-5 fw-semibold mb-2">Srart Date</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="start_date" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-semibold mb-2">Website (If Any)</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="website" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5">
                                <label class="fs-6 fw-semibold mb-2">Experience (Optional)</label>
                                <textarea class="form-control form-control-solid" rows="2" name="experience" placeholder=""></textarea>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8">
                                <label class="fs-6 fw-semibold mb-2">Application</label>
                                <textarea class="form-control form-control-solid" rows="4" name="application" placeholder=""></textarea>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Separator-->
                            <div class="separator mb-8"></div>
                            <!--end::Separator-->
                            <!--begin::Submit-->
                            <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Apply Now</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait... 
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                            <!--end::Submit-->
                        </form> --}}
                    </div>
                    <div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="mb-7">
                                    <h2 class="fs-1 text-gray-800 w-bolder mb-6">About Us</h2>
                                </div>
                                <div class="mb-8">
                                    <h4 class="text-gray-700 w-bolder mb-0">Location</h4>
                                    <div class="my-2">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="text-gray-600 fw-semibold fs-6">{{ $career->location }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-8">
                                    <h4 class="text-gray-700 w-bolder mb-0">Work Function</h4>
                                    <div class="my-2">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="text-gray-600 fw-semibold fs-6">{{ $career->workfunction }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-8">
                                    <h4 class="text-gray-700 w-bolder mb-0">Major</h4>
                                    <div class="my-2">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="text-gray-600 fw-semibold fs-6">{{ $career->major }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-8">
                                    <h4 class="text-gray-700 w-bolder mb-0">Experience</h4>
                                    <div class="my-2">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="text-gray-600 fw-semibold fs-6">{{ $career->experience }}</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-flex btn-primary px-6"  data-bs-toggle="modal" data-bs-target="#kt_modal_scrollable_2">
                                    <i class="ki-duotone ki-briefcase fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                    <span class="d-flex flex-column align-items-start ms-2">
                                        <span class="fs-3 fw-bold">Apply</span>
                                        <span class="fs-7">This Job</span>
                                    </span>
                                </a>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="kt_modal_scrollable_2">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Profile & Documents Check</h5>
        
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <h6 class="modal-title mb-8">Profile</h6>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                            <div class="col-lg-8">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ Auth::user()->profile['avatar_url'] ?? '/assets/media/avatars/300-1.jpg' }})"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="ki-outline ki-pencil fs-7"></i>
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                </div>
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">NIK Karyawan</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="employee_nik" class="form-control form-control-lg form-control-solid" placeholder="NIK Karyawan" value="{{ $user->profile['employee_nik'] ?? '' }}" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Alamat</label>
                            <div class="col-lg-8 fv-row">
                                <textarea name="address" class="form-control form-control-lg form-control-solid" placeholder="Alamat">{{ $user->profile['address'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jenis Kelamin</label>
                            <div class="col-lg-8 fv-row">
                                <select class="form-select form-control-lg form-control-solid" name="gender" data-placeholder="Select an option">
                                    <option>Pilih</option>
                                    @if($user->profile && isset($user->profile['gender']))
                                    <option value="Laki-Laki" {{ $user->profile['gender'] == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ $user->profile['gender'] == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    @else
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Status Pernikahan</label>
                            <div class="col-lg-8 fv-row">
                                <select class="form-select form-control-lg form-control-solid" name="marriage_status" data-placeholder="Select an option">
                                    <option>Pilih</option>
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
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Ibu Kandung</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="mother_name" class="form-control form-control-lg form-control-solid" placeholder="Nama Ibu Kandung" value="{{ $user->profile['mother_name'] ?? '' }}" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tempat Lahir</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="birth_place" class="form-control form-control-lg form-control-solid" placeholder="Tempat Lahir" value="{{ $user->profile['birth_place'] ?? '' }}" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tanggal Lahir</label>
                            <div class="col-lg-8 fv-row">
                                <input type="date" name="birth_date" class="form-control form-control-lg form-control-solid" placeholder="Tanggal Lahir" value="{{ $user->profile['birth_date'] ?? '' }}" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">No NPWP</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="npwp_number" class="form-control form-control-lg form-control-solid" placeholder="No NPWP" value="{{ $user->profile['npwp_number'] ?? '' }}" />
                            </div>
                        </div>
                        <h6 class="modal-title mb-8 mt-8">Documents</h6>
                        @foreach ($documents as $document)  
                        <div class="d-flex flex-stack">
                            <div class="symbol symbol-40px me-5">
                                <img src="{{ $document->file_url }}" class="h-50 align-self-center" alt="" />
                            </div>
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-6 fw-bold">{{ $document->name }}</a>
                                    <span class="text-muted fw-semibold d-block fs-7">{{ $document->description }}</span>
                                </div>
                                <a href="pages/user-profile/overview.html" class="btn btn-sm btn-light fs-8 fw-bold">{{ $document->validate }}</a>
                            </div>
                        </div>
                        <div class="separator separator-dashed my-4"></div>
                        @endforeach
                    </div>
        
                    <div class="modal-footer">
                        <form class="form" action="{{ route('applicants.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="career_id" value="{{ $career->id }}">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection