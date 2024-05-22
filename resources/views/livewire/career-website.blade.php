<div>
    <div class="card-title">
        <div class="d-flex align-items-center position-relative my-1">
            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
            <input type="text" wire:model.live="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search career" />
        </div>
    </div>
    <br>
    <br>
    <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
        @foreach ($careers as $key => $career)     
        <div class="col-md-6 col-xxl-4">
            <div class="card">
                <div class="card-body d-flex flex-center flex-column py-9 px-5">
                    <div class="mb-10">
                        <a href="{{ route('web-career') }}" class="app-sidebar-logo">
                            <img alt="Logo" src="/assets/media/logos/logo-dark.png" class="h-25px theme-light-show" />
                            <img alt="Logo" src="/assets/media/logos/logo.png" class="h-25px theme-dark-show" />
                        </a>
                    </div>
                    <a href="#" class="fs-4 text-gray-900 text-hover-primary fw-bold mb-0">{{ $career->name }}</a>
                    <div class="fw-semibold text-gray-500 mb-6">{{ $career->location }}</div>
                    <div class="d-flex flex-center flex-wrap mb-5">
                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                            <div class="fw-semibold text-gray-500">Graduate</div>
                            <div class="fs-6 fw-bold text-gray-900">{{ $career->graduate }}</div>
                        </div>
                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                            <div class="fw-semibold text-gray-500">Salary</div>
                            <div class="fs-6 fw-bold text-success">{{ $career->salary }}</div>
                        </div>
                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                            <div class="fw-semibold text-gray-500">Need</div>
                            <div class="fs-6 fw-bold text-gray-900">{{ $career->candidate }}</div>
                        </div>
                    </div>
                    <a href="{{ route('web-career-detail', encrypt($career->id)) }}" class="btn btn-sm btn-light-primary btn-flex btn-center" data-kt-follow-btn="true">
                        <span class="indicator-label">Apply</span>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
