<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiteAttendanceExport;

class ReportController extends Controller
{
    public function attendanceReport()
    {
        $employees = User::all();
        $sites = Site::all();
        return view('reports.attendances', compact('employees', 'sites'));
    }

    public function employeeExport(Request $request)
    {
        $userId = $request->input('user_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new EmployeeExport($userId, $startDate, $endDate), 'attendance_report.xlsx');
    }

    // public function siteExport(Request $request)
    // {
    //     $siteId = $request->input('site_id');
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     return Excel::download(new SiteAttendanceExport($siteId, $startDate, $endDate), 'attendance_site_report.xlsx');
    // }

    // public function employeeView(Request $request)
    // {
    //     $user_id = $request->input('user_id');
    //     $start_date = $request->input('start_date');
    //     $end_date = $request->input('end_date');

    //     $attendances = Attendance::where('user_id', $user_id)
    //                             ->whereBetween('date', [$start_date, $end_date])
    //                             ->get();

    // return view('reports.employee', compact('attendances', 'start_date', 'end_date'));
    // }

    public function siteView(Request $request)
    {
        $site_id = $request->input('site_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        // Fetch all users for the site
        $users = User::where('site_id', $site_id)->get();
        
        // Fetch attendance data
        $attendances = Attendance::where('site_id', $site_id)
                                ->whereBetween('date', [$start_date, $end_date])
                                ->with(['user', 'overtimes', 'leave'])
                                ->get();
        
        // Group attendance data by user
        $attendancesByUser = $attendances->groupBy('user_id')->map(function($userAttendances) {
            return $userAttendances->keyBy(function($attendance) {
                return $attendance->date->format('Y-m-d');
            });
        });
        
        // Initialize totals
        $totalsByUser = [];
        
        foreach ($users as $user) {
            $userAttendances = $attendancesByUser->get($user->id, collect());
            
            $totalHK = 0;
            $totalOvertimeMinutes = 0;
            $totalBA = 0;
            $totalLeave = 0;
        
            foreach ($userAttendances as $attendance) {
                // Calculate HK (workdays)
                if ($attendance->type !== 'shift_off' && $attendance->leave_id === null) {
                    $totalHK++;
                }
        
                // Calculate Overtime
                foreach ($attendance->overtimes as $overtime) {
                    $overtimeStart = \Carbon\Carbon::parse($overtime->clock_in);
                    $overtimeEnd = \Carbon\Carbon::parse($overtime->clock_out);
        
                    if ($overtimeEnd && $overtimeStart) {
                        $totalOvertimeMinutes += $overtimeStart->diffInMinutes($overtimeEnd);
                    }
                }
        
                // Calculate BA (Berita Acara)
                if ($attendance->type === 'berita_acara') {
                    $totalBA++;
                }
        
                // Calculate Leave (Cuti)
                if ($attendance->leave_id !== null) {
                    $totalLeave++;
                }
            }
        
            // Convert total minutes to hours and minutes
            $totalOvertimeHours = intdiv($totalOvertimeMinutes, 60);
            $remainingMinutes = $totalOvertimeMinutes % 60;
        
            $totalsByUser[$user->id] = [
                'totalHK' => $totalHK,
                'totalOvertime' => sprintf('%d jam %d menit', $totalOvertimeHours, $remainingMinutes),
                'totalBA' => $totalBA,
                'totalLeave' => $totalLeave,
            ];
        }
        
        // Generate the range of dates
        $dates = collect();
        $currentDate = \Carbon\Carbon::parse($start_date);
        $endDate = \Carbon\Carbon::parse($end_date);
        
        while ($currentDate->lte($endDate)) {
            $dates->push($currentDate->copy());
            $currentDate->addDay();
        }
        
        return view('reports.site', compact('users', 'attendancesByUser', 'site_id', 'start_date', 'end_date', 'dates', 'totalsByUser'));
    }
    
}
