<div>
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" wire:model="search" data-kt-leave-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search leaves" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-leave-table-toolbar="base">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_leave">
                    <i class="ki-outline ki-plus fs-2"></i>Add Leave
                </button>
            </div>
            <div class="modal fade" id="kt_modal_add_leave" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header" id="kt_modal_add_leave_header">
                            <h2 class="fw-bold">Add Leave</h2>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body px-5 my-7">
                            <form class="form" action="{{ route('leaves.store') }}" method="POST">
                                @csrf
                                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_leave_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_leave_header" data-kt-scroll-wrappers="#kt_modal_add_leave_scroll" data-kt-scroll-offset="300px">
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Start Date</label>
                                        <input type="date" name="start_date" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Select start date"/>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">End Date</label>
                                        <input type="date" name="end_date" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Select end date"/>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">User</label>
                                        <select class="form-select mb-3 mb-lg-0" name="user_id" data-placeholder="Select user">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Type</label>
                                        <select class="form-select mb-3 mb-lg-0" name="type" data-placeholder="Select type">
                                            <option value="Sick Leave">Sick Leave</option>
                                            <option value="Vacation">Vacation</option>
                                            <option value="Personal">Personal</option>
                                        </select>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Reason</label>
                                        <textarea class="form-control form-control-solid mb-3 mb-lg-0" name="reason" rows="3" placeholder="Enter Reason"></textarea>
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
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_leaves">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_leaves .form-check-input" value="1" />
                        </div>
                    </th>
                    <th class="min-w-125px">Start Date</th>
                    <th class="min-w-125px">End Date</th>
                    <th class="min-w-125px">User</th>
                    <th class="min-w-125px">Type</th>
                    <th class="min-w-125px">Reason</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @foreach ($leaves as $leave)
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                    </td>
                    <td>{{ $leave->start_date ?? '' }}</td>
                    <td>{{ $leave->end_date ?? '' }}</td>
                    <td>{{ $leave->user->name ?? 'N/A' }}</td>
                    <td>{{ $leave->type['name'] ?? '' }}</td>
                    <td>{{ $leave->reason ?? '' }}</td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-outline ki-down fs-5 ms-1"></i>
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $leave->id }}">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $leave->id }}">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="modal-delete{{ $leave->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Delete Leave?</h3>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this record?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('delete-leave-{{ $leave->id }}').submit();"
                                    class="btn btn-danger">Delete</a>
                                <form id="delete-leave-{{ $leave->id }}" action="{{ route('leaves.destroy', $leave->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-edit{{ $leave->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header" id="kt_modal_edit_leave_header">
                                <h2 class="fw-bold">Edit Leave</h2>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <form class="form" action="{{ route('leaves.update', $leave->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_edit_leave_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_leave_header" data-kt-scroll-wrappers="#kt_modal_edit_leave_scroll" data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Start Date</label>
                                            <input type="date" name="start_date" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $leave->start_date }}"/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">End Date</label>
                                            <input type="date" name="end_date" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $leave->end_date }}"/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">User</label>
                                            <select class="form-select mb-3 mb-lg-0" name="user_id" data-placeholder="Select user">
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ $leave->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Type</label>
                                            <select class="form-select mb-3 mb-lg-0" name="type" data-placeholder="Select type">
                                                <option value="Sick Leave" {{ $leave->type == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                                                <option value="Vacation" {{ $leave->type == 'Vacation' ? 'selected' : '' }}>Vacation</option>
                                                <option value="Personal" {{ $leave->type == 'Personal' ? 'selected' : '' }}>Personal</option>
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Reason</label>
                                            <textarea class="form-control form-control-solid mb-3 mb-lg-0" name="reason" rows="3" placeholder="Enter Reason">{{ $leave->reason }}</textarea>
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
    <div class="mt-4">
        {{ $leaves->links() }}
    </div>
</div>
