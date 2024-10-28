<div>
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" wire:model.live="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search site" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-outline ki-filter fs-2"></i>Import</button>
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold">Import Site</div>
                    </div>
                    <div class="separator border-gray-200"></div>
                    <div class="px-7 py-5" data-kt-user-table-filter="form">
                        <div class="mb-10">
                            <form action="{{ route('import-site') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <input type="file" name="file" class="form-control">
                            <br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Import Data</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                <i class="ki-outline ki-plus fs-2"></i>Add Site</button>
            </div>
            <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_add_user_header">
                            <h2 class="fw-bold">Add Site</h2>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body px-5 my-7">
                            <!--begin::Form-->
                            <form class="form" action="{{ route('sites.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Pilih Perusahaan</label>
                                        <select class="form-select" name="company_id" data-placeholder="Select an option">
                                            @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}" {{ $company->is_default == 1 ? 'selected' : '' }}>{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Site Name</label>
                                        <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="name"/>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Description</label>
                                        <input type="text" name="description" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Description"/>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <div class="col">
                                                    <label class="required fw-semibold fs-6 mb-2">Latitude</label>
                                                    <input type="text" name="lat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="-6526.62656565626"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <div class="col">
                                                    <label class="required fw-semibold fs-6 mb-2">Longitude</label>
                                                    <input type="text" name="long" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="120.5595879522595"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Radius</label>
                                        <input type="text" name="radius" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="100"/>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <div class="col">
                                                    <label class="required fw-semibold fs-6 mb-2">Nama Client</label>
                                                    <input type="text" name="client_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Jhon Doe"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="fv-row mb-7">
                                                <div class="col">
                                                    <label class="required fw-semibold fs-6 mb-2">No Whatsapp Client</label>
                                                    <input type="text" name="client_phone" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="0812xxxxxx"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Email Client</label>
                                        <input type="text" name="client_email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="jhondoe@gmail.com"/>
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
                    <th class="min-w-125px">Company</th>
                    <th class="min-w-125px">Name</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @foreach ($sites as $key => $site)                                    
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                    </td>
                    <td>{{ $site->id }}</td>
                    <td>{{ $site->company['name'] ?? '' }}</td>
                    <td>{{ $site->name }}</td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $site->id }}">Edit</a>
                        <a href="#" class="btn btn-light btn-active-light-danger" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $site->id }}">Delete</a>
                    </td>
                </tr>
                <div class="modal fade" id="modal-delete{{ $site->id }}" tabindex="-1" aria-hidden="true" wire:ignore>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Hapus {{ $site->name }} ?</h3>
                
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
                                <a href="#"
                                onclick="event.preventDefault();
                                              document.getElementById('delete-site-{{ $site->id }}').submit();" class="btn btn-danger">Hapus</a>
                            </div>
                            <form id="delete-site-{{ $site->id }}" action="{{ route('sites.destroy', $site->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-edit{{ $site->id }}" tabindex="-1" aria-hidden="true" wire:ignore>
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_user_header">
                                <h2 class="fw-bold">Edit Site</h2>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <!--begin::Form-->
                                <form class="form" id="edit-site" action="{{ route('sites.update', ['site' => $site->id]) }}" method="POST" enctype="multipart/form-data">
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
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('edit-site').submit();" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait... 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </a>
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
    <div class="d-flex justify-content-end">
        {{ $sites->links() }}
    </div>
</div>
@push('js')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.hook('message.processed', (message, component) => {
            var modals = document.querySelectorAll('.modal');
            modals.forEach(modal => new bootstrap.Modal(modal));
        });
    });
</script>
@endpush
