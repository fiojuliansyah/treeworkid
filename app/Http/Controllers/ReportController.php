<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
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

    public function siteExport(Request $request)
    {
        $siteId = $request->input('site_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new SiteAttendanceExport($siteId, $startDate, $endDate), 'attendance_site_report.xlsx');
    }
}
