<div>
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" wire:model.live="search" data-kt-minute-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search minutes" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-minute-table-toolbar="base">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_minute">
                    <i class="ki-outline ki-plus fs-2"></i>Add Minute
                </button>
            </div>
        </div>
    </div>

    <div class="card-body py-4 table-responsive">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_minutes">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_minutes .form-check-input" value="1" />
                        </div>
                    </th>
                    <th class="min-w-125px">Date</th>
                    <th class="min-w-125px">Type</th>
                    <th class="min-w-125px">Remark</th>
                    <th class="min-w-125px">Image</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @foreach ($minutes as $minute)
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                    </td>
                    <td>{{ $minute->attendance->date ?? 'N/A' }}</td>
                    <td>{{ $minute->type }}</td>
                    <td>{{ $minute->remark }}</td>
                    <td>
                        @if ($minute->image_url)
                            <img src="{{ $minute->image_url }}" alt="Image" class="img-fluid" style="max-height: 50px;">
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-outline ki-down fs-5 ms-1"></i>
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-edit-minute{{ $minute->id }}">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-delete-minute{{ $minute->id }}">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="modal-edit-minute{{ $minute->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header" id="kt_modal_edit_minute_header">
                                <h2 class="fw-bold">Edit Minute</h2>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <form class="form" action="{{ route('minutes.update', $minute->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_edit_minute_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_minute_header" data-kt-scroll-wrappers="#kt_modal_edit_minute_scroll" data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Type</label>
                                            <input type="text" name="type" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $minute->type }}" required/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Remark</label>
                                            <textarea name="remark" class="form-control form-control-solid mb-3 mb-lg-0" rows="3" required>{{ $minute->remark }}</textarea>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" class="form-control form-control-solid mb-3 mb-lg-0"/>
                                            @if ($minute->image_url)
                                                <div class="mt-2">
                                                    <img src="{{ $minute->image_url }}" alt="Image" class="img-fluid" style="max-height: 150px;">
                                                </div>
                                            @endif
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

                <!-- Delete Modal -->
                <div class="modal fade" id="modal-delete-minute{{ $minute->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Delete Minute Record</h3>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this minute record?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <a href="{{ route('minutes.destroy', $minute->id) }}"
                                onclick="event.preventDefault();
                                              document.getElementById('delete-minute-{{ $minute->id }}').submit();" class="btn btn-danger">Delete</a>
                            </div>
                            <form id="delete-minute-{{ $minute->id }}" action="{{ route('minutes.destroy', $minute->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $minutes->links() }}
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="kt_modal_add_minute" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_minute_header">
                    <h2 class="fw-bold">Add Minute</h2>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body px-5 my-7">
                    <form class="form" action="{{ route('minutes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_minute_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_minute_header" data-kt-scroll-wrappers="#kt_modal_add_minute_scroll" data-kt-scroll-offset="300px">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Type</label>
                                <select name="type" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                    <option value="" disabled selected>Select type</option>
                                    <option value="clockin">Clock In</option>
                                    <option value="clockout">Clock Out</option>
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Remark</label>
                                <textarea name="remark" class="form-control form-control-solid mb-3 mb-lg-0" rows="3" placeholder="Enter remark" required></textarea>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control form-control-solid mb-3 mb-lg-0"/>
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
