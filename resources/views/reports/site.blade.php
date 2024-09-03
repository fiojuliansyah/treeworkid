@extends('layouts.main')

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="pb-7">
                        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                            <h1
                                class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                Attendance Date : {{ $start_date }} - {{ $end_date }}
                            </h1>
                        </div>
                    </div>
                    <div class="card-body py-4 table-responsive">
                        <table class="table table-bordered align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <thead class="text-center">
                                <tr class="text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th rowspan="2">Name</th>
                                    @foreach ($dates as $date)
                                        <th colspan="2">{{ $date->format('d') }}</th>
                                    @endforeach
                                    <th colspan="8">Total Keseluruhan</th>
                                </tr>
                                <tr class="text-muted fw-bold fs-7 text-uppercase gs-0">
                                    @foreach ($dates as $date)
                                        <th>IN</th>
                                        <th>OUT</th>
                                    @endforeach
                                    <th colspan="2">Total HK</th>
                                    <th colspan="2">Total Lembur</th>
                                    <th colspan="2">Total BA</th>
                                    <th colspan="2">Total Cuti</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold text-center">
                                @forelse ($attendancesByUser as $user_id => $userAttendances)
                                    @php
                                        $user = $userAttendances->first()->user;
                                        $totals = $totalsByUser[$user_id];
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                            <br>
                                            Overtime
                                        </td>
                                        @foreach ($dates as $date)
                                            @php
                                                $attendance = $userAttendances->get($date->format('Y-m-d'));
                                            @endphp
                                            @if ($attendance)
                                                @if ($attendance->leave_id != null)
                                                    <td colspan="2">
                                                        {{ $attendance->leave->type['name'] }}
                                                    </td>
                                                @elseif($attendance->type == 'shift_off')
                                                    <td colspan="2">
                                                        OFF
                                                    </td>
                                                @else
                                                    <td>
                                                        @if ($attendance->type == 'berita_acara')
                                                            <p style="color: blue">
                                                                {{ $attendance->clock_in->format('H:i') }}</p>
                                                        @else
                                                            {{ $attendance->clock_in ? $attendance->clock_in->format('H:i') : '-' }}
                                                        @endif
                                                        <br>
                                                        {{ $attendance->overtimes->firstWhere('attendance_id', $attendance->id)->clock_in ?? '-' }}
                                                    </td>
                                                    <td>
                                                        @if ($attendance->type == 'berita_acara')
                                                            <p style="color: blue">
                                                                @if($attendance->clock_out != null)
                                                                    {{ $attendance->clock_out->format('H:i') }}
                                                                @endif
                                                            </p>
                                                        @else
                                                            {{ $attendance->clock_out ? $attendance->clock_out->format('H:i') : '-' }}
                                                        @endif
                                                        <br>
                                                        {{ $attendance->overtimes->firstWhere('attendance_id', $attendance->id)->clock_out ?? '-' }}
                                                    </td>
                                                @endif
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
                                        @endforeach
                                        <td colspan="2">{{ $totals['totalHK'] }}</td>
                                        <td colspan="2">{{ $totals['totalOvertime'] }}</td>
                                        <td colspan="2">{{ $totals['totalBA'] }}</td>
                                        <td colspan="2">{{ $totals['totalLeave'] }}</td>
                                </tr> @empty <tr>
                                        <td colspan="{{ 2 + $dates->count() * 2 }}" class="text-center"> No data available
                                            for the selected date range. </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
