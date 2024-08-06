@extends('layouts.main')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="pb-7">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Attendance Report</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                Report
                             </li>
                             <li class="breadcrumb-item">
                                 <span class="bullet bg-gray-500 w-5px h-2px"></span>
                             </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('attendance.report') }}" class="text-muted text-hover-primary">Attendances</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
                    <div class="col-md-6 col-xxl-4">
                        <div class="card">
                            <div class="card-body d-flex flex-column py-9 px-5">
                                <h1 class="page-heading d-flex flex-center flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Employee Attendance</h1>
                                <form action="{{ route('employee.view') }}" method="GET">
                                    <div class="mt-10 mb-5">
                                        <label class="form-label fs-6 fw-semibold">Employee :</label>
                                        <select name="user_id" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                            <option value="">Select Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-semibold">Start Date :</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-semibold">End Date :</label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-light-primary btn-flex btn-center">
                                        <span class="indicator-label">Export</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="card">
                            <div class="card-body d-flex flex-column py-9 px-5">
                                <h1 class="page-heading d-flex flex-center flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Site Attendance</h1>
                                <form action="{{ route('site.view') }}" method="GET">
                                    <div class="mt-10 mb-5">
                                        <label class="form-label fs-6 fw-semibold">Site :</label>
                                        <select name="site_id" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                            <option value="">Select Site</option>
                                            @foreach ($sites as $site)
                                                <option value="{{ $site->id }}">{{ $site->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-semibold">Start Date :</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-semibold">End Date :</label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-light-primary btn-flex btn-center">
                                        <span class="indicator-label">Export</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection