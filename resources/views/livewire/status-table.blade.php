<div>
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" wire:model.live="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search status" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                <i class="ki-outline ki-plus fs-2"></i>Add Status</button>
            </div>
            <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_add_user_header">
                            <h2 class="fw-bold">Add Status</h2>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body px-5 my-7">
                            <!--begin::Form-->
                            <form class="form" action="{{ route('statuses.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="fv-row mb-7">
                                                <label class="required fw-semibold fs-6 mb-2">Pilih Warna</label>
                                                <select class="form-select mb-3 mb-lg-0" name="color" data-placeholder="Select an option">
                                                    <option value="primary">Pilih warna</option>
                                                    <option value="primary">Primary</option>
                                                    <option value="secondary">Secondary</option>
                                                    <option value="success">Success</option>
                                                    <option value="warning">Warning</option>
                                                    <option value="info">Info</option>
                                                    <option value="danger">Danger</option>
                                                </select>                                    
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="fv-row mb-7">
                                                <label class="required fw-semibold fs-6 mb-2">Status Name</label>
                                                <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="name"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <label class="fw-semibold fs-6 mb-2" for="is_approve">Is Request Approve</label>
                                                <select class="form-select mb-3 mb-lg-0" name="is_approve" data-placeholder="Select an option">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <label class="fw-semibold fs-6 mb-2" for="is_bulk_letter">Is Bulk Letter</label>
                                                <select class="form-select mb-3 mb-lg-0" name="is_bulk_letter" data-placeholder="Select an option">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body py-4 table-responsive">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                        </div>
                    </th>
                    <th class="min-w-125px">ID</th>
                    <th class="min-w-125px">Name</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @foreach ($statuses as $key => $status)                                    
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                    </td>
                    <td>{{ $status->id }}</td>
                    <td>
                        <i class="fas fa-dot-circle text-{{ $status->color }}"></i>
                         {{ $status->name }}
                            @if ($status->is_approve == '1')
                                <span class="badge badge-light-success">
                                    Is Request Approved
                                </span>
                            @endif
                            @if ($status->is_bulk_letter == '1')
                                <span class="badge badge-light-info">
                                    Is Bulk Letter
                                </span>
                            @endif
                    </td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                        <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $status->id }}">Edit</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $status->id }}">Hapus</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                </tr>
                <div class="modal fade" id="modal-delete{{ $status->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Hapus {{ $status->name }} ?</h3>
                
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                                <!--end::Close-->
                            </div>
                
                            <div class="modal-body">
                                <p>Pastikan data yang mau anda hapus itu adalah benar!</p>
                            </div>
                
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <a href="{{ route('statuses.destroy', $status->id) }}"
                                onclick="event.preventDefault();
                                              document.getElementById('delete-status-{{ $status->id }}').submit();" class="btn btn-danger">Hapus</a>
                            </div>
                            <form id="delete-status-{{ $status->id }}" action="{{ route('statuses.destroy', $status->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-edit{{ $status->id }}" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_user_header">
                                <h2 class="fw-bold">Edit Status</h2>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <!--begin::Form-->
                                <form class="form" action="{{ route('statuses.update', ['status' => $status->id]) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Pilih Warna</label>
                                                    <select class="form-select mb-3 mb-lg-0" name="color" data-placeholder="Select an option">
                                                        <option value="primary" {{ $status->color == 'primary' ? 'selected' : '' }}>Primary</option>
                                                        <option value="secondary" {{ $status->color == 'secondary' ? 'selected' : '' }}>Secondary</option>
                                                        <option value="success" {{ $status->color == 'success' ? 'selected' : '' }}>Success</option>
                                                        <option value="warning" {{ $status->color == 'warning' ? 'selected' : '' }}>Warning</option>
                                                        <option value="info" {{ $status->color == 'info' ? 'selected' : '' }}>Info</option>
                                                        <option value="danger" {{ $status->color == 'danger' ? 'selected' : '' }}>Danger</option>
                                                    </select>                                    
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Status Name</label>
                                                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $status->name }}"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="fv-row mb-7">
                                                        <label class="fw-semibold fs-6 mb-2" for="is_approve">Is Request Approve</label>
                                                        <select class="form-select mb-3 mb-lg-0" name="is_approve" data-placeholder="Select an option">
                                                            <option value="0" {{ $status->is_approve == 0 ? 'selected' : '' }}>No</option>
                                                            <option value="1" {{ $status->is_approve == 1 ? 'selected' : '' }}>Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="fv-row mb-7">
                                                        <label class="fw-semibold fs-6 mb-2" for="is_bulk_letter">Is Bulk Letter</label>
                                                        <select class="form-select mb-3 mb-lg-0" name="is_bulk_letter" data-placeholder="Select an option">
                                                            <option value="0" {{ $status->is_bulk_letter == 0 ? 'selected' : '' }}>No</option>
                                                            <option value="1" {{ $status->is_bulk_letter == 1 ? 'selected' : '' }}>Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
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
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
