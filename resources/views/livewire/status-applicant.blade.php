<div>
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" wire:model.live="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search company" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                    </div>
                    <div class="separator border-gray-200"></div>
                    <div class="px-7 py-5" data-kt-user-table-filter="form">
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Career:</label>
                            <select wire:model="careerId" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="role">
                                <option></option>
                                @foreach ($careers as $career)
                                   <option value="{{ $career->id }}">{{ $career->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                <i class="ki-outline ki-exit-up fs-2"></i>Export</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                    Request
                    @if ($status->unapprovedApplicants() && $status->unapprovedApplicants()->count() > 0)  
                        <span class="menu-badge">
                            <span class="badge badge-danger">{{ $status->unapprovedApplicants()->count() }}</span>
                        </span>
                    @endif
                </button>
            </div>
            <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header" id="kt_modal_add_user_header">
                            <h2 class="fw-bold">Request Approval</h2>
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                <i class="ki-outline ki-cross fs-1"></i>
                            </div>
                        </div>
                        <div class="modal-body px-5 my-7">
                            @foreach ($applicantsReq as $key => $applicantReq)
                                @if ($applicantReq->status_id == $status->id)
                                    <div class="d-flex align-items-center position-relative mb-7">
                                        <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                        <div class="fw-semibold ms-5">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary">{{ $applicantReq->career['name'] }}</a>
                                            <div class="fs-7 text-muted">Due in 1 day 
                                            <a href="#">{{ $applicantReq->user['name'] }}</a></div>
                                        </div>
                                        <a href="{{ route('update-approve', $applicantReq->id) }}" onclick="event.preventDefault();
                                        document.getElementById('approve-{{ $applicantReq->id }}').submit();" class="btn btn-light-success btn-sm  ms-auto" data-kt-menu-placement="bottom-end">Approve</a>
                                        <form id="approve-{{ $applicantReq->id }}" action="{{ route('update-approve', $applicantReq->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="approve_id" value="{{ Auth::user()->id }}">
                                        </form>
                                    </div>
                                @endif
                            @endforeach
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
                    <th class="min-w-125px">Name</th>
                    <th class="min-w-125px">Job</th>
                    <th class="min-w-125px">Department</th>
                    <th class="min-w-125px">Status</th>
                    <th class="min-w-125px"></th>
                    <th class="min-w-125px">Approve By</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @foreach ($applicants as $key => $applicant)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" />
                                </div>
                            </td>
                            <td>{{ $applicant->user['name'] }}</td>
                            <td>
                                {{ $applicant->career['name'] }}
                                <br>
                                <small>{{ $applicant->career->company['name'] ?? '' }}</small>
                            </td>
                            <td>{{ $applicant->career['department'] }}</td>
                            <td>
                                <select class="form-select" name="status_id" data-placeholder="Select an option" onchange="event.preventDefault(); document.getElementById('status-input-{{ $applicant->id }}').value = this.value; document.getElementById('update-status-{{ $applicant->id }}').submit();">
                                    <option disabled selected>Pilih status</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}"  {{ $applicant->status_id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                <form id="update-status-{{ $applicant->id }}" action="{{ route('update-status', $applicant->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status_id" id="status-input-{{ $applicant->id }}">
                                </form>
                            </td>
                            <td>
                                @if ($applicant->done == 'done')
                                <span class="badge badge-light-success">done</span>
                                @elseif($applicant->status['color'] == 'danger')
                                <span class="badge badge-light-danger">{{ $applicant->status['name'] }}</span>
                                @else
                                <span class="badge badge-light-warning">progress</span>
                                @endif
                            </td>
                            <td>
                                @if ($applicant->approve_id ==! null)
                                {{ $applicant->approve['name'] }}
                                @else
                                <form action="{{ route('update-approve', $applicant->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="approve_id" value="{{ Auth::user()->id }}">
                                    <button type="submit" class="btn btn-light-success btn-sm">Approve</button>
                                </form>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $applicant->id }}">Edit</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $applicant->id }}">Hapus</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </td>
                        </tr>
                        <div class="modal fade" id="modal-delete{{ $applicant->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Hapus {{ $applicant->user['name'] }} ?</h3>
                        
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
                                        <a href="{{ route('applicants.destroy', $applicant->id) }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('delete-applicant').submit();" class="btn btn-danger">Hapus</a>
                                    </div>
                                    <form id="delete-applicant" action="{{ route('applicants.destroy', $applicant->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modal-edit{{ $applicant->id }}" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header" id="kt_modal_add_user_header">
                                        <h2 class="fw-bold">Edit Applicant</h2>
                                    </div>
                                    <div class="modal-body px-5 my-7">
                                        <!--begin::Form-->
                                        <form class="form" action="{{ route('applicants.update', ['applicant' => $applicant->id]) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
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
