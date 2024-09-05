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
                            <form action="{{ route('export.excel') }}" method="GET" style="display: inline;">
                                <input type="hidden" name="site_id" value="{{ $site_id }}">
                                <input type="hidden" name="start_date" value="{{ $start_date }}">
                                <input type="hidden" name="end_date" value="{{ $end_date }}">
                                <button type="submit" class="btn btn-success">Export to Excel</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body py-4 table-responsive">
                        <style>
                            /* Make the table header fixed */
                            #kt_table_users thead {
                                position: sticky;
                                top: 0;
                                background-color: #fff; /* Adjust if needed to match your theme */
                                z-index: 10; /* Ensure it is above other content */
                            }

                            /* Optional: Add a border to differentiate */
                            #kt_table_users thead th {
                                border-bottom: 2px solid #dee2e6;
                            }

                            /* Freeze the first column */
                            #kt_table_users .frozen-col {
                                position: -webkit-sticky; /* For Safari */
                                position: sticky;
                                left: 0;
                                background-color: #fff; /* Match your theme */
                                z-index: 20; /* Ensure it's above other content */
                                border-right: 2px solid #dee2e6; /* Optional: add a border */
                            }

                            #kt_table_users td {
                                white-space: nowrap; /* Prevent text from wrapping */
                            }
                        </style>
                        <table class="table table-bordered align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <thead class="text-center">
                                <tr class="text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="frozen-col" rowspan="2">Name</th>
                                    @foreach ($dates as $date)
                                        <th colspan="3">
                                            {{ $date->format('d') }}
                                            <br>
                                            {{ $date->format('l') }}
                                        </th>
                                    @endforeach
                                    <th colspan="10">Total Keseluruhan</th>
                                </tr>
                                <tr class="text-muted fw-bold fs-7 text-uppercase gs-0">
                                    @foreach ($dates as $date)
                                        <th>IN</th>
                                        <th>OUT</th>
                                        <th>LEMBUR</th>
                                    @endforeach
                                    <th colspan="2">Total HK</th>
                                    <th colspan="2">Total OFF</th>
                                    <th colspan="2">Total Lembur</th>
                                    <th colspan="2">Total BA</th>
                                    <th colspan="2">Total Cuti</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold text-center">
                                @forelse ($users as $user)
                                    @php
                                        $userAttendances = $attendancesByUser->get($user->id, collect());
                                        $totals = $totalsByUser[$user->id] ?? [
                                            'totalHK' => 0,
                                            'totalOvertime' => '0 jam 0 menit',
                                            'totalBA' => 0,
                                            'totalLeave' => 0,
                                        ];
                                    @endphp
                                    <tr>
                                        <td class="frozen-col" >
                                            {{ $user->name }}
                                        </td>
                                        @foreach ($dates as $date)
                                            @php
                                                $attendance = $userAttendances->get($date->format('Y-m-d'));
                                            @endphp
                                            @if ($attendance)
                                                @if ($attendance->leave_id != null)
                                                    <td colspan="3">
                                                        {{ $attendance->leave->type['name'] }}
                                                    </td>
                                                @elseif($attendance->type == 'shift_off')
                                                    <td colspan="3">
                                                        OFF                                                   
                                                    </td>
                                                @else
                                                    <td>
                                                        @if ($attendance->type == 'berita_acara')
                                                            <p style="color: blue">
                                                                {{ $attendance->clock_in->format('H:i') }}</p>
                                                        @else
                                                            {!! $attendance->clock_in ? $attendance->clock_in->format('H:i') : '<i class="fas fa-times" style="color: grey;"></i>' !!}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($attendance->type == 'berita_acara')
                                                            <p style="color: blue">
                                                                @if($attendance->clock_out != null)
                                                                    {{ $attendance->clock_out->format('H:i') }}
                                                                @endif
                                                            </p>
                                                        @else
                                                            {!! $attendance->clock_out ? $attendance->clock_out->format('H:i') : '<i class="fas fa-times" style="color: grey;"></i>' !!}
                                                        @endif
                                                    <td>
                                                        @php
                                                            $overtime = $attendance->overtimes->firstWhere('attendance_id', $attendance->id);
                                                            $clockIn = $overtime ? \Carbon\Carbon::parse($overtime->clock_in) : null;
                                                        @endphp

                                                        {!! $clockIn ? $clockIn->format('H:i') : '<i class="fas fa-times" style="color: grey;"></i>' !!}

                                                        @php
                                                            $overtime = $attendance->overtimes->firstWhere('attendance_id', $attendance->id);
                                                            $clockOut = $overtime ? \Carbon\Carbon::parse($overtime->clock_out) : null;
                                                        @endphp

                                                        {!! $clockOut ? $clockOut->format('H:i') : '<p></p>' !!}
                                                    </td>
                                                @endif
                                            @else
                                                <td><i class="fas fa-times" style="color: grey;"></i></td>
                                                <td><i class="fas fa-times" style="color: grey;"></i></td>
                                                <td><i class="fas fa-times" style="color: grey;"></i></td>
                                            @endif
                                        @endforeach
                                        <td colspan="2">{{ $totals['totalHK'] }}</td>
                                        <td colspan="2">{{ $totals['totalShiftOff'] }}</td>
                                        <td colspan="2">{{ $totals['totalOvertime'] }}</td>
                                        <td colspan="2">{{ $totals['totalBA'] }}</td>
                                        <td colspan="2">{{ $totals['totalLeave'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ 2 + $dates->count() * 2 }}" class="text-center">
                                            No data available for the selected date range.
                                        </td>
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
