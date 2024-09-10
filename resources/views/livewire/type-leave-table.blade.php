<!-- HTML for displaying the type leaves and the modals for adding and editing -->
<div>
    <!-- Search and Add Button -->
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" wire:model.live="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search type" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                    <i class="ki-outline ki-plus fs-2"></i>Add Type
                </button>
            </div>
        </div>
    </div>

    <!-- Add Type Modal -->
    <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <h2 class="fw-bold">Add Type</h2>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body px-5 my-7">
                    <form class="form" action="{{ route('types.store') }}" method="POST">
                        @csrf
                        <div class="d-flex flex-column scroll-y px-5 px-lg-10" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                            <div class="row">
                                <div class="col-6">
                                    <div class="fv-row mb-7">
                                        <label class="form-label fs-6 fw-semibold">Site :</label>
                                        <select name="site_id" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                            <option value="">Select Site</option>
                                            @foreach ($sites as $site)
                                                <option value="{{ $site->id }}">{{ $site->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Status Name</label>
                                        <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Name"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Is Paid</label>
                                        <select class="form-select mb-3 mb-lg-0" name="is_paid" data-placeholder="Select an option">
                                            <option value="">Select Status</option>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Total</label>
                                        <input type="text" name="total" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Total"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Max Per Month</label>
                                        <input type="text" name="max_per_month" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Max Per Month"/>
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

    <!-- Table Display -->
    <div class="card-body py-4 table-responsive">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                        </div>
                    </th>
                    <th class="min-w-125px">Site</th>
                    <th class="min-w-125px">Name</th>
                    <th class="min-w-125px">Total</th>
                    <th class="min-w-125px">Max per Month</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @foreach ($types as $key => $type)                                    
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                    </td>
                    <td>{{ $type->site['name'] ?? '' }}</td>
                    <td>{{ $type->name ?? '' }}</td>
                    <td>{{ $type->total ?? '' }}</td>
                    <td>{{ $type->max_per_month ?? '' }}</td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                        <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $type->id }}">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $type->id }}">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="modal-delete{{ $type->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Delete {{ $type->name }} ?</h3>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this item?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <a href="{{ route('types.destroy', $type->id) }}" onclick="event.preventDefault(); document.getElementById('delete-type-{{ $type->id }}').submit();" class="btn btn-danger">Delete</a>
                            </div>
                            <form id="delete-type-{{ $type->id }}" action="{{ route('types.destroy', $type->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Type Modal -->
                <div class="modal fade" id="modal-edit{{ $type->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header" id="kt_modal_add_user_header">
                                <h2 class="fw-bold">Edit Type</h2>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <form class="form" action="{{ route('types.update', $type->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Site ID</label>
                                                    <select class="form-select mb-3 mb-lg-0" name="site_id" data-placeholder="Select an option">
                                                        <option value="">Select Site ID</option>
                                                        @foreach ($sites as $site) 
                                                            <option value="{{ $site->id }}" {{ $type->site_id == $site->id ? 'selected' : '' }}>{{ $site->name }}</option>
                                                        @endforeach
                                                        <!-- Add more options as needed -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Status Name</label>
                                                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $type->name }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="fw-semibold fs-6 mb-2">Is Paid</label>
                                                    <select class="form-select mb-3 mb-lg-0" name="is_paid" data-placeholder="Select an option">
                                                        <option value="0" {{ $type->is_paid == 0 ? 'selected' : '' }}>No</option>
                                                        <option value="1" {{ $type->is_paid == 1 ? 'selected' : '' }}>Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="fw-semibold fs-6 mb-2">Total</label>
                                                    <input type="text" name="total" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $type->total }}"/>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="fw-semibold fs-6 mb-2">Max Per Month</label>
                                                    <input type="text" name="max_per_month" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $type->max_per_month }}"/>
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
