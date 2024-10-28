<div>
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" wire:model.live="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search employee" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-outline ki-filter fs-2"></i>Import</button>
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold">Import User</div>
                    </div>
                    <div class="separator border-gray-200"></div>
                    <div class="px-7 py-5" data-kt-user-table-filter="form">
                        <div class="mb-10">
                            <form action="{{ route('import-user') }}" method="POST" enctype="multipart/form-data">
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
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                    </div>
                    <div class="separator border-gray-200"></div>
                    <div class="px-7 py-5" data-kt-user-table-filter="form">
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Site :</label>
                            <select class="form-select form-select-solid fw-bold" data-placeholder="Select option" wire:model.live="selectedSite" id="select-site">
                                <option value="">All Site</option>
                                @foreach ($sites as $site)
                                   <option value="{{ $site->id }}">{{ $site->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body py-4 table-responsive">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                        </div>
                    </th>
                    <th class="min-w-125px">User</th>
                    <th class="min-w-125px">Detail</th>
                    <th class="min-w-125px">Site</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @foreach ($users as $user)                                    
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                    </td>
                    <td class="d-flex align-items-center">
                        <!--begin:: Avatar -->
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <a href="{{ route('user-account', ['id' => encrypt($user->id)]) }}">
                                <div class="symbol-label">
                                    <img src="{{ $user->profile['avatar_url'] ?? '/assets/media/avatars/blank.png' }}" alt="{{ $user->name }}" class="w-100" />
                                </div>
                            </a>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <a href="{{ route('user-account', ['id' => encrypt($user->id)]) }}" class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                            <span>{{ $user->employee_nik ?? '' }}</span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td>
                        @php
                            $colors = ['badge-light-warning', 'badge-light-primary', 'badge-light-success', 'badge-light-danger', 'badge-light-info', 'badge-light-secondary'];
                            @endphp

                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    @php
                                    $randomColor = $colors[array_rand($colors)];
                                    @endphp
                                    <span class="badge {{ $randomColor }}">{{ $v }}</span>
                                @endforeach
                            @endif
                        <br>
                        <span>{{ $user->email }}</span>
                        <br>
                        <span>Leader : <strong>{{ $user->leader['name'] ?? '' }}</strong></span>
                    </td>
                    <td>
                        <span>{{ $user->site->company['name'] ?? 'Tidak ada' }}</span>
                        <br>
                        <span>
                            {{ $user->site['name'] ?? 'Tidak ada' }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                        <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="{{ route('user-resume', ['id' => encrypt($user->id)]) }}" target="_blank" class="menu-link px-3">Resume</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="{{ route('user-account', ['id' => encrypt($user->id)]) }}" target="_blank" class="menu-link px-3">Edit</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3"  data-bs-toggle="modal" data-bs-target="#modal-delete{{ $user->id }}">Delete</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                </tr>
                <div class="modal fade" id="modal-delete{{ $user->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Hapus {{ $user->name }} ?</h3>
                
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
                                              document.getElementById('delete-user-{{ $user->id }}').submit();" class="btn btn-danger">Hapus</a>
                            </div>
                            <form id="delete-user-{{ $user->id }}" action="{{ route('employees.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
        <!--end::Table-->
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('#select-site').select2().on('change', function (e) {
                @this.set('selectedSite', $(this).val());
            });
        });
    </script>
@endpush
