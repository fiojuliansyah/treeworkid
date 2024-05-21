<div>
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" wire:model.live="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search user" />
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
                    <th class="min-w-125px">Role</th>
                    <th class="min-w-125px">Reporting To</th>
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
                            <a href="apps/user-management/users/view.html">
                                <div class="symbol-label">
                                    <img src="{{ $user->profile['avatar_url'] ?? '/assets/media/avatars/blank.png' }}" alt="{{ $user->name }}" class="w-100" />
                                </div>
                            </a>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                            <span>{{ $user->email }}</span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                            <span class="badge badge-light-warning">{{ $v }}</span>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        {{ $user->leader['name'] ?? 'Tidak ada' }}
                    </td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                        <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="{{ route('employees.edit', ['employee' => $user->id]) }}" target="_blank" class="menu-link px-3">Edit</a>
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
                                <a href="{{ route('employees.destroy', $user->id) }}"
                                onclick="event.preventDefault();
                                              document.getElementById('delete-user').submit();" class="btn btn-danger">Hapus</a>
                            </div>
                            <form id="delete-user" action="{{ route('employees.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        <!--end::Table-->
    </div>
</div>
