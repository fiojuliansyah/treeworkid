<div>
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" wire:model.live="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search career" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                <i class="ki-outline ki-plus fs-2"></i>Add Career</button>
            </div>
            <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_add_user_header">
                            <h2 class="fw-bold">Add Career</h2>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body px-5 my-7">
                            <!--begin::Form-->
                            <form class="form" action="{{ route('careers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Company</label>
                                        <select class="form-select" name="company_id" data-placeholder="Select an option">
                                            <option>Pilih ...</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}" {{ $company->is_default == 1 ? 'selected' : '' }}>{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Career Name</label>
                                        <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Security, Admin"/>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Description</label>
                                        <textarea rows="3" class="mb-3 d-none" name="description"  id="kt_docs_tinymce_basic"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <label class="fw-semibold fs-6 mb-2">Department</label>
                                                <input type="text" name="department" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Operation, Payroll, Accounting"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <label class="fw-semibold fs-6 mb-2">Location</label>
                                                <input type="text" name="location" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Jakarta Barat"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <label class="fw-semibold fs-6 mb-2">Work Function</label>
                                                <input type="text" name="workfunction" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Adminstration"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <label class="fw-semibold fs-6 mb-2">Experience</label>
                                                <input type="text" name="experience" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="3 Years"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <label class="fw-semibold fs-6 mb-2">Graduate</label>
                                                <input type="text" name="graduate" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="SMA/SMK, SI, D3"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <label class="fw-semibold fs-6 mb-2">Major</label>
                                                <input type="text" name="major" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Teknik Informatika"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <label class="fw-semibold fs-6 mb-2">Candidate</label>
                                                <input type="text" name="candidate" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="10 Pegawai"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <label class="fw-semibold fs-6 mb-2">Until Date</label>
                                                <input type="date" name="until_date" class="form-control form-control-solid mb-3 mb-lg-0"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Salary</label>
                                        <input type="text" name="salary" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="5.000.000 , Competitive"/>
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
                    <th class="min-w-125px">Name</th>
                    <th class="min-w-125px">Department</th>
                    <th class="min-w-125px">Graduate</th>
                    <th class="min-w-125px">Until Date</th>
                    <th class="min-w-125px"></th>
                    <th class="min-w-125px">Banner</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @foreach ($careers as $key => $career)                                    
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                    </td>
                    <td class="d-flex flex-column">
                        <span class="text-gray-800 mb-1">{{ $career->name }}</span>
                            <span>{{ $career->company['name'] }}</span>
                    </td>
                    <td>{{ $career->department }}</td>
                    <td>{{ $career->graduate }}</td>
                    <td>{{ $career->until_date }}</td>
                    <td>
                        @if ($career->status == 'show')
                        <form action="{{ route('update-career', $career->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="hide">
                            <button type="submit" class="btn btn-light-success btn-sm">show</button>
                        </form>
                        @else
                        <form action="{{ route('update-career', $career->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="show">
                            <button type="submit" class="btn btn-light-warning btn-sm">hide</button>
                        </form>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('banner-career', encrypt($career->id)) }}" target="_blank" class="btn btn-flex btn-primary h-30px fs-7 fw-bold">Generate</a>
                    </td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                        <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $career->id }}">Edit</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $career->id }}">Hapus</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                </tr>
                <div class="modal fade" id="modal-delete{{ $career->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Hapus {{ $career->name }} ?</h3>
                
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
                                <a href="{{ route('careers.destroy', $career->id) }}"
                                onclick="event.preventDefault();
                                              document.getElementById('delete-career').submit();" class="btn btn-danger">Hapus</a>
                            </div>
                            <form id="delete-career" action="{{ route('careers.destroy', $career->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-edit{{ $career->id }}" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_user_header">
                                <h2 class="fw-bold">Edit Career</h2>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <!--begin::Form-->
                                <form class="form" action="{{ route('careers.update', ['career' => $career->id]) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Company</label>
                                            <select class="form-select" name="company_id" data-placeholder="Select an option">
                                                <option>Pilih ...</option>
                                                @foreach ($companies as $company)
                                                <option value="{{ $company->id }}" {{ $career->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Career Name</label>
                                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $career->name }}"/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Description</label>
                                            <textarea rows="3" class="mb-3 d-none kt_docs_tinymce_edit" name="description"  id="kt_docs_tinymce_edit">{!! $career->description !!}</textarea>
                                        </div>                
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="fw-semibold fs-6 mb-2">Department</label>
                                                    <input type="text" name="department" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $career->department }}"/>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="fw-semibold fs-6 mb-2">Location</label>
                                                    <input type="text" name="location" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $career->location }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="fw-semibold fs-6 mb-2">Work Function</label>
                                                    <input type="text" name="workfunction" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $career->workfunction }}"/>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="fw-semibold fs-6 mb-2">Experience</label>
                                                    <input type="text" name="experience" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $career->experience }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="fw-semibold fs-6 mb-2">Graduate</label>
                                                    <input type="text" name="graduate" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $career->graduate }}"/>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="fw-semibold fs-6 mb-2">Major</label>
                                                    <input type="text" name="major" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $career->major }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="fw-semibold fs-6 mb-2">Candidate</label>
                                                    <input type="text" name="candidate" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $career->candidate }}"/>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="fv-row mb-7">
                                                    <label class="fw-semibold fs-6 mb-2">Until Date</label>
                                                    <input type="date" name="until_date" class="form-control form-control-solid mb-3 mb-lg-0"  value="{{ $career->until_date }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Salary</label>
                                            <input type="text" name="salary" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $career->salary }}"/>
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
@push('js')
<script src="/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
<script>
    var options = {selector: "#kt_docs_tinymce_basic", height : "480"};

    options["skin"] = "oxide";
    options["content_css"] = "default";

    tinymce.init(options);
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var options = {
            selector: ".kt_docs_tinymce_edit",
            height: "480"
        };

        options["skin"] = "oxide";
        options["content_css"] = "default";

        tinymce.init(options);
    });
</script>
@endpush

