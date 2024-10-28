@extends('layouts.main')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card">
                    <form class="form" action="{{ route('sites.update', ['site' => $site->id]) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Pilih Perusahaan</label>
                                <select class="form-select" name="company_id" data-placeholder="Select an option">
                                    <option></option>
                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ $site->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Site Name</label>
                                <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $site->name }} "/>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Description</label>
                                <input type="text" name="description" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $site->description }} "/>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="fv-row mb-7">
                                        <div class="col">
                                            <label class="required fw-semibold fs-6 mb-2">Latitude</label>
                                            <input type="text" name="lat" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $site->lat }} "/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fv-row mb-7">
                                        <div class="col">
                                            <label class="required fw-semibold fs-6 mb-2">Longitude</label>
                                            <input type="text" name="long" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $site->long }} "/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Radius</label>
                                <input type="text" name="radius" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $site->radius }}" />
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="fv-row mb-7">
                                        <div class="col">
                                            <label class="required fw-semibold fs-6 mb-2">Nama Client</label>
                                            <input type="text" name="client_name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $site->client_name }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fv-row mb-7">
                                        <div class="col">
                                            <label class="required fw-semibold fs-6 mb-2">No Whatsapp Client</label>
                                            <input type="text" name="client_phone" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $site->client_phone }}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Email Client</label>
                                <input type="text" name="client_email" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $site->client_email }}"/>
                            </div>
                        </div>
                        <div class="text-center pt-10">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait... 
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection