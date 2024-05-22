@extends('layouts.main')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <div class="me-7 mb-4">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img src="{{ $user->profile['avatar_url'] ?? '/assets/media/avatars/blank.png' }}" alt="image" />
                                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-2">
                                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $user->name }}</a>
                                            <a href="#">
                                                <i class="ki-outline ki-verify fs-1 text-primary"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                            <i class="ki-outline ki-profile-circle fs-4 me-1"></i>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    {{ $v }}
                                                @endforeach
                                            @endif
                                            </a>
                                            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                            <i class="ki-outline ki-geolocation fs-4 me-1"></i>{{ $user->site['name'] ?? 'belum ada site' }}</a>
                                            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                            <i class="ki-outline ki-sms fs-4"></i>{{ $user->email }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap flex-stack">
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <div class="d-flex flex-wrap">
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-solid ki-star fs-3 text-warning me-2"></i>
                                                    <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="4500">0</div>
                                                </div>
                                                <div class="fw-semibold fs-6 text-gray-500">Rating</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user-account', ['id' => encrypt($user->id)]) }}">Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user-profile', ['id' => encrypt($user->id)]) }}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user-document', ['id' => encrypt($user->id)]) }}">Documents</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('user-activities', ['id' => encrypt($user->id)]) }}">Activities</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Account Activities</h3>
                        </div>
                    </div>
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <div class="card pt-4">
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Logs</h2>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="ki-outline ki-cloud-download fs-3"></i>Download Report</button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body py-0">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fw-semibold text-gray-600 fs-6 gy-5" id="kt_table_customers_logs">
                                        <!--begin::Table body-->
                                        <tbody>
                                            @foreach ($activities as $activity) 
                                                @php
                                                    $properties = json_decode($activity->properties);
                                                    $attributes = (array)($properties->attributes ?? []);
                                                    $old = (array)($properties->old ?? []);
                                                    
                                                    // Find keys that have changed
                                                    $changedKeys = array_diff_assoc($attributes, $old);
                                                @endphp
                                                
                                                @if(!empty($changedKeys))
                                                    <tr>
                                                        <!--begin::Badge=-->
                                                        <td class="min-w-70px">
                                                            @if($activity->description === 'updated')
                                                                <div class="badge badge-light-warning">{{ $activity->description }}</div>
                                                            @elseif($activity->description === 'created')
                                                                <div class="badge badge-light-success">{{ $activity->description }}</div>
                                                            @elseif($activity->description === 'deleted')
                                                                <div class="badge badge-light-danger">{{ $activity->description }}</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <!-- Display only the changed keys and their new values -->
                                                            @foreach($changedKeys as $key => $newValue)
                                                                {{ $key }}: {{ $newValue }} <br>
                                                            @endforeach
                                                        </td>
                                                        <!-- Display old values corresponding to the changed keys only if there are any -->
                                                        <td>
                                                            @if(!empty($old))
                                                                @foreach($changedKeys as $key => $newValue)
                                                                    @if(array_key_exists($key, $old))
                                                                        {{ $key }}: {{ $old[$key] }} <br>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <!--end::Status=-->
                                                        <!--begin::Timestamp=-->
                                                        <td class="pe-0 text-end min-w-200px">{{ $activity->created_at->format('d-m-Y') }}</td>
                                                        <!--end::Timestamp=-->
                                                    </tr>
                                                @endif
                                            @endforeach                                   
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Card body-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection