<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-wrapper">
        <div id="kt_app_sidebar_wrapper" class="hover-scroll-y my-5 my-lg-2 mx-4" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper" data-kt-scroll-offset="5px">
            <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-3 mb-5">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-home-2 fs-2"></i>
                        </span>
                        <span class="menu-title text-gray-700 fw-bold fs-6">Dashboard</span>
                    </a>
                </div>
                <br>
                <br>
                <div class="menu-item menu-labels">
                    <div class="menu-content d-flex flex-stack fw-bold text-gray-600 text-uppercase fs-7">
                        <span class="menu-heading ps-1">Apps</span>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('recruit','careers.index','applicants*') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-briefcase fs-2"></i>
                        </span>
                        <span class="menu-title">Recruit</span>
                        @if ($countPendingAll > 0)  
                            <span class="menu-badge">
                                <span class="badge badge-danger">{{ $countPendingAll }}</span>
                            </span>
                        @endif
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('recruit') ? 'active' : '' }}" href="{{ route('recruit') }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('careers.index') ? 'active' : '' }}" href="{{ route('careers.index') }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Careers</span>
                            </a>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is('applicants*') ? 'here show' : '' }}">
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Job Applicants</span>
                                @if ($countPendingAll > 0)  
                                    <span class="menu-badge">
                                        <span class="badge badge-danger">{{ $countPendingAll }}</span>
                                    </span>
                                @endif
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('applicants.index') ? 'active' : '' }}" href="{{ route('applicants.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Applicants</span>
                                        @if ($countPending > 0)  
                                            <span class="menu-badge">
                                                <span class="badge badge-danger">{{ $countPending }}</span>
                                            </span>
                                        @endif
                                    </a>
                                    @foreach ($statuses as $status)
                                        <a class="menu-link" href="{{ route('statuses.show', $status->name) }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ $status->name }}</span>
                                            @if ($status->unapprovedApplicants() && $status->unapprovedApplicants()->count() > 0)  
                                                <span class="menu-badge">
                                                    <span class="badge badge-danger">{{ $status->unapprovedApplicants()->count() }}</span>
                                                </span>
                                            @endif
                                        </a>
                                    @endforeach                                
                                </div>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('web-career') }}" target="_blank" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Career Site</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('letters.index') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-people fs-2"></i>
                        </span>
                        <span class="menu-title">HR</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="#" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Generate</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('letters.index') ? 'active' : '' }}" href="{{ route('letters.index') }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Letter Template</span>
                            </a>
                        </div>
                    </div>
                </div>
                <br>
                <div class="menu-item menu-labels">
                    <div class="menu-content d-flex flex-stack fw-bold text-gray-600 text-uppercase fs-7">
                        <span class="menu-heading ps-1">Setup</span>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('users.index','roles.index','companies.index','sites.index') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-setting fs-2"></i>
                        </span>
                        <span class="menu-title">Managements</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-user fs-2"></i>
                                </span>
                                <span class="menu-title">Users</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('roles.index') ? 'active' : '' }}" title="Pengaturan Jabatan Pengguna" href="{{ route('roles.index') }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-key fs-2"></i>
                                </span>
                                <span class="menu-title">Roles</span>
                            </a>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('companies.index','sites.index') ? 'here show' : '' }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-element-3 fs-2"></i>
                                </span>
                                <span class="menu-title">General</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('companies.index') ? 'active' : '' }}" href="{{ route('companies.index') }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Companies</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('sites.index') ? 'active' : '' }}" href="{{ route('sites.index') }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Sites</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('statuses.index') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-briefcase fs-2"></i>
                        </span>
                        <span class="menu-title">Recruit</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('statuses.index') ? 'active' : '' }}" href="{{ route('statuses.index') }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-briefcase fs-2"></i>
                                </span>
                                <span class="menu-title">Status</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
