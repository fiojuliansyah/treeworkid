@extends('layouts.main')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="pb-7">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Role List</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                Managements
                             </li>
                             <li class="breadcrumb-item">
                                 <span class="bullet bg-gray-500 w-5px h-2px"></span>
                             </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('roles.index') }}" class="text-muted text-hover-primary">Roles</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                    @foreach ($roles as $role)
                    <div class="col-md-4">
                        <div class="card card-flush h-md-100">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ $role->name }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-1">
                                <!--begin::Users-->
                                <div class="fw-bold text-gray-600 mb-5">Role ID: {{ $role->id }}</div>
                                <!--end::Users-->
                                <!--begin::Permissions-->
                                <div class="d-flex flex-column text-gray-600">
                                    @foreach($role->permissions->groupBy('category') as $category => $permissionGroup)
                                    <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>{{ $category }} &nbsp;
                                    @foreach($permissionGroup as $permission)
                                        @if ($permission->status == '1')
                                                <span class="badge badge-light-danger">{{ $permission->mock }}</span> &nbsp;
                                        @endif
                                    @endforeach
                                    </div>
                                    {{-- <div class="d-flex align-items-center py-2">
                                    </div> --}}
                                    @endforeach
                                    <div class='d-flex align-items-center py-2'>
                                        <span class='bullet bg-primary me-3'></span>
                                        <em>and more...</em>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer flex-wrap pt-0">
                                <button type="button" class="btn btn-light btn-active-light-primary my-1" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role{{ $role->id }}">Edit Role</button>
                            </div>
                            <div class="modal fade" id="kt_modal_update_role{{ $role->id }}" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-750px">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bold">Update Role</h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                                                <i class="ki-outline ki-cross fs-1"></i>
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <!--end::Modal header-->
                                        <!--begin::Modal body-->
                                        <div class="modal-body scroll-y mx-5 my-7">
                                            <!--begin::Form-->
                                            <form id="kt_modal_update_role_form" action="{{ route('roles.update', ['role' => $role->id]) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <!--begin::Scroll-->
                                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-10">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-bold form-label mb-2">
                                                            <span class="required">Role name</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input class="form-control form-control-solid" placeholder="Enter a role name" name="name" value="{{ $role->name }}" />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Permissions-->
                                                    <div class="fv-row">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                                                        <!--end::Label-->
                                                        <!--begin::Table wrapper-->
                                                        <div class="table-responsive">
                                                            <!--begin::Table-->
                                                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                                <!--begin::Table body-->
                                                                <tbody class="text-gray-600 fw-semibold">
                                                                    @foreach($permissions->groupBy('category') as $category => $permissionGroup)
                                                                    <tr>
                                                                        <td class="text-gray-800">{{ $category }}</td>
                                                                        <td>
                                                                            <div class="d-flex">
                                                                                @foreach($permissionGroup as $permission)
                                                                                    @if ($permission->status == '1')
                                                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                                            <input class="form-check-input" type="checkbox" value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} name="permission[]" />
                                                                                            <span class="form-check-label">{{ $permission->mock }}</span>
                                                                                        </label>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <!--end::Table body-->
                                                            </table>
                                                            <!--end::Table-->
                                                        </div>
                                                        <!--end::Table wrapper-->
                                                    </div>
                                                    <!--end::Permissions-->
                                                </div>
                                                <!--end::Scroll-->
                                                <!--begin::Actions-->
                                                <div class="text-center pt-15">
                                                    <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                                        <span class="indicator-label">Submit</span>
                                                        <span class="indicator-progress">Please wait... 
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Modal body-->
                                    </div>
                                    <!--end::Modal content-->
                                </div>
                                <!--end::Modal dialog-->
                            </div>
                            <!--end::Card footer-->
                        </div>
                    </div>
                    @endforeach
                    <div class="ol-md-4">
                        <!--begin::Card-->
                        <div class="card h-md-100">
                            <!--begin::Card body-->
                            <div class="card-body d-flex flex-center">
                                <!--begin::Button-->
                                <button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                                    <!--begin::Illustration-->
                                    <img src="/assets/media/illustrations/sketchy-1/4.png" alt="" class="mw-100 mh-150px mb-7" />
                                    <!--end::Illustration-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-3 text-gray-600 text-hover-primary">Add New Role</div>
                                    <!--end::Label-->
                                </button>
                                <!--begin::Button-->
                            </div>
                            <!--begin::Card body-->
                        </div>
                        <!--begin::Card-->
                    </div>
                    <!--begin::Add new card-->
                </div>
                <!--end::Row-->
                <!--begin::Modals-->
                <!--begin::Modal - Add role-->
                <div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-750px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Add a Role</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                                    <i class="ki-outline ki-cross fs-1"></i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-lg-5 my-7">
                                <!--begin::Form-->
                                <form action="{{ route('roles.store') }}" method="POST">
                                    @csrf
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bold form-label mb-2">
                                                <span class="required">Role name</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder="Enter a role name" name="name" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Permissions-->
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                                            <!--end::Label-->
                                            <!--begin::Table wrapper-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                    <!--begin::Table body-->
                                                    <tbody class="text-gray-600 fw-semibold">
                                                        <!--begin::Table row-->
                                                        @foreach($permissions->groupBy('category') as $category => $permissionGroup)
                                                        <tr>
                                                            <td class="text-gray-800">{{ $category }}</td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    @foreach($permissionGroup as $permission)
                                                                        @if ($permission->status == '1')
                                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                                <input class="form-check-input" type="checkbox" value="{{ $permission->name }}" name="permission[]" />
                                                                                <span class="form-check-label">{{ $permission->mock }}</span>
                                                                            </label>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Table wrapper-->
                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait... 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
</div>
@endsection