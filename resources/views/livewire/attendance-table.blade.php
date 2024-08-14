<div>
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" wire:model.live="search" data-kt-attendance-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search attendance" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-attendance-table-toolbar="base">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_attendance">
                <i class="ki-outline ki-plus fs-2"></i>Add Attendance</button>
            </div>
            <div class="modal fade" id="kt_modal_add_attendance" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header" id="kt_modal_add_attendance_header">
                            <h2 class="fw-bold">Add Attendance</h2>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body px-5 my-7">
                            <form class="form" action="{{ route('attendances.store') }}" method="POST">
                                @csrf
                                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_attendance_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_attendance_header" data-kt-scroll-wrappers="#kt_modal_add_attendance_scroll" data-kt-scroll-offset="300px">
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Date</label>
                                        <input type="date" name="date" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Select date"/>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">LatLong</label>
                                        <input type="text" name="latlong" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Enter latlong"/>
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
                                        <label class="required fw-semibold fs-6 mb-2">Site</label>
                                        <select class="form-select mb-3 mb-lg-0" name="site_id" data-placeholder="Select site">
                                            @foreach($sites as $site)
                                                <option value="{{ $site->id }}">{{ $site->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Clock In</label>
                                        <input type="time" name="clock_in" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Enter clock in time"/>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Clock Out</label>
                                        <input type="time" name="clock_out" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Enter clock out time"/>
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
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_attendances">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_attendances .form-check-input" value="1" />
                        </div>
                    </th>
                    <th class="min-w-125px">Date</th>
                    <th class="min-w-125px">LatLong</th>
                    <th class="min-w-125px">User</th>
                    <th class="min-w-125px">Site</th>
                    <th class="min-w-125px">Clock In</th>
                    <th class="min-w-125px">Clock Out</th>
                    <th class="min-w-125px">Lebur   </th>
                    <th class="min-w-125px">Berita Acara</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @foreach ($attendances as $attendance)
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                    </td>
                    <td>{{ $attendance->date->format('d-M-Y') }}</td>
                    <td>{{ $attendance->latlong }}</td>
                    <td>{{ $attendance->user->name ?? 'N/A' }}</td>
                    <td>{{ $attendance->site->name ?? 'N/A' }}</td>
                    <td>
                        @if($attendance->clock_in)
                                {{ $attendance->clock_in->format('H:i') }}
                        @else
                            {{ '' }}
                        @endif
                    </td>
                    <td>
                        @if($attendance->clock_out)
                                {{ $attendance->clock_out->format('H:i') }}
                        @else
                            {{ '' }}
                        @endif
                    </td>
                    <td>
                        @if ($attendance->overtimes)
                            @foreach ($attendance->overtimes as $overtime)    
                                {{ $overtime->clock_in }} - {{ $overtime->clock_out }}
                            @endforeach
                        @else
                            <span class="badge badge-danger">Tidak</span>
                        @endif
                    </td>
                    <td>
                        @if ($attendance->type != null)
                            <span class="badge badge-success">Menggunakan</span>
                        @else
                            
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                        <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $attendance->id }}">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $attendance->id }}">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="modal-delete{{ $attendance->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Delete {{ $attendance->date }} ?</h3>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this record?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <a href="{{ route('attendances.destroy', $attendance->id) }}"
                                onclick="event.preventDefault();
                                              document.getElementById('delete-attendance').submit();" class="btn btn-danger">Delete</a>
                            </div>
                            <form id="delete-attendance" action="{{ route('attendances.destroy', $attendance->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-edit{{ $attendance->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header" id="kt_modal_edit_attendance_header">
                                <h2 class="fw-bold">Edit Attendance</h2>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <form class="form" action="{{ route('attendances.update', ['attendance' => $attendance->id]) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_edit_attendance_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_attendance_header" data-kt-scroll-wrappers="#kt_modal_edit_attendance_scroll" data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Date</label>
                                            <input type="date" name="date" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $attendance->date }}"/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">LatLong</label>
                                            <input type="text" name="latlong" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $attendance->latlong }}"/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">User</label>
                                            <select class="form-select mb-3 mb-lg-0" name="user_id" data-placeholder="Select user">
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ $attendance->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Site</label>
                                            <select class="form-select mb-3 mb-lg-0" name="site_id" data-placeholder="Select site">
                                                @foreach($sites as $site)
                                                    <option value="{{ $site->id }}" {{ $attendance->site_id == $site->id ? 'selected' : '' }}>{{ $site->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Clock In</label>
                                            <input type="time" name="clock_in" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $attendance->clock_in }}"/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Clock Out</label>
                                            <input type="time" name="clock_out" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $attendance->clock_out }}"/>
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
        {{ $attendances->links() }}
    </div>
</div>
