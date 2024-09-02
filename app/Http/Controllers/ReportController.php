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

    // public function employeeExport(Request $request)
    // {
    //     $userId = $request->input('user_id');
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     return Excel::download(new EmployeeExport($userId, $startDate, $endDate), 'attendance_report.xlsx');
    // }

    // public function siteExport(Request $request)
    // {
    //     $siteId = $request->input('site_id');
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     return Excel::download(new SiteAttendanceExport($siteId, $startDate, $endDate), 'attendance_site_report.xlsx');
    // }

    public function employeeView(Request $request)
    {
        $user_id = $request->input('user_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $attendances = Attendance::where('user_id', $user_id)
                                ->whereBetween('date', [$start_date, $end_date])
                                ->get();

    return view('reports.employee', compact('attendances', 'start_date', 'end_date'));
    }

    public function siteView(Request $request)
    {
        $site_id = $request->input('site_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        // Fetch attendances for the specified site and date range
        $attendances = Attendance::where('site_id', $site_id)
                                ->whereBetween('date', [$start_date, $end_date])
                                ->with('user', 'overtimes') // Load user and overtimes
                                ->get();
        
        // Group attendances by user_id
        $attendancesByUser = $attendances->groupBy('user_id');
        
        // Pass data to view
        return view('reports.site', compact('attendancesByUser', 'site_id', 'start_date', 'end_date'));
    }
  
}
