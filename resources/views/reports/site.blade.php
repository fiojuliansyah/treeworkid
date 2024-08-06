@extends('layouts.main')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="pb-7">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Attendance Date : {{ $start_date }} - {{ $end_date }}</h1>
                        <!--end::Title-->
                    </div>
                </div>
                <div class="card">
                    <div class="card-body py-4 table-responsive">
                        <table class="table table-bordered align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <thead class="text-center">
                                <tr class="text-muted fw-bold fs-7 text-uppercase gs-0"> 
                                    <th rowspan="2">Name</th>
                                    @foreach ($attendancesByUser->first() as $attendance)   
                                        @php
                                            $hasMinutes = $attendance->minutes->isNotEmpty();
                                        @endphp
                                        <th colspan="2">{{ $attendance->date->format('d') }}</th>
                                    @endforeach
                                </tr>
                                <tr class="text-muted fw-bold fs-7 text-uppercase gs-0">
                                    @foreach ($attendancesByUser->first() as $attendance)
                                        @php
                                            $hasMinutes = $attendance->minutes->isNotEmpty();
                                        @endphp
                                        <th>IN</th>
                                        <th>OUT</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold text-center">                                  
                                @foreach ($attendancesByUser as $userAttendances)
                                    @php
                                        $user = $userAttendances->first()->user; 
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                            <br>
                                            Overtime
                                        </td>
                                        @foreach ($userAttendances as $attendance)
                                            @php
                                                $hasMinutes = $attendance->minutes->isNotEmpty();
                                            @endphp
                                            <td>
                                                {!! $hasMinutes ? '<i class="fas fa-file-alt"></i>' : '' !!}
                                                {{ $attendance->clock_in }}
                                                <br>
                                                {{ $attendance->overtimes->firstWhere('attendance_id', $attendance->id)->clock_in ?? '' }}
                                            </td>
                                            <td>
                                                {!! $hasMinutes ? '<i class="fas fa-file-alt"></i>' : '' !!}
                                                {{ $attendance->clock_out }}
                                                <br>
                                                {{ $attendance->overtimes->firstWhere('attendance_id', $attendance->id)->clock_out ?? '' }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
