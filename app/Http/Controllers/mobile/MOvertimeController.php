<?php

namespace App\Http\Controllers\mobile;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Overtime;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MOvertimeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $lastAttendance = Attendance::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        $siteId = Auth::user()->site_id;
        $teams = User::where('site_id', $siteId)
            ->whereNotIn('id', [$userId])
            ->get();

        $latestOvertime = Overtime::where('attendance_id', $lastAttendance->id)
            ->latest()
            ->first();

        $clockInStatus = Overtime::where('attendance_id', $lastAttendance->id)
            ->whereNotNull('clock_in')
            ->exists();

        $clockOutStatus = Overtime::where('attendance_id', $lastAttendance->id)
            ->whereNotNull('clock_out')
            ->exists();

        $logs = Overtime::where('attendance_id', $lastAttendance->id)
            ->get();

        foreach ($logs as $log) {
            $clockIn = new DateTime($log->clock_in);
            $clockOut = new DateTime($log->clock_out);
            
            $diff = $clockIn->diff($clockOut);
            
            $log->duration = $diff->format('%H:%I:%S');
        }
    
        return view('mobiles.overtimes.index', compact('clockInStatus', 'clockOutStatus', 'logs', 'latestOvertime', 'teams'));
    }

    public function clockinStore(Request $request)
    {
        $today = Carbon::now()->toDateString();
        $user = Auth::user();
        $timeNow = Carbon::now()->toTimeString();
    
        // Cari data kehadiran (attendance) untuk hari ini
        $attendance = Attendance::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();
    
        if ($attendance) {
            $attendance->update([
                'latlong' => $request->latlong
            ]);
        } else {
            $attendance = Attendance::create([
                'date' => $today,
                'user_id' => $user->id,
                'site_id' => $user->site_id,
                'latlong' => $request->latlong
            ]);
        }
    
        Overtime::updateOrCreate(
            ['attendance_id' => $attendance->id],
            [
                'clock_in' => $timeNow,
                'reason' => $request->reason,
                'demand' => $request->demand,
                'backup_id' => $request->backup_id
            ]
        );
    
        return redirect()->route('overtime.index')
                         ->with('success', 'Overtime recorded successfully.');
    }
      

    public function clockoutStore(Request $request)
    {
        $timeNow = Carbon::now()->toTimeString();

        $lastOvertime = Overtime::orderBy('created_at', 'desc')
            ->first();

        if ($lastOvertime) {
            $lastOvertime->clock_out = $timeNow;
            $lastOvertime->save();
        }

        return redirect()->route('overtime.index')
                         ->with('success', 'Overtime recorded successfully.');
    }
}
